<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $connection = 'pgsql';
    protected $table = 'produtos';
    protected $fillable = [
        'nome', 
        'descricao',
        'tensao',
        'marca_id',
    ];   
    public function marca()
    {
        return $this->belongsTo('App\Models\Marca', 'marca_id');
    }
}
