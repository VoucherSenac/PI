<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Pacientes</title>
    @vite('resources/css/app.css')
    @stack('styles')
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <nav class="bg-blue-600 text-white p-4">
        <ul class="flex space-x-4">
            <li>
                <a href="{{ route('pacientes.index') }}" 
                   class="{{ request()->routeIs('pacientes.index') ? 'underline font-bold' : '' }}">
                   Lista de Pacientes
                </a>
            </li>
            <li>
                <a href="{{ route('pacientes.create') }}" 
                   class="{{ request()->routeIs('pacientes.create') ? 'underline font-bold' : '' }}">
                   Cadastrar Paciente
                </a>
            </li>
            <li>
                <a href="{{ route('pacientes.fila') }}" 
                   class="{{ request()->routeIs('pacientes.fila') ? 'underline font-bold' : '' }}">
                   Fila
                </a>
            </li>
        </ul>
    </nav>

    <div class="container mx-auto py-6">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
