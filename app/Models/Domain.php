<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $table = 'domains';

    protected $fillable = [
        'domain_num',
        'title',
        'abbreviation',
        'description'
    ];

    public function ccmcontrols()
    {
        return $this->hasMany(CCMControl::class);
    }
}
