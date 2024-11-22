<div class="container my-5">
    <h1 class="mb-4 text-center">Test de Programación</h1>
    <form action="{{ route('test.submit') }}" method="POST">
        @csrf

        @foreach ($questions as $index => $question)
        <div class="mb-4">
            <label for="question{{ $index }}" class="form-label">
                {{ ($index + 1) . '. ' . $question }}
            </label>
            <input type="text" name="responses[{{ $index }}]" id="question{{ $index }}" class="form-control" required>
        </div>
        @endforeach
        <button type="submit" class="btn btn-primary w-100">Enviar</button>
    </form>
</div>

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

    /* Button */
    .btn-primary {
        display: block;
        max-width: 300px;
        margin: 30px auto 0;
        padding: 12px 24px;
        background: linear-gradient(45deg, #007bff, #0056b3);
        border: none;
        border-radius: 6px;
        color: white;
        font-size: 1.1em;
        font-weight: bold;
        text-align: center;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
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