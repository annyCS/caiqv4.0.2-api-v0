<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'organizations';

    protected $fillable = [
        'email_account_owner',
        'company_name',
        'profile',
        'cif',
        'address',
        'country',
        'state',
        'zipcode',
        'website',
        'logo_url',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function questionnaires()                
    {
        return $this->hasMany(Questionnaire::class);
    }
}
