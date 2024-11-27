<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenido Educativo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .topics {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .content {
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Contenido Educativo Personalizado</h1>

        <div class="topics">
            <h3>Temas de Refuerzo:</h3>
            <ul>
                @foreach ($topics as $topic)
                <li>{{ $topic }}</li>
                @endforeach
            </ul>
        </div>

        <div class="content">
            {!! nl2br(e($content)) !!}
        </div>
    </div>
</body>

</html>