<?php

namespace App\Services;

use GuzzleHttp\Client;

use Illuminate\Support\Facades\Http;

class OpenAIService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('services.openai.base_url'),
            'headers' => [
                'Authorization' => 'Bearer ' . config('services.openai.api_key'),
                'Content-Type'  => 'application/json',
            ],
        ]);
    }

    public function evaluateTest($questionsAndAnswers)
    {
        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => 'gpt-3.5-turbo', // Cambia aquí el modelo
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Por favor, evalúa las respuestas del test y devuelve la información en el siguiente formato:

                            {
                                "calificacion": "X/10",
                                "temas_refuerzo": [
                                    "Tema 1",
                                    "Tema 2",
                                    "Tema 3"
                                ]
                            }'
                    ],

                ],
                'max_tokens' => 100,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
