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
        'title',
    ];

    public function ccmcontrol()
    {
        return $this->belongsTo(CCMControl::class);
    }

    // Relacion ternaria N:M:1 entre QUESTIONNAIRES - QUESTIONS - ORGANIZATIONS (accion de responder preguntas de un cuestionario)
    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'questionn_org_question')
            ->withPivot('questionnaire_id', 'csp_caiq_answer', 'ssrm_control_ownership','csp_implementation_description','csc_responsibilities');
    }

    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class, 'questionn_org_question')
            ->withPivot('organization_id', 'csp_caiq_answer', 'ssrm_control_ownership','csp_implementation_description','csc_responsibilities');
    }
}
