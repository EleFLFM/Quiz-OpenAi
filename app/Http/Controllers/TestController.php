<?php

namespace App\Http\Controllers;

use App\Models\ReinforcementTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Test;
use App\Models\Response;
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
            "Explica brevemente qué es un bucle 'for'."
        ];

        return view('test.show', compact('questions'));
    }















    public function submitTest(Request $request, OpenAIService $openAIService)
    {
        $questions = [
            '¿Qué es una variable?',
            '¿Qué es un bucle for?'
        ];

        $correctAnswers = [
            'Un contenedor para almacenar datos.',
            'Un bucle que se ejecuta un número específico de veces.'
        ];

        // Construir el array de preguntas y respuestas
        $questionsAndAnswers = [];
        foreach ($questions as $index => $question) {
            $questionsAndAnswers[] = [
                'pregunta' => $question,
                'respuesta_correcta' => $correctAnswers[$index],
                'respuesta_usuario' => $request->input("responses.$index") // Capturar la respuesta del formulario
            ];
        }

        try {
            // Llamar al servicio para evaluar
            $result = $openAIService->evaluateTest($questionsAndAnswers);

            // Mostrar resultados en la vista
            return view('test.result2', [
                'calificacion' => $result['calificacion'],
                'temas_refuerzo' => $result['temas_refuerzo']
            ]);
        } catch (\Exception $e) {
            // Manejo de errores
            return back()->withErrors('Hubo un problema al procesar el test: ' . $e->getMessage());
        }
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


        // Mostrar la retroalimentación en una vista
        return view('test.results', compact('feedback', 'puntaje', 'temas'));
    }
}
