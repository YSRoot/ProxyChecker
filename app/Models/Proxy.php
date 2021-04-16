<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Proxy
 * @package App\Models
 * @method Builder notChecked()
 */
class Proxy extends Model
{
    public const DISABLED_STATUS = 'disabled';
    public const ENABLED_STATUS = 'enabled';

    public const TYPES = [
        'http',
        'https',
        'socks5',
        'socks4',
    ];

    protected $fillable = [
        'ip',
        'real_ip',
        'port',
        'type',
        'geo',
        'speed',
        'status',
        'is_checked',
        'check_time_sec',
    ];

    protected $attributes = [
        'status' => self::DISABLED_STATUS,
        'is_checked' => false,
        'check_time_sec' => 0,
    ];

    public function scopeNotChecked(Builder $query): Builder
    {
        return $query->where('is_checked', false);
    }

    public function scopeEnabled(Builder $query): Builder
    {
        return $query->where('status', self::ENABLED_STATUS);
    }

    public function scopeDisabled(Builder $query): Builder
    {
        return $query->where('status', self::DISABLED_STATUS);
    }
}
