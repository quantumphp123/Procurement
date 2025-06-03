<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class CheckUniquePhone implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        if ($value !== null) { // Check uniqueness only if value is not null
            $normalizedPhone = $this->normalizePhoneNumber($value);
            $existsWithPrefix = User::where('phone', $normalizedPhone)->exists();
            $existsWithoutPrefix = User::where('phone', substr($normalizedPhone, 2))->exists(); // Remove the +1 prefix for comparison
            if($existsWithPrefix || $existsWithoutPrefix){
                return false;
            }
        }
        return true;
    }

    private function normalizePhoneNumber($phoneNumber)
    {
        // Perform normalization logic here
        // For example, remove all non-numeric characters
        return '+1' . preg_replace('/\D/', '', $phoneNumber);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The phone number has already been taken.';
    }
}
