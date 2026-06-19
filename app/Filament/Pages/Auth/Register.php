<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Http\Responses\Contracts\RegistrationResponse;
use Filament\Notifications\Notification;
use Filament\Auth\Pages\Register as BaseRegister;
use Illuminate\Database\Eloquent\Model;
use Filament\Facades\Filament;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;
use SensitiveParameter;

class Register extends BaseRegister
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(['default' => 1, 'sm' => 2])
                    ->components([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        \Filament\Forms\Components\Placeholder::make('password_hint')
                            ->hiddenLabel()
                            ->content(new \Illuminate\Support\HtmlString('<div style="font-size: 0.75rem; color: #64748B; margin-top: -0.25rem; width: 100%;">Minimal 8 karakter, huruf besar, huruf kecil, & angka.</div>'))
                            ->columnSpan('full'),
                    ])->columnSpan('full'),
            ])
            ->statePath('data');
    }

    protected function getPasswordFormComponent(): \Filament\Schemas\Components\Component
    {
        return TextInput::make('password')
            ->label('Kata sandi')
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->required()
            ->rules([
                function () {
                    return function (string $attribute, $value, \Closure $fail) {
                        if (strlen($value) < 8) {
                            $fail('Kata sandi minimal 8 karakter.');
                            return;
                        }
                        if (!preg_match('/[a-z]/', $value)) {
                            $fail('Kata sandi harus mengandung huruf kecil.');
                            return;
                        }
                        if (!preg_match('/[A-Z]/', $value)) {
                            $fail('Kata sandi harus mengandung huruf besar.');
                            return;
                        }
                        if (!preg_match('/[0-9]/', $value)) {
                            $fail('Kata sandi harus mengandung angka.');
                            return;
                        }
                    };
                }
            ])
            ->dehydrateStateUsing(fn (#[SensitiveParameter] $state) => Hash::make($state))
            ->same('passwordConfirmation')
            ->validationMessages([
                'same' => 'Konfirmasi kata sandi tidak cocok dengan kata sandi utama.',
                'required' => 'Kata sandi wajib diisi.'
            ]);
    }

    protected function getPasswordConfirmationFormComponent(): \Filament\Schemas\Components\Component
    {
        return TextInput::make('passwordConfirmation')
            ->label('Konfirmasi kata sandi')
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->required()
            ->validationMessages([
                'required' => 'Konfirmasi kata sandi wajib diisi.'
            ])
            ->dehydrated(false);
    }

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
        } catch (\DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException $exception) {
            \Filament\Notifications\Notification::make()
                ->title('Terlalu Banyak Percobaan')
                ->body('Harap tunggu ' . $exception->secondsUntilAvailable . ' detik sebelum mencoba lagi.')
                ->danger()
                ->send();
            return null;
        }

        $this->callHook('beforeValidate');
        
        try {
            $data = $this->form->getState();
        } catch (\Illuminate\Validation\ValidationException $exception) {
            $errors = $exception->validator->errors()->all();
            \Filament\Notifications\Notification::make()
                ->title('Pendaftaran Gagal')
                ->body(implode('<br>', $errors))
                ->danger()
                ->send();
            
            // Return null so we don't proceed, and we intentionally swallow the exception 
            // so inline validation errors aren't rendered, stopping the layout from shifting!
            return null;
        }

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

        // Redirect to login page
        $this->redirect(Filament::getLoginUrl());

        return null;
    }
}
