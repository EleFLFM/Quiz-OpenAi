<?php

namespace App\Http\Controllers;

use App\Models\ReinforcementTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Test;
use App\Models\Response;
use App\Models\TestResult;
use OpenAI\Client;
use Exception;
use OpenAI;
use App\Services\OpenAIService;





class TestController extends Controller
{
    private $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function evaluate(Request $request)
    {
        $data = $request->validate([
            'responses' => 'required|array',
        ]);

        $evaluation = $this->openAIService->evaluateTest($data['responses']);

        return response()->json($evaluation);
    }



    // Muestra la vista del test inicial
    public function show()
    {
        // Array de preguntas de ejemplo
        $questions = [
            "¿Qué es una variable en programación?",
            "¿Qué diferencia hay entre una lista y un diccionario?",
            "Explica brevemente qué es un bucle 'for'.",
            "¿Qué es la recursividad y cuándo se utiliza?",
            "¿Cuál es la diferencia entre una función y un método?",
        ];

        return view('test.show', compact('questions'));
    }























    public function submit(Request $request, OpenAIService $openAIService)
    {
        // Capturar las respuestas del formulario
        $responses = $request->input('responses');




        // Convertir las respuestas en un formato procesable para OpenAI
        $questionsAndAnswers = [];
        foreach ($responses as $index => $response) {
            $questionsAndAnswers[] = [
                'question' => "Pregunta $index",
                'answer' => $response,
            ];
        }

        // Enviar las respuestas a OpenAI para su evaluación
        $evaluation = $openAIService->evaluateTest($questionsAndAnswers);

        // Verificar si la clave 'choices' está presente en la respuesta
        if (isset($evaluation['choices']) && !empty($evaluation['choices'])) {
            $feedback = $evaluation['choices'][0]['message']['content'];
        } else {
            // Manejar el caso de error o respuesta inesperada
            $feedback = "Hubo un error al procesar la respuesta de OpenAI. Por favor, intenta de nuevo.";
        }

        // Decodificar la respuesta JSON
        $responseData = json_decode($feedback, true);

        // Obtener calificación y temas
        $puntaje = $responseData['calificacion'];
        $temas = $responseData['temas_refuerzo'];

        // Extraer la calificación como porcentaje
        $calificacion = $responseData['calificacion'] ?? '0/10';
        [$obtenido, $total] = explode('/', $calificacion);
        $puntaje = ($total > 0) ? ($obtenido / $total) * 100 : 0;


        TestResult::create([
            'user_id' => auth()->id(), // Requiere autenticación
            'calificacion' => $calificacion,
            'puntaje' => $puntaje,
            'temas_refuerzo' => $responseData['temas_refuerzo'] ?? [],
        ]);

        // Mostrar la retroalimentación en una vista
        return view('test.results', compact('feedback', 'puntaje', 'temas'));
    }
}
