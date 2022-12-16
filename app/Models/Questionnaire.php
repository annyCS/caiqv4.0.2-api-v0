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
        'created_by',
        'lastupdate_at',
        'lastupdate_by',
        'status',
    ];

    public function historical_user_lastopened()        
    {
        return $this->hasMany($this, 'historical_user_lastopened', 'user_id', 'questionnaire_id');
    }
/*
    public function created_by()            // Relacion 1:N entre QUESTIONNAIRE - USERS (accion de crear cuestionarios, no responderlos)
    {
        return $this->belongsTo(User::class);
    }

    public function lastupdate_by()         // Relacion 1:N entre QUESTIONNAIRE - USERS (accion de actualizar cuestionarios, no responderlos)  
    {
        return $this->belongsTo(User::class);
    }
*/
    public function organizations()                  // Relacion ternaria N:M:1 entre QUESTIONNAIRES - QUESTIONS - ORGANIZATIONS (accion de responder preguntas de un cuestionario)
    {
        return $this->belongsToMany(Organization::class, 'questionn_org_question', 'questionnaire_id', 'organization_id')
            ->withPivot('csp_caiq_answer', 'ssrm_control_ownership','csp_implementation_description','csc_responsibilities');
            // ->withPivot('question_id', 'csp_caiq_answer', 'ssrm_control_ownership','csp_implementation_description','csc_responsibilities');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'questionn_org_question', 'questionnaire_id', 'question_id')
            ->withPivot('csp_caiq_answer', 'ssrm_control_ownership','csp_implementation_description','csc_responsibilities');
            // ->withPivot('organization_id', 'csp_caiq_answer', 'ssrm_control_ownership','csp_implementation_description','csc_responsibilities');
    }
}
