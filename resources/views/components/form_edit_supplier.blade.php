<div id="form_edit_supplier" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-lg font-bold mb-4">Editar Proveedor</h2>

        <form method="POST" id="supplier_form" action="{{route('suppliers.edit',['id'=>$id])}}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="nombre">Nombre</label>
                <input type="text" id="name-edit" name="nombre" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="email">Email</label>
                <input type="email" id="e-mail-edit" name="email" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="telefono">Teléfono</label>
                <input type="tel" id="phone-edit" name="telefono" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Actualizar</button>
                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="closeEditSupplier()">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function closeEditSupplier() {
        document.querySelector('#form_edit_supplier').classList.add('hidden');
    }
</script>
