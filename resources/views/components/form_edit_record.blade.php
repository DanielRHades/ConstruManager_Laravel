<div id="form_edit_record" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-lg font-bold mb-4">Editar Registro</h2>

        <form method="POST" id="record_form" action="{{route('records.edit')}}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="fecha">Fecha</label>
                <input type="date" id="record-date-edit" name="fecha" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="descripcion">Descripción</label>
                <textarea id="record-description-edit" name="descripcion" class="w-full border-gray-300 rounded-md p-2"></textarea>
            </div>
            <div class="flex justify-end">
                <input type="hidden" name="current_route" value="{{ Route::currentRouteName() }}">
                <input type="hidden" name="record_id" id="record_id">
                <input type="hidden" name="contract_id" id="contract_id">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Actualizar</button>
                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="closeEditRecord()">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function closeEditRecord() {
        document.getElementById('form_edit_record').classList.add('hidden');
    }
</script>
