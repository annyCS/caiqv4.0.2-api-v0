<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $table = 'questions';

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
}
