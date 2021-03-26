<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankDetailsReiew extends Model
{
    protected $fillable = [
                            'user_bank_id', 'bank_sort_code', 'bank_account_number'
                        ];
}
