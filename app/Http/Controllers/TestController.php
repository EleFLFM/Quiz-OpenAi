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
            "Explica brevemente qué es un bucle 'for'.",
            "¿Qué es la recursividad y cuándo se utiliza?",
            "¿Cuál es la diferencia entre una función y un método?",
            "¿Qué significa que un lenguaje de programación es 'tipado'?",
            "Menciona las ventajas de usar programación orientada a objetos.",
            "¿Qué es una excepción y cómo se maneja?",
            "Describe el concepto de 'algoritmo'.",
            "¿Qué es un framework y por qué se usa?"
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

        // Procesar la respuesta para extraer la calificación y los temas a reforzar


        // // Buscar y extraer la calificación
        // if (strpos($feedback, 'Calificación del test:') !== false) {
        //     $startPos = strpos($feedback, 'Calificación del test:') + strlen('Calificación del test:');
        //     $endPos = strpos($feedback, 'Temas a reforzar:') !== false ? strpos($feedback, 'Temas a reforzar:') : strlen($feedback);
        //     $rating = trim(substr($feedback, $startPos, $endPos - $startPos));
        // }

        // // Buscar y extraer los temas a reforzar
        // if (strpos($feedback, 'Temas a reforzar:') !== false) {
        //     $startPos = strpos($feedback, 'Temas a reforzar:') + strlen('Temas a reforzar:');
        //     $reinforceTopics = trim(substr($feedback, $startPos));
        // }


        // Decodificar la respuesta JSON
        $responseData = json_decode($feedback, true);

        // Obtener calificación y temas
        $puntaje = $responseData['calificacion'];
        $temas = $responseData['temas_refuerzo'];


        // Mostrar la retroalimentación en una vista
        // return view('test.results', compact('rating', 'reinforceTopics', 'feedback'));
        return view('test.results', compact('feedback', 'puntaje', 'temas'));
    }

    //     // Procesa las respuestas del test
    //     public function submit(Request $request)
    //     {


    //         // Validación de las respuestas del formulario
    //         $validated = $request->validate([
    //             'answers' => 'required|array|min:10', // Debe enviarse un mínimo de 10 respuestas
    //             'answers.*' => 'required|string' // Cada respuesta debe ser una cadena de texto
    //         ]);

    //         // Crea un registro del test en la base de datos
    //         $test = new Test;
    //         $test->user_id = Auth::id(); // Asocia el test al usuario autenticado
    //         $test->save();

    //         // Guarda cada respuesta en la base de datos
    //         foreach ($validated['answers'] as $question => $answer) {
    //             $response = new Response;
    //             $response->test_id = $test->id; // Relaciona la respuesta con el test
    //             $response->question = $question; // Guarda la pregunta
    //             $response->answer = $answer; // Guarda la respuesta dada
    //             $response->save();
    //         }

    //         // Identifica respuestas incorrectas
    //         $incorrectAnswers = [];
    //         foreach ($validated['answers'] as $question => $answer) {
    //             if (!$this->isCorrectAnswer($question, $answer)) {
    //                 $incorrectAnswers[$question] = $answer; // Guarda las respuestas incorrectas
    //             }
    //         }

    //         // Si no hay respuestas incorrectas, redirige con un mensaje de éxito
    //         if (empty($incorrectAnswers)) {
    //             return redirect()->route('test.show')
    //                 ->with('success', 'Test enviado correctamente. No se encontraron áreas de refuerzo.');
    //         }

    //         try {
    //             // Genera un prompt para OpenAI basado en las respuestas incorrectas
    //             $prompt = "Dado el siguiente conjunto de preguntas y respuestas incorrectas, genera una lista de temas para reforzar:\n"
    //                 . json_encode($incorrectAnswers);

    //             // Envía las respuestas incorrectas a OpenAI
    //             $openAiResponse = $this->openAi->completions()->create([
    //                 'model' => 'text-davinci-003',
    //                 'prompt' => $prompt,
    //                 'max_tokens' => 150,
    //             ]);

    //             // Verifica si la respuesta de OpenAI contiene texto válido
    //             if (!isset($openAiResponse['choices'][0]['text'])) {
    //                 throw new Exception('La respuesta de la API no es válida.');
    //             }

    //             // Procesa los temas generados por OpenAI
    //             $topicsToReinforce = json_decode($openAiResponse['choices'][0]['text'], true);

    //             // Guarda los temas de refuerzo en la base de datos
    //             foreach ($topicsToReinforce as $topic) {
    //                 $reinforcement = new ReinforcementTopic;
    //                 $reinforcement->test_id = $test->id; // Relaciona el tema con el test
    //                 $reinforcement->topic = $topic; // Guarda el tema generado
    //                 $reinforcement->save();
    //             }
    //         } catch (Exception $e) {
    //             // Si ocurre un error, redirige con un mensaje indicando el problema
    //             return redirect()->route('test.show')
    //                 ->withErrors('Hubo un problema al procesar el test: ' . $e->getMessage());
    //         }

    //         // Redirige al usuario a una vista con los temas generados
    //         return redirect()->route('reinforcement.show', ['id' => $test->id])
    //             ->with('success', 'Test enviado correctamente. Los temas de refuerzo han sido generados.');
    //     }

    //     // Genera el prompt para la API de OpenAI
    //     private function generatePrompt($answers)
    //     {
    //         $prompt = "Analiza las siguientes respuestas de un test de programación y genera un formulario personalizado para el nivel del estudiante:\n";
    //         foreach ($answers as $question => $answer) {
    //             $prompt .= "Pregunta: $question\nRespuesta: $answer\n";
    //         }
    //         return $prompt;
    //     }
}
