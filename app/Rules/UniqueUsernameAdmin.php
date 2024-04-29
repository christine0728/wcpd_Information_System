<?php

namespace App\Rules;

use App\Models\Account;
use Illuminate\Contracts\Validation\Rule;
use App\Models\ComplaintReport;

class UniqueUsernameAdmin implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the inv_case_no already exists in the database
        return !Account::where('username', $value)->exists();
    }

    public function message()
    {
        return 'The Username has already been taken.';
    }
}
