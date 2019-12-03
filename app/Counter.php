<?php

namespace App;

use App\Exceptions\InvalidCounterName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Counter model
 *
 * @property App $app
 * @property int $id
 * @property int $app_id
 * @property string $name
 * @property string $uuid
 *
 * @copyright 2019 Brightfish
 * @author Arnaud Coolsaet <a.coolsaet@brightfish.be>
 */
class Counter extends Model
{
    /** @var int */
    const NAME_LENGTH_MIN = 6;

    /** @var int */
    const NAME_LENGTH_MAX = 255;

    /** {@inheritdoc} */
    protected $fillable = [
        'name',
    ];

    /** {@inheritdoc} */
    protected $hidden = [
        'id', 'app_id'
    ];

    /** {@inheritdoc} */
    protected $casts = [
        'name' => 'string',
        'uuid' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the app that owns this counter.
     * @return BelongsTo
     */
    public function app()
    {
        return $this->belongsTo('App\App');
    }

    /**
     * Get the events for this counter.
     * @return HasMany
     */
    public function events()
    {
        return $this->hasMany('App\Event');
    }

    /**
     * Laravel mutator.
     * @param string $value
     * @throws InvalidCounterName
     */
    protected function setNameAttribute(string $value): void
    {
        $min = static::NAME_LENGTH_MIN;
        $max = static::NAME_LENGTH_MAX;

        $len = strlen($value);

        if ($len < $min || $len > $max) {
            throw new InvalidCounterName("The counter's name length can only be between $min and $max.");
        }

        $value = strtolower($value);

        if (preg_match('#[^a-z0-9\-_.]#', $value)) {
            throw new InvalidCounterName('The counter\'s name contains invalid characters.');
        }

        $this->attributes['name'] = $value;
    }

    /**
     * Return the endpoint URL for this counter.
     * @return string
     */
    public function generateUrl(): string
    {
        $base = config('app.url') . '/api/' . config('canary.api_version');

        $appUuid = $this->app->uuid;

        return "$base/$appUuid/{$this->name}/";
    }
}
