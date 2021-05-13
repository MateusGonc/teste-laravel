<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class Usuario extends Model
{
    use HasApiTokens, Authenticatable;

    protected $table = 'usuarios';
    
    protected $fillable = ['nome', 'email', 'senha'];

    protected $hidden = ['senha'];

    public function validateForPassportPasswordGrant($password)
    {
        
        
        return Hash::check($password, $this->senha);
    }
}
