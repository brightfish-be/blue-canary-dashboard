<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Counter model.
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
    /** {@inheritdoc} */
    protected $fillable = [
        'name',
    ];

    /** {@inheritdoc} */
    protected $hidden = [
        'id', 'app_id',
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
     */
    protected function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = strtolower($value);
    }

    /**
     * Return the endpoint URL for this counter.
     * @return string
     */
    public function generateUrl(): string
    {
        $base = url('/api/' . config('canary.settings.api_version'));

        return "$base/{$this->app->uuid}/{$this->name}/";
    }
}
