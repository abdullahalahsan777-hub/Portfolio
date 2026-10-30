<?php

/**
 * Global IDE Helper & Type Inference Stubs.
 *
 * This file is purely for static analysis and is NOT loaded at runtime.
 * It provides VS Code, PHP Intelephense, PHPStan, and PhpStorm with accurate
 * type hints so that Auth::user(), auth()->user(), and $request->user()
 * resolve to \App\Models\User rather than the generic Authenticatable interface.
 */

namespace Illuminate\Support\Facades {
    class Auth {
        /**
         * Get the currently authenticated user model instance.
         *
         * @param string|null $guard
         * @return \App\Models\User|null
         */
        public static function user($guard = null) {
            return null;
        }
    }
}

namespace Illuminate\Contracts\Auth {
    interface Guard {
        /**
         * Get the currently authenticated user model instance.
         *
         * @return \App\Models\User|null
         */
        public function user();
    }

    interface StatefulGuard extends Guard {
        /**
         * Get the currently authenticated user model instance.
         *
         * @return \App\Models\User|null
         */
        public function user();
    }
}

namespace Illuminate\Http {
    class Request {
        /**
         * Get the user making the request.
         *
         * @param string|null $guard
         * @return \App\Models\User|null
         */
        public function user($guard = null) {
            return null;
        }
    }
}

namespace {
    /**
     * Get the available auth instance or authenticated user model.
     *
     * @param string|null $guard
     * @return \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Auth\Guard|\App\Models\User|null
     */
    function auth($guard = null) {
        return null;
    }
}
