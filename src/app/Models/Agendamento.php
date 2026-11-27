<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $table = 'tbl_agendamento';

    protected $primaryKey = 'id_agendamento';

    public const CREATED_AT = 'data_criacao_agendamento';

    public const UPDATED_AT = 'data_atualizacao_agendamento';

    protected $fillable = [
        'id_cliente',
        'id_servico',
        'id_horario',
        'data_agendamento',
        'status_agendamento'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
     public function servico(){
        return $this->belongsTo(Servico::class, 'id_servico', 'id_servico');
    }
     public function horario(){
        return $this->belongsTo(Cliente::class, 'id_horario', 'id_horario');
    }
}

