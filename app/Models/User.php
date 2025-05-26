<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'status' => 'boolean'
        ];
    }



    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    /**
     * sccessor for avater attribute
     * @param mixed $url
     * @return string
     */
    public function getAvatarAttribute($url): string
    {
        if ($url) {
            if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {
                return $url;
            } else {
                return asset('storage/' . $url);
            }
        } else {
            return asset('assets/img/user_placeholder.png');
        }
    }

    /**
     * profile
     * @return HasOne<Profile, User>
     */
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * otps
     * @return HasMany<OTP, User>
     */
    public function otps(): HasMany
    {
        return $this->hasMany(OTP::class);
    }

    /**
     * Getting the role of the user
     *
     * @return BelongsTo<Role, User>
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * engineer
     * @return HasOne<Engineer, User>
     */
    public function engineer(): HasOne
    {
        return $this->hasOne(Engineer::class);
    }

    /**
     * gasSafetyRegistration
     * @return HasOne<GasSafetyRegistration, User>
     */
    public function gsr(): HasOne
    {
        return $this->hasOne(GasSafetyRegistration::class);
    }

    /**
     * NVQQualification
     * @return HasOne<NVQQualification, User>
     */
    public function nvq(): HasOne
    {
        return $this->hasOne(NVQQualification::class);
    }

    /**
     * drivingLicence
     * @return HasOne<DrivingLicence, User>
     */
    public function drivingLicence(): HasOne
    {
        return $this->hasOne(DrivingLicence::class);
    }

    /**
     * niceic
     * @return HasOne<NICEIC, User>
     */
    public function niceic(): HasOne
    {
        return $this->hasOne(NICEIC::class);
    }

    /**
     * backAccount
     * @return HasOne<BankAccount, User>
     */
    public function backAccount()
    {
        return $this->hasOne(BankAccount::class);
    }

    /**
     * reviews user given
     * @return HasMany<Review, User>
     */
    public function reviewsGiven(): HasMany
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    /**
     * reviews Received
     * @return HasMany<Review, User>
     */
    public function reviewsReceived(): HasMany
    {
        return $this->hasMany(Review::class, 'engineer');
    }

    /**
     * plans
     * @return BelongsToMany<Plan, User, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function plans(): BelongsToMany
    {
        return $this->belongsToMany(Plan::class);
    }

    /**
     * properties
     * @return HasMany<Property, User>
     */
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    /**
     * jobes I posted
     * @return HasMany<PropertyJob, User>
     */
    public function postedJobs(): HasMany
    {
        return $this->hasMany(PropertyJob::class, 'user_id');
    }

    /**
     * assigned Jobs
     * @return HasMany<PropertyJob, User>
     */
    public function assignedJobs(): HasMany
    {
        return $this->hasMany(PropertyJob::class, 'engineer');
    }

    /**
     * sender
     * @return BelongsTo<User, User>
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    /**
     * receiver
     * @return BelongsTo<User, User>
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * onlineHours
     * @return BelongsToMany<OnlineHour, User, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function onlineHours(): BelongsToMany
    {
        return $this->belongsToMany(OnlineHour::class);
    }
}
