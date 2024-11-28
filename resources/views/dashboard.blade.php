@extends('layouts.app')

@section('main')

<div class="welcome-content">
    <h1>Bienvenido, {{ auth()->user()->name ?? 'Estudiante' }}!</h1>
    <p>
        Estamos encantados de que estés aquí. Este es un espacio diseñado para ayudarte a mejorar tus habilidades y aprender de manera personalizada.
    </p>
    <a href="{{ route('test.show') }}" class="btn-primary btn-center">Elaborar Test</a>
</div>


@endsection
<style>
    /* Container */
    .container {
        max-width: 800px;
        margin: 40px auto;
        padding: 25px;
        background: linear-gradient(135deg, #fdfbfb, #ebedee);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        font-family: 'Roboto', sans-serif;
    }

    /* Header */
    h1 {
        color: #333333;
        font-size: 2.2rem;
        margin-bottom: 20px;
        text-align: center;
        font-weight: bold;
        padding-bottom: 10px;
        border-bottom: 3px solid #007bff;
        background: linear-gradient(90deg, #007bff, #00c6ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Labels */
    .form-label {
        display: block;
        margin-bottom: 8px;
        color: #495057;
        font-weight: 500;
        font-size: 1.1em;
    }

    /* Input Fields */
    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #ced4da;
        border-radius: 6px;
        font-size: 1rem;
        transition: box-shadow 0.3s ease, transform 0.2s ease;
    }

    .form-control:focus {
        border-color: #56cfe1;
        outline: none;
        box-shadow: 0 4px 10px rgba(86, 207, 225, 0.3);
        transform: scale(1.02);
    }



    /* Responsive Adjustments */
    @media (max-width: 576px) {
        .container {
            padding: 20px;
        }

        h1 {
            font-size: 1.8rem;
        }

        .btn-primary {
            max-width: 100%;
        }
    }
</style>
<style>
    /* General Styles */
    .welcome-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 25px;
        background: linear-gradient(135deg, #fdfbfb, #ebedee);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        font-family: 'Roboto', sans-serif;
    }

    .welcome-content {
        max-width: 800px;
        margin: 40px auto;
        padding: 25px;
        background: linear-gradient(135deg, #fdfbfb, #ebedee);
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        font-family: 'Roboto', sans-serif;
    }

    /* Header */
    h1 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        background: linear-gradient(90deg, #007bff, #00c6ff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Paragraph */
    p {
        font-size: 1.2rem;
        line-height: 1.8;
        color: #555;
        margin-bottom: 30px;
    }

    .btn-center {
        display: block;
        margin: 20px auto;
        /* Automático para centrar */
        text-align: center;
        /* Asegura el contenido centrado dentro del botón */
    }

    /* Button */
    .btn-primary {
        display: inline-block;
        padding: 12px 24px;
        background: linear-gradient(45deg, #007bff, #0056b3);
        color: white;
        font-size: 1.1em;
        font-weight: bold;
        border: none;
        border-radius: 6px;
        text-decoration: none;
        text-transform: uppercase;
        transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #0056b3, #003d80);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 91, 187, 0.4);
    }

    .btn-primary:active {
        transform: translateY(1px);
    }

    /* Responsive Adjustments */
</style>