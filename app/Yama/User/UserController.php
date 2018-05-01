<?php

namespace Yama\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Yama\User\Mappers\UserMapperComplete;
use Yama\User\Mappers\UserMapperStripped;
use Yama\User\Requests\CreateUserRequest;

class UserController extends Controller
{

    private $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function index(): JsonResponse
    {
        return response()->json(UserMapperStripped::collection($this->userRepository->all()));
    }


    public function show(string $user_id): JsonResponse
    {
        $user = $this->userRepository->find($user_id);

        return response()->json(UserMapperStripped::single($user));
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
