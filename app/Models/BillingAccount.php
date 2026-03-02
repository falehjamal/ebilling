<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingAccount extends Model
{
    protected $table = 'tb_db_billing_account';

    protected $fillable = [
        'ip',
        'nama_db',
        'username',
        'password',
        'account',
        'nama_server',
        'file',
    ];

    protected $hidden = [
        'password',
    ];
}
