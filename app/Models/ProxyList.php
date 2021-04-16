<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProxyList extends Model
{
    public function proxies(): BelongsToMany
    {
        return $this->belongsToMany(Proxy::class);
    }

    public function getUpdatedAtColumn()
    {
        return null;
    }
}
