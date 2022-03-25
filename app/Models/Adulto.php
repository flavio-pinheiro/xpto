<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adulto extends Model
{
    use HasFactory;

    //Relacionamento com a tabela Alunos
    public function alunos(){
    	return $this->hasMany('\App\Models\Aluno');
    }

}
