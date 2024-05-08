<div id="form_add_existing_material_contract" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-lg font-bold mb-4">Agregar Material</h2>
        
        <form form method="POST" action="{{ route('contracts_materials.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="nombre">Nombre</label>
                <select id="scroll_menu_contract_material" name="nombre" class="w-full border-gray-300 rounded-md p-2">
                    @foreach($materials as $material)
                        <option value="{{ $material->id }}">{{ $material->name }}</option>
                    @endforeach
                </select> 
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="cantidad">Cantidad</label>
                <input type="number" id="cantidad" name="cantidad" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="flex justify-end">
                <input type="hidden" name="contract_id_material" id="contract_id_material" value=""> 
                <input type="hidden" name="material_id" id="material_id" value=""> 
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Agregar</button>
                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="closeAddMaterialContract()">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
        document.getElementById('material_id').value = 1;

        document.getElementById('scroll_menu_contract_material').addEventListener('change', function() {
        let materialId_Contract = this.value;
        document.getElementById('material_id').value = materialId_Contract;
    });

    function closeAddMaterialContract() {
        document.getElementById('form_add_existing_material_contract').classList.toggle('hidden');
    }

</script>
