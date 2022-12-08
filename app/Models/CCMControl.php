<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CCMControl extends Model
{
    use HasFactory;

    protected $table = 'ccmcontrols';

    protected $fillable = [
        'code',
        'title',
        'specification',
        'guidelines',
    ];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
