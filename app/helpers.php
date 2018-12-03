<?php

if (! function_exists('my_is_current_controller')) {
    /**
     * 現在のコントローラー名が、複数の名前のどれかに一致するかどうか判別する。
     * 
     * @param array $nanes コントローラー名 (可変長引数)
     * @return bool
     */
    function my_is_current_controller(...$names)
    {
        $current = explode('.', Route::currentRouteName())[0];
        return in_array($current, $name, true);
    }
}