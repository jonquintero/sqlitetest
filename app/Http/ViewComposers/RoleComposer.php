<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

use App\Role;

class RoleComposer {

	public function compose(View $view)
	{

        $roles = Role::all()->pluck('title', 'id');

        $view->with('roles',  $roles);

	}
}
