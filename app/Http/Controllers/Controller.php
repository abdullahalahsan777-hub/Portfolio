<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    /**
     * View data storage array.
     */
    public array $data = [];

    /**
     * Get the currently authenticated user model instance.
     */
    protected function currentUser(): ?User
    {
        $user = Auth::user();

        return $user instanceof User ? $user : null;
    }
}

