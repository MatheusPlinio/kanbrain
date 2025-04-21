<?php

namespace App\Http\Requests\User;

use App\Rules\ValidSocialEmail;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class LoginSocialRequest extends FormRequest
{

    public function prepareForValidation()
    {
        try {
            $this->decoded = JWT::decode(
                $this->token,
                new Key(config('app.next_auth_secret'), 'HS256')
            );

            $this->merge([
                'email' => $this->decoded->email ?? null,
                'name' => $this->decoded->name ?? null,
                'sub' => $this->decoded->sub ?? null,
                'provider' => $this->decoded->provider ?? ''
            ]);
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'token' => ['Token inválido ou expirado.'],
            ]);
        }
    }

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'token' => ['required', 'string'],
            'email' => ['required', 'email', new ValidSocialEmail($this->input('sub'))],
            'name' => ['required', 'string'],
            'sub' => 'sometimes',
            'provider' => ['required', 'string']
        ];
    }
}
