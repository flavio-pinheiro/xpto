<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Aluno;

class Bolsa extends Model
{
    use HasFactory;

    protected $casts = [
    	'vencedores' => 'array' 
    ];

    //Relacionamento com a tabela Aluno
    public function alunos(){
    	return $this->belongsToMany('App\Models\Aluno');
    }

}
