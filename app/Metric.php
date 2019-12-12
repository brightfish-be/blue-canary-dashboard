<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Metric model.
 *
 * @property Event $event
 * @property string $type
 * @property string $key
 * @property int|float $value
 * @property string $unit
 *
 * @copyright 2019 Brightfish
 * @author Arnaud Coolsaet <a.coolsaet@brightfish.be>
 */
class Metric extends Model
{
    /** {@inheritdoc} */
    const UPDATED_AT = null;

    /** {@inheritdoc} */
    protected $fillable = [
        'type', 'key', 'value', 'unit',
    ];

    /** {@inheritdoc} */
    protected $casts = [
        'type' => 'string',
        'key' => 'string',
        'value' => 'float',
        'unit' => 'string',
        'created_at' => 'datetime',
    ];

    /**
     * Get the event that owns this metric.
     * @return BelongsTo
     */
    public function event()
    {
        return $this->belongsTo('App\Metric');
    }

    /**
     * Return the properly casted value.
     * @return float|int
     */
    protected function getValueAttribute()
    {
        switch ($this->type) {
            case 'int':
                return (int)$this->attributes['value'];
            default:
                return (float)$this->attributes['value'];
        }
    }
}
