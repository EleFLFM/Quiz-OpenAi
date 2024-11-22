<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenAIService
{
    protected $apiUrl = 'https://api.openai.com/v1/';
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
    }

    /**
     * Evalúa un test enviando preguntas y respuestas a la API de OpenAI.
     *
     * @param array $questionsAndAnswers Array asociativo con las preguntas y respuestas correctas y del usuario.
     * @return array Respuesta con la calificación y los temas a reforzar.
     */
    public function evaluateTest(array $questionsAndAnswers): array
    {
        // Preparamos el contexto con las preguntas, respuestas correctas y las del usuario
        $formattedQuestions = [];
        foreach ($questionsAndAnswers as $item) {
            $formattedQuestions[] = [
                'pregunta' => $item['pregunta'],
                'respuesta_correcta' => $item['respuesta_correcta'],
                'respuesta_usuario' => $item['respuesta_usuario'],
            ];
        }

        // Construimos el prompt
        $prompt = "Evalúa las siguientes preguntas y respuestas. Compara las respuestas del usuario con las respuestas correctas y genera un resultado en formato JSON como el siguiente:

        {
            \"calificacion\": \"X/10\",
            \"temas_refuerzo\": [
                \"Tema 1\",
                \"Tema 2\",
                \"Tema 3\"
            ]
        }

        Aquí están las preguntas y respuestas para evaluar:
        " . json_encode($formattedQuestions);

        // Llamada a la API de OpenAI
        $response = Http::withToken($this->apiKey)->post($this->apiUrl . 'chat/completions', [
            'model' => 'gpt-4',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Eres un evaluador experto en programación y educación.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'max_tokens' => 500,
            'temperature' => 0.3, // Menos creatividad, más precisión
        ]);

        // Procesar la respuesta
        if ($response->ok()) {
            $responseBody = json_decode($response->body(), true);
            if (isset($responseBody['choices'][0]['message']['content'])) {
                $evaluation = json_decode($responseBody['choices'][0]['message']['content'], true);

                if (isset($evaluation['calificacion']) && isset($evaluation['temas_refuerzo'])) {
                    return $evaluation;
                }
            }
        }

        // En caso de error, retorna un valor por defecto o lanza una excepción
        throw new \Exception('Error al procesar la respuesta de OpenAI.');
    }
}
