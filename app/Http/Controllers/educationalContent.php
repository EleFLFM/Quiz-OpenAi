<?php

namespace App\Http\Controllers;

use App\Services\OpenAIService;
use App\Models\TestResult;

use Illuminate\Http\Request;

class educationalContent extends Controller
{
    public function educationalContent(OpenAIService $openAIService)
    {
        $userId = auth()->id();

        // Obtener el último resultado del test del usuario autenticado
        $testResult = TestResult::where('user_id', $userId)->latest()->first();

        if (!$testResult) {
            return redirect()->route('test.index')->with('error', 'No tienes resultados de test aún.');
        }

        // Temas de refuerzo del test
        $topics = $testResult->temas_refuerzo;

        // Generar contenido educativo con OpenAI
        $response = $openAIService->generateEducationalContent($topics);

        return view('student.educational-content', [
            'content' => $response,
            'topics' => $topics,
        ]);
    }
}
