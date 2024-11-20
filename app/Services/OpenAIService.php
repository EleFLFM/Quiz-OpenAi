<?php

namespace App\Services;

use GuzzleHttp\Client;

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
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Eres un asistente que analiza tests de programación y crea contenido educativo personalizado.',
                    ],
                    [
                        'role' => 'user',
                        'content' => "Califica este test: " . json_encode($questionsAndAnswers) .
                            " y sugiere temas para reforzar en las áreas de bajo rendimiento.",
                    ],
                ],
                'max_tokens' => 1500,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
