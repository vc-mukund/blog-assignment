<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\VerifyJob;
use App\Models\User;
use App\Models\VerifyUser;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dob' => ['required', 'date'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'dob' => $data['dob'],
            'password' => Hash::make($data['password']),
        ]);

        VerifyUser::create([
            'user_id' => $user->id,
            'token' => Str::random(40),
        ]);

        VerifyJob::dispatch($user);

        return $user;
    }

    /**
     * For verify user token
     *
     * @param  string  $token
     * @return mixed
     */
    public function verifyUser($token)
    {
        try {
            $verifyUser = verifyUser::where('token', $token)->first();
            if (isset($verifyUser)) {
                $user = $verifyUser->user;
                if (! $user->verified) {
                    $user->verified = 1;
                    $user->save();
                    $status = 'Your e-mail is verified. You can now login.';
                } else {
                    $status = 'Your e-mail is already verified. You can now login.';
                }
            } else {
                return redirect('/login')->with('warning', 'Sorry your email cannot be identified.');
            }

            return redirect('/login')->with('status', $status);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For redirect to login login for register email
     */
    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();

        return redirect('/login')->with('status', 'We sent you an activation code. Check your email and click on the link to verify.');
    }
}
