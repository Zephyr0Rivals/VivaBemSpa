<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model{
    
    protected $table = 'tbl_cliente';

    protected $primaryKey = 'id_cliente';

    public const CREATED_AT = 'data_criacao_cliente';
    public const UPDATED_AT = 'data_atualizacao_cliente';

    protected $fillable = [
        'nome_cliente',
        'email_cliente',
        'senha_cliente',
        'telefone_cliente',
        'foto_cliente',
        'genero_cliente',
    ];

    protected $hidden = [
        'senha_cliente', // Esconde a senha por segurança
    ];

    public function depoimentos(){
        return $this->hasMany(Depoimento::class, 'id_cliente', 'id_cliente');
    }
    public function favoritos(){
        return $this->hasMany(Favoritos::class, 'id_cliente', 'id_cliente');
    }
}
