@extends('layouts.app')

@section('content')
    <!-- Authenticated -->
    <div class="container">
        <div class="justify-content-center content-box">
            <div class="row">
                <div class="col-md-12">
                    <table style="border-spacing:0;">
                        <tr>
                            <td rowspan="3" style="padding: 0;"><img src="{{$user->avatar}}" class="avatar"/></td>
                            <td height="12"></td>
                        </tr>
                        <tr>
                            <td style="padding: 0;">
                                <span style="font-size: 16pt; line-height: 100%; vertical-align: bottom;">{{$user->name}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:0" class="subtitle">
                                @switch($user->role)
                                    @case('administrator')
                                    <span style="color: #b00; font-weight: bold;">{{$user->role}}</span>
                                    -
                                    @break
                                    @case('moderator')
                                    <span style="color: #44f; font-weight: bold;">{{$user->role}}</span>
                                    -
                                    @break
                                    @default
                                @endswitch
                                {{$user->gender}} - {{$user->points}} Points
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="spacer-row"></div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h4>Badges</h4>
                    <span>
                        @foreach($badgesByCategory as $category => $badgeGroup)
                            <div style="margin: 5px;">
                                    @foreach($badgeGroup as $badge)
                                    @if($gamificationService->userHasBadge($user, $badge))
                                        @include('partials._badge', ['badge' => $badge])
                                    @else
                                        <img class="ct-badge" src="/img/badges/_unachieved.png"/>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </span>
                </div>
                <div class="col-md-6">
                    <h4>Bio</h4>
                    <span>{{$user->description}}</span>
                </div>
            </div>
            <div class="spacer-row"></div>
            <div class="row">
                <div class="col-md-12">
                    <h4>Statistics</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="stats-row">
                        <div class="col-md-5"><b>Issued Assignments</b></div>
                        <div class="col-md-7">
                            {{$user->getStatistics()['issuedAssignments']['all']}} Issued<br/>
                            {{$user->getStatistics()['issuedAssignments']['fulfilled']}} Fulfilled
                        </div>
                    </div>
                    <div class="stats-row">
                        <div class="col-md-5"><b>Performed Assignments</b></div>
                        <div class="col-md-7">
                            {{$user->getStatistics()['receivedAssignments']['passed']}} Passed<br/>
                            {{$user->getStatistics()['receivedAssignments']['failed']}} Failed<br/>
                            {{$user->getStatistics()['receivedAssignments']['rejected']}} Rejected
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stats-row">
                        <div class="col-md-5"><b>Authored Tasks</b></div>
                        <div class="col-md-7">
                            {{$user->getStatistics()['authoredTasks']['all']}} Submitted<br/>
                            {{$user->getStatistics()['authoredTasks']['approved']}} Approved
                        </div>
                    </div>
                    <div class="stats-row">
                        <div class="col-md-5"><b>Written Comments</b></div>
                        <div class="col-md-7">
                            {{$user->getStatistics()['writtenComments']['tasks']}} For Tasks<br/>
                            {{$user->getStatistics()['writtenComments']['assignments']}} For Assignments <br/>
                            {{$user->getStatistics()['writtenComments']['comments']}} As Replies
                        </div>
                    </div>
                </div>
            </div>
            @if($user->authoredTasks()->exists())
                <div class="spacer-row"></div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Authored Tasks</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-dark table-striped">
                            <thead>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Rating</th>
                            </thead>
                            <tbody>
                            @foreach($user->authoredTasks as $task)
                                <tr>
                                    <td><a href="/tasks/{{$task->id}}">{{$task->title}}</a></td>
                                    <td>{{$task->getShortDescription()}}</td>
                                    <td>@include('partials._rating', ['rating' => $task->getRating()])</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @if($user->issuedAssignments()->exists())
                <div class="spacer-row"></div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Issued Assignments</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-dark table-striped">
                            <thead>
                            <th>Performer</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Rating</th>
                            </thead>
                            <tbody>
                            @foreach($user->issuedAssignments as $assignment)
                                <tr>
                                    <td>
                                        @if($assignment->assignee_user_id)
                                            <a href="/users/{{$assignment->assignee_user_id}}">{{$assignment->assignee->name}}</a>
                                        @else
                                            deleted user
                                        @endif
                                    </td>
                                    <td><a href="/assignments/{{$assignment->id}}">{{$assignment->task->title}}</a></td>
                                    <td>{{$assignment->task->getShortDescription()}}</td>
                                    <td>{{$assignment->status}}</td>
                                    <td>@include('partials._rating', ['rating' => $assignment->getRating()])</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @if($user->issuedAssignments()->exists())
                <div class="spacer-row"></div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Performed Assignments</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-dark table-striped">
                            <thead>
                            <th>Assigned By</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Rating</th>
                            </thead>
                            <tbody>
                            @foreach($user->receivedAssignments as $assignment)
                                <tr>
                                    <td>
                                        @if(!$assignment->assigner_user_id)
                                            deleted user
                                        @elseif($assignment->assigner_user_id === $assignment->assignee_user_id)
                                            self-assigned
                                        @else
                                            <a href="/users/{{$assignment->assigner_user_id}}">{{$assignment->assigner->name}}</a>
                                        @endif
                                    </td>
                                    <td><a href="/assignments/{{$assignment->id}}">{{$assignment->task->title}}</a></td>
                                    <td>{{$assignment->task->getShortDescription()}}</td>
                                    <td>{{$assignment->status}}</td>
                                    <td>@include('partials._rating', ['rating' => $assignment->getRating()])</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
