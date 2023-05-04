<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mother_name',
        'birthdate',
        'cpf',
        'cns',
        'photo',
        'address_id'
    ];

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
    
    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
