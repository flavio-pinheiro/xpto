<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bolsa;


class Aluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'cpf',
        'nascimento',
        'fone',
        'nascionalidade',
        'foto',
        'user_id',
        'adulto_id',
        'autorizacao'

    ];

    //Relacionamento com a tabela Adulto
    public function adulto(){
    	return $this->belongsTo('App\Models\Adulto');
    }

    //Relacionamento com a tabela Bolsao
    public function bolsas(){
    	return $this->belongsToMany('App\Models\Bolsa');
    }

}
