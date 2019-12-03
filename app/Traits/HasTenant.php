<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * Handles tenant dependency of models.
 *
 * @copyright 2019 Brightfish
 * @author Arnaud Coolsaet <a.coolssaet@brightfish.be>
 */
trait HasTenant
{
    /**
     * Attach the current tenant when the model is created.
     * @see Model::boot()
     * @see Model::bootTraits()
     * @return void
     */
    public static function bootHasTenant(): void
    {
        static::creating(function (Model $model) {
            $model->tenant_id = 1;
        });
    }
}
