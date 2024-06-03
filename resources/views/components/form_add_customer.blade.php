<div id="form_add_customer" class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-lg font-bold mb-4">Agregar Cliente</h2>
        
        <form method="POST" action="{{ route('customers.store') }}" >
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="tipo_cliente">Tipo de Cliente</label>
                <select id="tipo_cliente" name="tipo_cliente" class="w-full border-gray-300 rounded-md p-2">
                    <option value="natural">Natural</option>
                    <option value="juridico">Jurídico</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="telefono">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="flex justify-end">
                <input type="hidden" name="contract_id_customer" id="contract_id_customer" value=""> 
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Agregar</button>
                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="closeCustomer()">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function closeCustomer() {
        document.getElementById('form_add_customer').classList.add('hidden');
    }
</script>
