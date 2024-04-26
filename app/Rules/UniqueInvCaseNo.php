<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\ComplaintReport;

class UniqueInvCaseNo implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the inv_case_no already exists in the database
        return !ComplaintReport::where('inv_case_no', $value)->exists();
    }

    public function message()
    {
        return 'The Investigation Case No. has already been taken.';
    }
}
