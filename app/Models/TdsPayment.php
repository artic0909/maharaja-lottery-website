<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TdsPayment extends Model
{
    protected $table = 'tds_payments';

    protected $fillable = [
        'booking_ref',
        'ticket_number',
        'customer_name',
        'customer_phone',
        'account_number',
        'ifsc_code',
        'bank_name',
        'winning_prize_text',
        'winning_amount',
        'tds_percentage',
        'tds_amount',
        'utr_number',
        'receipt_image',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'winning_amount' => 'float',
        'tds_percentage' => 'float',
        'tds_amount' => 'float',
    ];

    /**
     * Parse arbitrary prize string (e.g. 'INR 2 Lakhs', '₹15,00,000', '50000') into numeric value.
     */
    public static function parsePrizeToNumeric(mixed $prize): float
    {
        if (is_numeric($prize)) {
            return (float) $prize;
        }

        $str = strtoupper(trim((string)$prize));
        if (empty($str)) {
            return 200000.0; // fallback default 2 Lakhs
        }

        // Check for Crores / Cr
        if (preg_match('/([\d\.]+)\s*(?:CRORES?|CR)/i', $str, $m)) {
            return (float)$m[1] * 10000000;
        }

        // Check for Lakhs / Lacs / L
        if (preg_match('/([\d\.]+)\s*(?:LAKHS?|LACS?|LAKH|LAC)/i', $str, $m)) {
            return (float)$m[1] * 100000;
        }

        // Check for thousands / K
        if (preg_match('/([\d\.]+)\s*(?:THOUSANDS?|K)/i', $str, $m)) {
            return (float)$m[1] * 1000;
        }

        // Remove non-numeric characters except decimal dot
        $cleaned = preg_replace('/[^\d\.]/', '', $str);
        if (!empty($cleaned) && is_numeric($cleaned)) {
            return (float)$cleaned;
        }

        return 200000.0;
    }

    /**
     * Compute 1% TDS from a prize string or numeric amount.
     */
    public static function calculateTds(mixed $prize, float $percentage = 1.0): array
    {
        $numPrize = self::parsePrizeToNumeric($prize);
        $tds = round(($numPrize * $percentage) / 100.0, 2);

        return [
            'winning_numeric' => $numPrize,
            'tds_numeric' => $tds,
            'winning_formatted' => '₹' . number_format($numPrize),
            'tds_formatted' => '₹' . number_format($tds),
            'percentage' => $percentage,
        ];
    }

    /**
     * Get masked account number for privacy (e.g. XXXXXX1234).
     */
    public function getMaskedAccountAttribute(): string
    {
        $acc = (string) $this->account_number;
        if (strlen($acc) <= 4) {
            return $acc;
        }
        return str_repeat('•', max(0, strlen($acc) - 4)) . substr($acc, -4);
    }
}
