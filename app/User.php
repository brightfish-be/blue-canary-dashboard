<?php namespace App;

use App\Traits\HasTenant;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * User model
 *
 * @copyright 2019 Brightfish
 * @author Arnaud Coolsaet <a.coolsaet@brightfish.be>
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRolesAndAbilities, HasTenant;

    /** {@inheritdoc} */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /** {@inheritdoc} */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /** {@inheritdoc} */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** {@inheritdoc} */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /** {@inheritdoc} */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the tenant for this user.
     * @return BelongsTo
     */
    public function tenant()
    {
        return $this->belongsTo('App\Tenant');
    }
}
