<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'organizations';

    protected $fillable = [
        'account_owner',
        'name',
        'cif',
        'address',
        'website',
        'logo'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function questions()                     // Relacion ternaria N:M:1 entre QUESTIONNAIRES - QUESTIONS - ORGANIZATIONS (accion de responder preguntas de un cuestionario)
    {
        return $this->belongsToMany(Question::class, 'questionn_org_question')
            ->withPivot('questionnaire_id', 'csp_caiq_answer', 'ssrm_control_ownership','csp_implementation_description','csc_responsibilities');
    }

    public function questionnaires()                // Relacion ternaria N:M:1 entre QUESTIONNAIRES - QUESTIONS - ORGANIZATIONS (accion de responder preguntas de un cuestionario)
    {
        return $this->belongsToMany(Questionnaire::class, 'questionn_org_question')
            ->withPivot('question_id', 'csp_caiq_answer', 'ssrm_control_ownership','csp_implementation_description','csc_responsibilities');
    }
}
