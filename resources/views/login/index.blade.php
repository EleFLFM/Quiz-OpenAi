<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <title>Login</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h1>Crear Cuenta</h1>

                <!-- Campo de Nombre -->
                <input type="text" name="name" placeholder="Name" required autofocus>
                @error('name')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror

                <!-- Campo de Email -->
                <input type="email" name="email" placeholder="Email" required>
                @error('email')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror

                <!-- Campo de Password -->
                <input type="password" name="password" placeholder="Password" required>
                @error('password')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror

                <!-- Confirmar Password -->
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                @error('password_confirmation')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror

                <!-- Botón de Registro -->
                <button type="submit">Registrarse</button>


            </form>

        </div>
        <div class="form-container sign-in">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Iniciar sesión</h1>

                <!-- Campo de Email -->
                <input type="email" name="email" placeholder="Email" required autofocus>
                @error('email')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror

                <!-- Campo de Password -->
                <input type="password" name="password" placeholder="Password" required>
                @error('password')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror


                <!-- Botón de Iniciar sesión -->
                <button type="submit">Iniciar sesión</button>
            </form>

        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>¡Bienvenido de nuevo!</h1>
                    <p>Ingrese sus datos personales para usar todas las funciones del sitio</p>
                    <button class="hidden" id="login">Iniciar sesión</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>¡Hola, Amigo!</h1>
                    <p>Regístrese con sus datos personales para utilizar todas las funciones del sitio </p>
                    <button class="hidden" id="register">Registrate</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });
    </script>
</body>

</html>