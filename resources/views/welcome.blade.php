@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @guest
                            You must first login!
                        @else
                            <p>You are logged in!</p>

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam euismod quam quis erat
                                viverra, sit amet finibus nisi porttitor. Sed non libero purus. Nullam consectetur et
                                sem eget malesuada. Sed quis vehicula nibh. Sed elementum turpis sit amet leo rhoncus,
                                eget ornare elit tincidunt. Fusce tristique leo sit amet erat laoreet feugiat. Mauris
                                hendrerit nulla ligula, in consequat justo suscipit sodales.</p>

                            <p>Vivamus dapibus turpis sed rhoncus interdum. Morbi volutpat quis massa a sollicitudin.
                                Duis vitae consectetur erat. Etiam nec orci dignissim, feugiat leo non, suscipit nunc.
                                Nulla massa risus, luctus ac feugiat et, maximus at mi. Curabitur dapibus ante venenatis
                                viverra consectetur. Fusce vulputate ultricies elementum. Nullam varius ullamcorper
                                neque a faucibus. Etiam pretium pulvinar mattis. Aenean mollis erat a tortor cursus,
                                lobortis semper turpis consequat.</p>
                        @endguest

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
