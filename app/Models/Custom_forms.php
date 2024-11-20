<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomForm extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar de forma masiva.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'test_id',
        'questions',
        'level',
        'generated_at',
    ];

    /**
     * Relación con el modelo User (Estudiante que recibe el formulario personalizado).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con el modelo Test (Test inicial del que se derivó este formulario personalizado).
     */
    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    /**
     * Convertir las preguntas en un array al acceder al atributo.
     *
     * @param string $value
     * @return array
     */
    public function getQuestionsAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * Almacenar las preguntas como JSON al asignar el atributo.
     *
     * @param array $value
     */
    public function setQuestionsAttribute($value)
    {
        $this->attributes['questions'] = json_encode($value);
    }
}
