<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yama\User\User;
use Yama\User\UserRepository;

class RegisterController extends Controller
{
    use RegistersUsers;


    private   $userRepository;
    protected $redirectTo = '/';


    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('guest');
        $this->userRepository = $userRepository;
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|string|max:32',
            'email'    => 'required|string|email|max:128|unique:users',
            'gender'   => 'required|in:male,female',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return \Yama\User\User
     */
    protected function create(array $data)
    {
        User::unguard();
        $user = $this->userRepository->create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            'gender'   => $data['gender'],
        ]);
        User::reguard();

        Mail::send('mail.welcome', ['user' => $user], function (Message $m) use ($user) {
            //$m->from(config('mail.from.address'), config('mail.from.name'));
            $m->to($user->email, $user->name)->subject('Welcome to ' . config('app.name') . "!");
        });

        return $user;
    }
}
