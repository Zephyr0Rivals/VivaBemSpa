<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Models;

class Horario extends Model{
    
    protected $table = 'tbl_horario';
    protected $primaryKey = 'id_horario';

    public $timestamps = false;

    protected $fillable = [
        'inicio_horario',
        'final_horario'
    ];

    public function agendamentos(){
        return $this->hasMany(Agendamento::class, 'id_horario', 'id_horario');
    }
}