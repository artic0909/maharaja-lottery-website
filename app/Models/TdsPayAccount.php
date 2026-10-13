<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TdsPayAccount extends Model
{
    protected $table = 'tds_pay_account';

    protected $fillable = [
        'bank_name',
        'account_number',
        'ifsc_code',
        'account_holder',
        'branch_name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Retrieve the active official government TDS deposit account,
     * or automatically initialize a default realistic Indian government treasury account.
     */
    public static function getActive(): self
    {
        $account = self::where('is_active', true)->latest()->first();

        if (!$account) {
            $account = self::first();
        }

        if (!$account) {
            $account = self::create([
                'bank_name' => 'State Bank of India (Govt. Treasury Branch)',
                'account_number' => '40918239012',
                'ifsc_code' => 'SBIN0000691',
                'account_holder' => 'Directorate of State Lotteries - Govt. of India',
                'branch_name' => 'Govt. Treasury Main Branch',
                'is_active' => true,
            ]);
        }

        return $account;
    }
}
