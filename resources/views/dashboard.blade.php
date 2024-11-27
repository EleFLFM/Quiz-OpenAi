<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard') }}
        </h2>
        @role('Administrador')
        <p>Este contenido solo es visible para los administradores.</p>
        @else
        <p>No tienes permisos para ver este contenido.</p>
        @endrole
        @if(session('error'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Operación Exitosa',
                text: "{{ session('success') }}",
                confirmButtonText: 'Aceptar'
            });
        </script>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @role('Administrador')
                    <p>Este contenido solo es visible para los administradores.</p>
                    @else
                    <p>No tienes permisos para ver este contenido.</p>
                    @endrole
                </div>
            </div>
        </div>
    </div>
</x-app-layout>