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



    //     protected $openAi;

    //     public function __construct()
    //     {
    //         // Inicializa la instancia del cliente de OpenAI
    //         $client = OpenAI::client(env('OPENAI_API_KEY'));
    //     }

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
