<?php

namespace App\Rules\User;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class Unique implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !boolval(User::whereEmail($value)->count());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Аккаунт с такой электронной почтой уже зарегистрирован.';
    }
}
