<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Tenant model
 *
 * @property int $id
 * @property string $name
 *
 * @copyright 2019 Brightfish
 * @author Arnaud Coolsaet <a.coolsaet@brightfish.be>
 */
class Tenant extends Model
{
    /** {@inheritdoc} */
    protected $fillable = [
        'name', 'country', 'lang', 'logo',
    ];

    /** {@inheritdoc} */
    protected $casts = [
        'name' => 'string',
        'country' => 'string',
        'lang' => 'string',
        'logo' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the users for this tenant.
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * Get the apps for this tenant.
     * @return HasMany
     */
    public function apps()
    {
        return $this->hasMany('App\App');
    }
}
