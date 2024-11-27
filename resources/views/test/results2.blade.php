<form action="{{ route('test.submit') }}" method="POST">
    @csrf
    @foreach ($questions as $index => $question)
    <div class="mb-3">
        <label for="question{{ $index }}" class="form-label">
            {{ ($index + 1) . '. ' . $question }}
        </label>
        <input type="text" name="responses[{{ $index }}]" id="question{{ $index }}" class="form-control" required>
    </div>
    @endforeach
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>