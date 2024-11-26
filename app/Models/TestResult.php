<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'calificacion',
        'puntaje',
        'temas_refuerzo',
    ];

    protected $casts = [
        'temas_refuerzo' => 'array', // Decodifica automáticamente el JSON a un array
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
