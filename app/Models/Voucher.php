<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'discount_value',
        'point_need',
        'details',
        'expired_at',
    ];


    /**
     * User voucher relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_vouchers(): HasMany
    {
        return $this->hasMany(UserVoucher::class);
    }
    public static function booted()
    {
        static::addGlobalScope('activeAndNotExpired', function ($builder) {
            $builder->where('active_status', 1)
                    ->where(function ($q) {
                        $q->whereNull('expired_at')
                        ->orWhere('expired_at', '>', now());
                    });
        });
    }
}
