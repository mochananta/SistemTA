<?php

namespace App\Actions\Jetstream;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = auth()->user();

        if ($user->role === 'admin_sistem' || $user->role === 'admin_kua') {
            return redirect()->route('admin.index');
        }

        return redirect('/');    
    }
}
