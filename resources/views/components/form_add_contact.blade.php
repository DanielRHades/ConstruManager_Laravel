<div id="form_add_contact" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-lg font-bold mb-4">Agregar Contacto</h2>

        <form method="POST" action="{{ route('contacts.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="tipo_cliente">Rol</label>
                <input type="text" id="rol" name="rol" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="telefono">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="flex justify-end">
                <input type="hidden" name="current_route" value="{{ Route::currentRouteName() }}">
                <input type="hidden" name="contract_id_contact" id="contract_id" value="">
                <input type="hidden" name="contract_category_contact" id="contract_category" value="">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Agregar</button>
                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="closeContact()">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function closeContact() {
        document.getElementById('form_add_contact').classList.add('hidden');
    }
</script>
