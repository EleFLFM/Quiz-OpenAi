<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReinforcementTopic extends Model
{
    use HasFactory;

    // Definir las columnas que pueden asignarse masivamente
    protected $fillable = ['test_id', 'topic'];

    // Relación con el modelo Test
    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
