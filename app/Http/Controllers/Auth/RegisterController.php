<?php

namespace CRUDTEST\Http\Controllers\Auth;

use CRUDTEST\User;
use CRUDTEST\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use CRUDTEST\Http\Requests\StoreUser;
use Illuminate\Http\Request;


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
    protected $redirectTo = '/';

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
        //return Validator::make($data, [
        //    'name' => ['required', 'string', 'max:255'],
        //    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //    'password' => ['required', 'string', 'min:6', 'confirmed'],
        //]);

        // App\Http\Requests\StoreUser と統合
        return Validator::make($data, (new StoreUser())->rules());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \CRUDTEST\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function registerd(Request $request, $user)
    {
        // 登録したら、そのユーザーのプロフィールページへ
        return redirect('user/' .$user->id)
            ->with('my_status', __('Registration have not yet completed.') .
            __('Click your email for a verification link.'));
    }
}
