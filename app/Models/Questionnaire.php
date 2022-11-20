<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

    protected $table = 'questionnaires';

    protected $fillable = [
        'name',
        'description',
        'created_at',
        'lastupdate_at'
    ];

    public function created_by()            // Relacion 1:N entre QUESTIONNAIRE - USERS (accion de crear cuestionarios, no responderlos)
    {
        return $this->belongsTo(User::class);
    }

    public function lastupdate_by()         // Relacion 1:N entre QUESTIONNAIRE - USERS (accion de actualizar cuestionarios, no responderlos)  
    {
        return $this->belongsTo(User::class);
    }

    public function user()                  // Relacion ternaria N:M:1 entre QUESTIONNAIRES - QUESTIONS - USERS (accion de responder preguntas de un cuestionario)
    {
        return $this->belongsToMany(User::class, 'questionnaire_user_question')
            ->withPivot('question_id', 'csp_caiq_answer', 'ssrm_control_ownership','csp_implementation_description','csc_responsibilities');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'questionnaire_user_question')
            ->withPivot('user_id', 'csp_caiq_answer', 'ssrm_control_ownership','csp_implementation_description','csc_responsibilities');
    }
}
