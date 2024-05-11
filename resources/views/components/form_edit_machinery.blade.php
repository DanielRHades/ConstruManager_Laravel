<div id="form_edit_machinery" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-lg font-bold mb-4">Editar Maquinaria</h2>

        <form id="machinery_form" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="nombre">Nombre</label>
                <input type="text" id="name-edit" name="nombre" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="cantidad">Cantidad</label>
                <input type="number" id="quantity-edit" name="cantidad" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="precio">Precio por Día</label>
                <input type="number" id="price-edit" name="precio" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="flex justify-end">
                <button type="button" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2" onclick="submitForm()">Actualizar</button>
                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="closeEditMachinery()">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function closeEditMachinery() {
        document.querySelector('#form_edit_machinery').classList.add('hidden');
    }

    function submitForm() {
        const form = document.getElementById('machinery_form');

        form.action = `/machinery/${currentItemId}/edit`

        const formData = new FormData(form);

        fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => {
                closeEditMachinery();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        fetch(`/machinery/${currentItemId}`)
            .then(response => response.json())
            .then(data => {
                data = data[0]
                document.getElementById(`${currentItemId}-main-text`).innerText = data.name;
                document.getElementById('name').innerText = data.name;
                document.getElementById('quantity').innerText = data.quantity;
                document.getElementById('day_price').innerText = data.day_price;
            })
            .catch(error => console.error('Error:', error));
    }
</script>
