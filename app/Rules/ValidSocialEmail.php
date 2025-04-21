<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidSocialEmail implements ValidationRule
{
    public function __construct(protected $subId)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = User::where('email', $value)->first();

        if (!$user) {
            return;
        }

        if ($user->social_sub_id !== $this->subId) {
            $fail('Este e-mail já está associado a uma conta diferente.');
        }
    }
}
