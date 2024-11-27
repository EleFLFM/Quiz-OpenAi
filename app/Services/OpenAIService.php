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
                        'content' => 'Evalúa las respuestas del test y responde en este formato JSON:
                        {
                            "calificacion": "X/10",
                            "temas_refuerzo": [
                                "Tema 1",
                                "Tema 2",
                                "Tema 3"
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
}
