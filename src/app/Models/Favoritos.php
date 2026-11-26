<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favoritos extends Model{
    
    protected $table = 'tbl_favoritos';

    protected $primaryKey = 'id_favoritos';

    public const CREATED_AT = 'data_criacao_favoritos';
    public const UPDATED_AT = 'data_atualizacao_favortios';

    protected $fillable = [
        'id_servicos'       
    ];

    public function servicos(){
        return $this->belongsTo(Servico::class, 'id_servico', 'id_servico');
    }
    public function clientes(){
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
}