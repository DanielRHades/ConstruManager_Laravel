<div id="form_add_existing_machinery" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-lg font-bold mb-4">Agregar Maquinaria</h2>

        <form form method="POST" action="{{ route('contracts_machinery.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="nombre">Nombre</label>
                <select id="scroll_menu_contract_machinery" name="nombre" class="w-full border-gray-300 rounded-md p-2">
                    @foreach($allMachineries as $machinery)
                    <option value="{{ $machinery->id }}">{{ $machinery->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="dias">Cantidad</label>
                <input type="number" id="cantidad" name="cantidad" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="dias">Días</label>
                <input type="number" id="dias" name="dias" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="flex justify-end">
                <input type="hidden" name="current_route" value="{{ Route::currentRouteName() }}">
                <input type="hidden" name="contract_id_machinery" id="contract_id" value="">
                <input type="hidden" name="contract_category_machinery" id="contract_category" value="">
                <input type="hidden" name="machinery_id" id="machinery_id" value="">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Agregar</button>
                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="closeAddMachineryContract()">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('machinery_id').value = 1;

    document.getElementById('scroll_menu_contract_machinery').addEventListener('change', function() {
        let machinery_id = this.value;
        document.getElementById('machinery_id').value = machinery_id;
    });

    function closeAddMachineryContract() {
        document.getElementById('form_add_existing_machinery').classList.toggle('hidden');
    }
</script>
