<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoForbiddenWords implements Rule
{
    public function passes($attribute, $value)
    {
        $forbidden = ['test', 'spam', 'xxx'];
        $lower = mb_strtolower((string)$value, 'UTF-8');
        foreach ($forbidden as $w) {
            if (str_contains($lower, $w)) {
                return false;
            }
        }
        return true;
    }

    public function message()
    {
        return 'Trường :attribute chứa từ không được phép.';
    }
}
