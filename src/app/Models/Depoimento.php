<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depoimento extends Model{
    protected $table = 'tbl_depoimento';

    protected $primaryKey = 'id_depoimento';

    public const CREATED_AT = 'data_criacao_depoimento';
    public const UPDATED_AT = 'data_atualizacao_depoimento';

    protected $fillable = [
        'id_cliente',
        'id_servico',
        'titulo_depoimento',
        'descricao_depoimento',
        'nota_depoimento',
    ];

    public function servicos(){
        return $this->belongsTo(Servico::class, 'id_servico', 'id_servico');
    }
    public function clientes(){
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
}