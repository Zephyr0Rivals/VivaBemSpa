<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

Class Eventos extends Model{

    protected $table = 'tbl_eventos';
    protected $primaryKey = 'id_eventos';

    public $timestamps = false;

    protected $fillable = [
        'id_categoria',
        'imagem_eventos',
        'data_eventos',
        'nome_eventos',
        'status_eventos',
        'descricao_eventos'
    ];
}