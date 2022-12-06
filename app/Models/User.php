<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'password_temp',
        'firstname',
        'lastname',
        'job_title',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function historical_user_lastopened()        
    {
        return $this->hasMany($this, 'historical_user_lastopened', 'user_id', 'questionnaire_id');
    }
/*
    public function created_questionnaires()        // Relacion 1:N entre QUESTIONNAIRE - USERS (accion de crear cuestionarios, no responderlos)
    {
        return $this->hasMany(Questionnaire::class);
    }

    public function lastupdate_questionnaires()     // Relacion 1:N entre QUESTIONNAIRE - USERS (accion de actualizar cuestionarios, no responderlos)
    {
        return $this->hasMany(Questionnaire::class);
    }
*/
}
