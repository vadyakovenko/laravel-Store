<?php

namespace App\Http\ViewComposers;
use Illuminate\Contracts\View\View;
use \Auth;

class CurrentUserComposer
{
    public function compose(View $view) {
        $view->with('CurrentUser', Auth::user());
    }
}