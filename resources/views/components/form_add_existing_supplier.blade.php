<div id="form_add_existing_supplier" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-lg font-bold mb-4">Agregar Proveedor</h2>
        
        <form>
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="nombre">Nombre</label>
                <select id="nombre" name="nombre" class="w-full border-gray-300 rounded-md p-2">
                    <!-- Aquí se debe llenar con las opciones desde la base de datos -->
                </select>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Agregar</button>
                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="closePopup()">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function closePopup() {
        document.querySelector('#form_add_existing_supplier').classList.add('hidden');
    }
</script>
