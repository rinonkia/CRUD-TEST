<?php

namespace CRUDTEST\Http\Middleware;

use Closure;
use CRUDTEST\User;
use Auth;

class CheckLocale
{
    /**@var array 使用可能な言語 */
    private $langs = ['ja', 'en'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * テストでは使用言語を英語で固定する。
         * Dusk内では__()などは使えないため
         */
        if(\APP::environment('testing')) {
            \APP::setLocale('ja');
            return $next($request);
        }

        $locale = '';
        if (isset($_GET['lang'])) {
            // GETパラメータから言語指定を取得する
            $locale = $_GET['lang'];
        }
        else {
            $locale = session('locale');

            // セッションがなければ、ブラウザのAccept-Languageを参照する。
            if (!$locale && isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
                $locale = locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE']);
                $locale = substr($locale, 0, 2);
            }
        }

        // 指定された言語が $langs になければ、フォールバック用言語を使う
        if (!in_array($locale, $this->langs, true)) {
            $locale = config('app.fallback_locale');
        }

        // 使用言語をセッションに保存する
        session(['locale' => $locale]);
        \CRUDTEST::setLocale($locale);
        return $next($request);
    }
}
