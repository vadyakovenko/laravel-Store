<?php

namespace App\Http\Controllers\Auth;

use App\Entity\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\Auth\RegisterRequest;
use App\UseCases\Auth\RegisterService;

class RegisterController extends Controller
{
    use RegistersUsers;


    protected $redirectTo = '/';

    private $service;

   
    public function __construct(RegisterService $service)
    {
        $this->service = $service;
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $this->service->register($request); 
        return redirect()->route('login')
            ->with('success', 'На Ваш email отправлено письмо для активации аккаунта!');
    }

    public function verify(string $token)
    {
        if(!$user = User::where('verify_token', $token)->first()) {
            return redirect()->route('login')
                ->with('error', 'Ошибка! Неверная ссылка!');
        }

        try {
            $this->service->verify($user->id);
            return redirect()->route('login')
                ->with('success', 'Аккаунт успешно активирован!');
        } catch (\DomainExeption $e) {
            return redirect()->route('login')
                ->with('error', $e->getMessage());
        }
    }



}
