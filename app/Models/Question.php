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

    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class, 'pivot_answers', 'question_id', 'questionnaire_id')
            ->withPivot('csp_caiq_answer', 'ssrm_control_ownership','csp_implementation_description','csc_responsibilities');
    }
}
