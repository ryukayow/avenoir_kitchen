<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $idUser = session('id_user');

        if (!$idUser) {
            return redirect()->route('login');
        }

        $user = User::find($idUser);

        if (!$user || $user->role !== $role) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}