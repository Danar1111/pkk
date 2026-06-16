<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Http\Responses\Contracts\RegistrationResponse;
use Filament\Notifications\Notification;
use Filament\Auth\Pages\Register as BaseRegister;
use Illuminate\Database\Eloquent\Model;
use Filament\Facades\Filament;

class Register extends BaseRegister
{
    protected function handleRegistration(array $data): Model
    {
        $user = $this->getUserModel()::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'is_active' => false,
        ]);

        return $user;
    }

    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(2);
        } catch (\Illuminate\Http\Exceptions\ThrottleRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();
            return null;
        }

        $this->callHook('beforeValidate');
        $data = $this->form->getState();
        $this->callHook('afterValidate');

        $data = $this->mutateFormDataBeforeRegister($data);

        $this->callHook('beforeRegister');
        $user = $this->handleRegistration($data);
        $this->callHook('afterRegister');

        // Do NOT auto-login — the user must wait for admin approval
        Notification::make()
            ->title('Registrasi Berhasil!')
            ->body('Akun Anda telah dibuat dan sedang menunggu persetujuan Admin. Silakan tunggu hingga Admin mengaktifkan akun Anda.')
            ->success()
            ->persistent()
            ->send();

        $this->form->fill();

        return null; // Return null to stay on the registration page
    }
}
