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
        'username',
        'email',
        'password',
        'password_temp',
        'name',
        'lastname',
        'job_position'
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

    public function created_questionnaires()        // Relacion 1:N entre QUESTIONNAIRE - USERS (accion de crear cuestionarios, no responderlos)
    {
        return $this->hasMany(Questionnaire::class);
    }

    public function lastupdate_questionnaires()     // Relacion 1:N entre QUESTIONNAIRE - USERS (accion de actualizar cuestionarios, no responderlos)
    {
        return $this->hasMany(Questionnaire::class);
    }

    public function questions()                     // Relacion ternaria N:M:1 entre QUESTIONNAIRES - QUESTIONS - USERS (accion de responder preguntas de un cuestionario)
    {
        return $this->belongsToMany(Question::class, 'questionnaire_user_question')
            ->withPivot('questionnaire_id', 'csp_caiq_answer', 'ssrm_control_ownership','csp_implementation_description','csc_responsibilities');
    }

    public function questionnaires() // Relacion ternaria N:M:1 entre QUESTIONNAIRES - QUESTIONS - USERS (accion de responder preguntas de un cuestionario)
    {
        return $this->belongsToMany(Questionnaire::class, 'questionnaire_user_question')
            ->withPivot('question_id', 'csp_caiq_answer', 'ssrm_control_ownership','csp_implementation_description','csc_responsibilities');
    }
}
