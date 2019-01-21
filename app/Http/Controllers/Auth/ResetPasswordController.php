<?php

namespace CRUDTEST\Http\Controllers\Auth;

use CRUDTEST\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use CRUDTEST\Http\Requests\StoreUser;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
     * パスワード再設定用のバリデーションルール
     * 
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => [
                'required',
                'email',
            ],
            'password' => (new StoreUser())->rules()['password'],
        ];
    }
    protected function sendResetResponse(Request $request, $response)
    {
        // リダイレクト先でフラッシュメッセージを表示する
        return redirect($this->redirectPath())
            ->with('my_status', trans($response));
    }
}
