<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Account;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountRequest;
use App\Mail\ActivateRegistration;
use App\User;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['guest', 'locale']);
    }

    /**
     * Create a new account plus a user instance after a valid registration.
     * Also send an activate registration mail.
     */
    protected function create(array $data)
    {
        $account = Account::create([
            'name' => $data['name'],
            'contact' => $data['contact'],
            'email' => $data['email'],
            'token' => Str::random(40),
        ]);

        $user = User::create([
            'account_id' => $account->id,
            'name' => $data['contact'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Mail::to($data['email'])->send(new ActivateRegistration($account, $user));

        return $user;
    }

    /**
     * Handle a registration request for the application.
     */
    public function register(StoreAccountRequest $request)
    {
        event(new Registered($this->create($request->validated())));

        alert(__('register.account-created'))->type('success');
        return redirect('/register');
    }

    /**
     * This activates the account.
     */
    public function activate(Request $request, $id, $token)
    {
        $email = $request->input('e');

        // get user and account
        $user = User::where('account_id', $id)->where('email', $email)->whereNull('email_verified_at')->first();
        $account = Account::where('id', $id)->where('token', $token)->first();

        if ($user && $account) {
            $user->email_verified_at = now();
            $user->save();

            $this->guard()->login($user);
        }

        return redirect('/');
    }
}
