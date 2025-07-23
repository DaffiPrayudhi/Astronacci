<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Log; 

class SocialAuthController extends Controller
{
     public function redirectToGoogle(Request $request)
    {
        if ($request->has('membership_type')) {
            session(['socialite.membership_type' => $request->membership_type]);
        }

        session()->forget([
            'socialite.provider',
            'socialite.state',
            'socialite.oauth_token'
        ]);
        
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            if ($request->has('error')) {
                throw new \Exception('Google authentication error: ' . $request->error);
            }

            $googleUser = Socialite::driver('google')->stateless()->user();
            
            $existingUser = User::where('email', $googleUser->getEmail())->first();
            
            if ($existingUser) {
                $existingUser->update([
                    'name' => $googleUser->getName(),
                    'provider' => 'google',
                    'provider_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar()
                ]);
                
                Auth::login($existingUser, true);
                return redirect()->intended('/dashboard');
            } else {
                $membershipType = session('socialite.membership_type', 'A');
                
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'provider' => 'google',
                    'provider_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'membership_type' => $membershipType,
                    'password' => bcrypt(Str::random(16))
                ]);

                $request->session()->forget('socialite.membership_type');
                return redirect('/login')->with('success', 'Registrasi dengan Google berhasil! Silakan login.');
            }

        } catch (\Exception $e) {
            \Log::error('Google OAuth Error: ' . $e->getMessage());
            return redirect('/register')->withErrors('Login dengan Google gagal. Silakan coba lagi.');
        }
    }

    public function redirectToFacebook(Request $request)
    {
        if ($request->has('membership_type')) {
            session(['socialite.membership_type' => $request->membership_type]);
        }

        session()->forget([
            'socialite.provider',
            'socialite.state',
            'socialite.oauth_token'
        ]);
        
        return Socialite::driver('facebook')
            ->with(['auth_type' => 'reauthenticate'])
            ->redirect();
    }

    public function handleFacebookCallback(Request $request)
    {
        try {
            if ($request->has('error')) {
                throw new \Exception('Facebook authentication error: ' . $request->error);
            }

            $facebookUser = Socialite::driver('facebook')->stateless()->user();
            
            $existingUser = User::where('email', $facebookUser->getEmail())->first();
            
            if ($existingUser) {
                $existingUser->update([
                    'name' => $facebookUser->getName(),
                    'provider' => 'facebook',
                    'provider_id' => $facebookUser->getId(),
                    'avatar' => $facebookUser->getAvatar()
                ]);
                
                Auth::login($existingUser, true);
                return redirect()->intended('/dashboard');
            } else {
                $membershipType = session('socialite.membership_type', 'A');
                
                $user = User::create([
                    'name' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(),
                    'provider' => 'facebook',
                    'provider_id' => $facebookUser->getId(),
                    'avatar' => $facebookUser->getAvatar(),
                    'membership_type' => $membershipType,
                    'password' => bcrypt(Str::random(16))
                ]);

                $request->session()->forget('socialite.membership_type');
                return redirect('/login')->with('success', 'Registrasi dengan Facebook berhasil! Silakan login.');
            }

        } catch (\Exception $e) {
            \Log::error('Facebook OAuth Error: ' . $e->getMessage());
            return redirect('/register')->withErrors('Login dengan Facebook gagal. Silakan coba lagi.');
        }
    }
}