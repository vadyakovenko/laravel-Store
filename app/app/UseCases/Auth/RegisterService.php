<?php

namespace App\UseCases\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Entity\User;
use Illuminate\Contracts\Mail\Mailer;
use App\Mail\Auth\VerifyMail;

class RegisterService 
{
    private $mailer;    

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function register(RegisterRequest $request): void
    {
        $user = User::register($request['first_name'], $request['email'], $request['password']);
        $this->mailer->to($user->email)->send(new VerifyMail($user));
    }

    public function verify(int $userId): void
    {
        $user = User::findOrFail($userId);
        $user->verify();
    }
}