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

    public function organizations()              
    {
        return $this->belongsTo(Organization::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'pivot_answers', 'questionnaire_id', 'question_id')
            ->withPivot('csp_caiq_answer', 'ssrm_control_ownership','csp_implementation_description','csc_responsibilities');
    }
}
