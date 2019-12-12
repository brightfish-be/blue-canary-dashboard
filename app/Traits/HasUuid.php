<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Creates UUIDs for models.
 *
 * @copyright 2019 Brightfish
 * @author Arnaud Coolsaet <a.coolssaet@brightfish.be>
 */
trait HasUuid
{
    /**
     * Create an UUID when the model is created.
     * @see Model::boot()
     * @see Model::bootTraits()
     * @return void
     */
    public static function bootHasUuid(): void
    {
        static::creating(function (Model $model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    /**
     * Laravel local query scope.
     * @param $query
     * @param string $uuid
     * @return Builder
     */
    public function scopeByUuid(Builder $query, $uuid): Builder
    {
        return $query->where('uuid', $uuid);
    }

    /**
     * Get a model by its UUID.
     * @param string $uuid
     * @return Model
     */
    public function findByUuid(string $uuid): Model
    {
        /* @noinspection PhpUndefinedMethodInspection */
        return static::byUuid($uuid)->first();
    }
}
