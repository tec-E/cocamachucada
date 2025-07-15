<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombre',
        'descripcion',
        'precio',
        'cantidad',
        'imagen',
        'user_id',
        'categoria_id',
    ];
    //relacion  de mucho a uno con el modelo usuario
    public function user(){
        return $this->belongsTo(User::class);
    }
    //relacion de mucho a uno con el modelo categoria
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
}
