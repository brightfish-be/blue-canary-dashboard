<?php

namespace App;

use App\Traits\HasTenant;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Tenant application model
 *
 * @property Tenant $tenant
 * @property Collection $counters
 * @property int $id
 * @property int $tenant_id
 * @property string $name
 * @property string $uuid
 *
 * @copyright 2019 Brightfish
 * @author Arnaud Coolsaet <a.coolsaet@brightfish.be>
 */
class App extends Model
{
    use HasUuid, HasTenant;

    /** @var int */
    const NAME_LENGTH_MIN = 6;

    /** @var int */
    const NAME_LENGTH_MAX = 255;

    /** {@inheritdoc} */
    protected $fillable = [
        'name', 'uuid'
    ];

    /** {@inheritdoc} */
    protected $hidden = [
        'id', 'tenant_id'
    ];

    /** {@inheritdoc} */
    protected $casts = [
        'name' => 'string',
        'uuid' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the tenant that owns this app.
     * @return BelongsTo
     */
    public function tenant()
    {
        return $this->belongsTo('App\Tenant');
    }

    /**
     * Get the counter for this app.
     * @return HasMany
     */
    public function counters()
    {
        return $this->hasMany('App\Counter');
    }
}
