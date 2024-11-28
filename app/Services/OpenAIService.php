<?php

namespace App\Services;

use GuzzleHttp\Client;

class OpenAIService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function evaluateTest(array $questionsAndAnswers)
    {
        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Evalúa las respuestas del test y responde en este formato JSON, los temas de refuerzo son respecto a la programcion:
                        {
                            "calificacion": "X/10",
                            "temas_refuerzo": [
                                "Tema 1",
                                "Tema 2",
                                "Tema 3",
                                "etc"
                            ]
                        }'
                    ],
                    [
                        'role' => 'user',
                        'content' => json_encode($questionsAndAnswers),
                    ],
                ],
                'max_tokens' => 500,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function generateEducationalContent(array $topics)
    {
        $topicsText = implode(", ", $topics);

        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => 'gpt-4',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Eres un tutor experto en programación. Proporciona contenido educativo claro y conciso sobre los siguientes temas.'
                    ],
                    [
                        'role' => 'user',
                        'content' => "Por favor, genera contenido educativo para los siguientes temas: {$topicsText}."
                    ]
                ],
                'max_tokens' => 500,
            ],
        ]);

        $responseData = json_decode($response->getBody(), true);
        return $responseData['choices'][0]['message']['content'] ?? 'No se pudo generar contenido educativo.';
    }
}
