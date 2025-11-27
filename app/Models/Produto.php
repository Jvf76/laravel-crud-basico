<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser preenchidos em massa.
     */
    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'imagem_path', // <-- GARANTIMOS QUE O NOME CORRETO ESTÁ AQUI
    ];
}
