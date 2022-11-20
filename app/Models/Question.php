<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'code',
        'title'
    ];

    public function ccmcontrol()
    {
        return $this->belongsTo(CCMControl::class);
    }

    // Relacion ternaria N:M:1 entre QUESTIONNAIRES - QUESTIONS - USERS (accion de responder preguntas de un cuestionario)
    public function users()
    {
        return $this->belongsToMany(User::class, 'questionnaire_user_question')
            ->withPivot('questionnaire_id', 'csp_caiq_answer', 'ssrm_control_ownership','csp_implementation_description','csc_responsibilities');
    }

    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class, 'questionnaire_user_question')
            ->withPivot('user_id', 'csp_caiq_answer', 'ssrm_control_ownership','csp_implementation_description','csc_responsibilities');
    }
}
