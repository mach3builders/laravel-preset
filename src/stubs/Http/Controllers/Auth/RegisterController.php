<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\PrivateLabel;
use App\User;
use App\Company;
use App\Cname;
use App\Stat;
use App\Mail\ActivateRegistration;

use Validator;
use Carbon\Carbon;
use App\Facades\Label;

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
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data)
    {
        $rules = [
            'company_name'  => 'required|max:255',
            'name'          => 'required|max:255',
            'email'         => 'required|email|max:255|unique:users',
            'password'      => 'required|min:6|confirmed',
        ];

        if (!privateLabelFound()) {
            $rules['conditions_agree'] = 'accepted';
        }

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data)
    {
        $cname      = (new Cname)->new();
        $cname_id   = $cname ? $cname->id : 1;

        $label = Label::company();

        $company = new Company([
            'token'     => Str::random(40),
            'name'      => $data['company_name'],
            'contact'   => $data['name'],
            'email'     => $data['email'],
            'locale'    => app()->getLocale(),
            'plan_id'   => 1,
            'cname_id'  => $cname_id,
            'active'    => 0,
        ]);
        
        if ($label) {
            $company->parent_id = $label->id;
        }
        
        $company->save();

        $user = $company->users()->create([
            'company_id'    => $company->id,
            'role_id'       => 2,
            'name'          => $data['name'],
            'email'         => $data['email'],
            'password'      => bcrypt($data['password']),
            'locale'        => app()->getLocale(),
        ]);

        Mail::to($data['email'])->send(new ActivateRegistration($company, $user));

        return $user;
    }

    /**
     * Handle a registration request for the application from outside (the website)
     */
    public function registerFromWebsite(Request $request)
    {
        header('Access-Control-Allow-Origin: *');

        // validate
        Validator::make($request->all(), [
            'company_name'  => 'required|max:255',
            'name'          => 'required|max:255',
            'email'         => 'required|email|max:255|unique:users',
            'password'      => 'required|min:6',
        ])->validate();

        $user = $this->create($request->all());

        return $user ? [
            'status' => 'success',
            'title' => trans('mail.registration-done-title'),
            'body' => trans('mail.registration-done-body', ['email' => $request->input('email')]),
        ] : ['status' => 'error'];
    }

    /**
     * Handle a registration request for the application.
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        alert(trans('register.saved'))->type('success');
        return redirect('/register');
    }

    /**
     * This activates the account
     */
    public function activateRegistration(Request $request, $id, $token)
    {
        $email = $request->input('e');

        // get user and company
        $user       = User::where('email', $email)->first();
        $company    = Company::where('id', $id)->where('token', $token)->where('active', '!=', 1)->first();

        if ($user && $company && $user->company_id == $company->id) {
            // when private label environment, always disabled payment for this registration
            // the admin can enable it per client in the app
            if (privateLabelFound()) {
                $company->payments_disabled = 1;
            }

            $company->active = 1;
            $company->save();

            // update statistics
            Stat::updateOrCreate(['day' => Carbon::now()->format('d'), 'month' => Carbon::now()->format('m'), 'year' => Carbon::now()->format('Y')])->increment('companies');

            // add subscriber to campaign monitor
            if (config('app.env') == 'production' && !privateLabelFound()) {
                $wrap = new \CS_REST_Subscribers(env('CM_LIST_ID'), env('CM_API_KEY'));
                $wrap->add([
                    'EmailAddress'  => $user->email,
                    'Name'          => $user->name,
                    'Resubscribe'   => true
                ]);
            }

            $this->guard()->login($user);
        }

        return redirect('/');
    }
}
