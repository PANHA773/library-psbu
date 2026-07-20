<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function checkIsActive()
    {
        if(! Auth::attempt(['email' => request()->email, 'password' => request()->password,'activated' => 1]))
        {
            return redirect('login')->with('error', 'please activate your account');
        }
        return true;
    }
    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {

        // $this->checkIsActive();
        $this->ensureIsNotRateLimited();
        
        $credentials = array_merge($this->only('email', 'password'), ['activated' => 1]);

        if (! Auth::attempt($credentials, $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    // public function authenticate(): void
    // {
    //     $this->ensureIsNotRateLimited();

    //     $login = $this->login; // input name="login"

    //     // Detect field type
    //     if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
    //         $field = 'email';
    //     } elseif (preg_match('/^[0-9]{9,15}$/', $login)) {
    //         $field = 'phone';
    //     } else {
    //         $field = 'username';
    //     }

    //     // Credentials
    //     $credentials = [
    //         $field      => $login,
    //         'password'  => $this->password,
    //         'activated' => 1,     // Optional: active users only
    //     ];

    //     if (! Auth::attempt($credentials, $this->boolean('remember'))) {
    //         RateLimiter::hit($this->throttleKey());

    //         throw ValidationException::withMessages([
    //             'login' => __('auth.failed'),
    //         ]);
    //     }

    //     RateLimiter::clear($this->throttleKey());
    // }


    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
}
