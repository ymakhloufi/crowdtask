<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
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
            '_name'     => 'required|string|max:191',
            '_email'    => 'required|string|email|max:191|unique:users',
            '_password' => 'required|string|min:6',
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
        $user = $this->userRepository->create([
            'name'  => $data['_name'],
            'email' => $data['_email'],
        ]);

        $user->password = bcrypt($data['_password']);
        $user->save();

        Mail::send('mail.welcome', ['user' => $user], function (Message $m) use ($user) {
            //$m->from(config('mail.from.address'), config('mail.from.name'));
            $m->to($user->email, $user->name)->subject('Welcome to ' . config('app.name') . "!");
        });

        return $user;
    }
}
