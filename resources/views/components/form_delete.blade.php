@php
$currentRoute=request()->route()->uri();
@endphp
<div id="form_delete" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-lg font-bold mb-4">¿Seguro que deseas eliminar este elemento?</h2>
        <form method="POST" action="{{route($currentRoute.'.delete')}}">
            @csrf
            <div class="flex justify-end">
                <input id="elementId" class="hidden" name="elementId">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Aceptar</button>
                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="closeSupplier()">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function closeDelete() {
        document.querySelector('#form_delete').classList.add('hidden');
    }
</script>
