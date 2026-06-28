<?php

namespace App\Filament\Pages\Auth;

use Filament\Facades\Filament;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Auth\Pages\Login as BaseLogin;
use Illuminate\Validation\ValidationException;

class Login extends BaseLogin
{
    protected string $view = 'filament.pages.auth.login';

    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (\Illuminate\Http\Exceptions\ThrottleRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();
            return null;
        }

        $data = $this->form->getState();

        if (! Filament::auth()->attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
            $this->throwFailureValidationException();
        }

        $user = Filament::auth()->user();

        if (! $user->is_active) {
            Filament::auth()->logout();

            throw ValidationException::withMessages([
                'data.email' => 'Akun Anda sedang menunggu persetujuan Admin.',
            ]);
        }

        session()->regenerate();

        return app(LoginResponse::class);
    }
}
