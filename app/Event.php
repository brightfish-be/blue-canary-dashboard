<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Event model.
 *
 * @copyright 2019 Brightfish
 * @author Arnaud Coolsaet <a.coolsaet@brightfish.be>
 */
class Event extends Model
{
    /** {@inheritdoc} */
    const UPDATED_AT = null;

    /** {@inheritdoc} */
    protected $fillable = [
        'client_id', 'client_name', 'status_code', 'status_remark', 'generated_at',
    ];

    /** {@inheritdoc} */
    protected $with = [
        'metrics',
    ];

    /** {@inheritdoc} */
    protected $casts = [
        'client_id' => 'string',
        'client_name' => 'string',
        'status_code' => 'int',
        'status_remark' => 'string',
        'generated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    /**
     * Get the counter that owns this event.
     * @return BelongsTo
     */
    public function counter()
    {
        return $this->belongsTo('App\Counter');
    }

    /**
     * Get the metric for this event.
     * @return HasMany
     */
    public function metrics()
    {
        return $this->hasMany('App\Metric');
    }

    /**
     * Convert to timezone.
     * @param string $value
     * @return Carbon|string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value, config('app.timezone'))->format('Y-m-d H:i:s');
    }
}
