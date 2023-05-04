<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['cep', 'logradouro', 'complemento', 'bairro', 'localidade', 'uf'];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
