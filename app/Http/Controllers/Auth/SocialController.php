<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    /**
     * Redirect to provider
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle callback from provider
     */
    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();

        // find or create user
        $user = User::where('provider', $provider)
                    ->where('provider_id', $socialUser->getId())
                    ->first();

        if (!$user) {
            // try by email
            $user = User::where('email', $socialUser->getEmail())->first();
        }

        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User',
                'email' => $socialUser->getEmail(),
                'password' => null,
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'role' => 'user',
            ]);

        } else {
            // update provider info if missing
            $user->update([
                'provider' => $user->provider ?? $provider,
                'provider_id' => $user->provider_id ?? $socialUser->getId(),
            ]);
        }

        Auth::login($user, true);

        return redirect()->intended(route('dashboard'));
    }
}
