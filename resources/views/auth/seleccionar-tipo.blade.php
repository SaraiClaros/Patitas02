<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white shadow-md rounded">
        <h2 class="text-lg font-bold mb-4">Selecciona tu tipo de usuario</h2>
        <form method="POST" action="{{ route('seleccionar.tipo.guardar') }}">
            @csrf

            <label class="block mb-2">
                <input type="radio" name="tipo_usuario" value="veterinaria" required>
                🐶 Veterinaria
            </label>
            <label class="block mb-2">
                <input type="radio" name="tipo_usuario" value="refugio">
                🏠 Refugio
            </label>
            <label class="block mb-4">
                <input type="radio" name="tipo_usuario" value="usuario">
                👤 Usuario Normal
            </label>

            <x-primary-button class="w-full">
                Continuar
            </x-primary-button>
        </form>
    </div>
</x-guest-layout>
