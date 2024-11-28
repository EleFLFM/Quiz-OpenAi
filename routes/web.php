<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\educationalContent;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('login.index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', [AdminController::class, 'show'])->name('admin.show');
Route::get('/test', [TestController::class, 'show'])->name('test.show');
Route::post('/test/submit', [TestController::class, 'submit'])->name('test.submit');
Route::post('/evaluate-test', [TestController::class, 'evaluate']);



require __DIR__ . '/auth.php';

use App\Services\OpenAIService;

Route::get('/prueba', function (OpenAIService $openAIService) {
    // Crea un ejemplo de preguntas y respuestas de prueba
    $questionsAndAnswers = [
        [
            'question' => '¿Qué es una variable en programación?',
            'answer' => 'Es un espacio en memoria donde se almacena información.'
        ],
        [
            'question' => '¿Qué es un bucle for?',
            'answer' => 'Es una estructura de control que repite código varias veces.'
        ],
    ];

    // Llama al servicio para evaluar el test
    $response = $openAIService->evaluateTest($questionsAndAnswers);

    // Devuelve la respuesta para inspeccionarla
    return response()->json($response);
});

Route::get('/student/educational-content', [educationalContent::class, 'educationalContent'])
    ->name('student.educational-content')
    ->middleware('auth');