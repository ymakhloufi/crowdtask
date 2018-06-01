<?php

namespace Yama\User;

use App\Http\Controllers\Controller;
use Yama\Gamification\BadgeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Yama\User\Mappers\UserMapperComplete;
use Yama\User\Requests\CreateUserRequest;

class UserController extends Controller
{

    private $userRepository;
    private $badgeRepository;


    public function __construct(UserRepository $userRepository, BadgeRepository $badgeRepository)
    {
        $this->userRepository  = $userRepository;
        $this->badgeRepository = $badgeRepository;
    }


    public function show(User $user): View
    {
        return view('user.show', [
            'user'                => $user,
            'badgesByCategory'    => $this->badgeRepository->all()->groupBy('category'),
            'gamificationService' => app(GamificationService::class),
        ]);
    }


    public function store(CreateUserRequest $request): JsonResponse
    {
        $user = $this->userRepository->create([
            'name'   => $request->get('name'),
            'email'  => $request->get('email'),
            'gender' => $request->get('gender'),
            'role'   => config('constants.roles.default'),
        ]);

        return response()->json(UserMapperComplete::single($user));
    }
}
