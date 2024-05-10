<div id="form_edit_contract" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-lg font-bold mb-4">Editar Contrato</h2>

        <form id="contract_form" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="descripcion">Descripción</label>
                <input type="text" id="description-edit" name="descripcion" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="fecha">Fecha</label>
                <input type="date" id="date-edit" name="fecha" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="submitForm()" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Agregar</button>
                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="closeContract()">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function closeContract() {
        document.getElementById('form_edit_contract').classList.add('hidden');
    }

    function submitForm() {
        const form = document.getElementById('contract_form');

        form.action = `/contracts/${currentItemId}/edit`

        const formData = new FormData(form);

        fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => {
                closeContract();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        fetch(`/contracts/${currentItemId}`)
            .then(response => response.json())
            .then(data => {
                data = data[0]
                document.getElementById(`${currentItemId}-main-text-2`).innerText = data.date.split('-').join('/');
                document.getElementById('id').innerText = data.id;
                document.getElementById('date').innerText = data.date.split('-').join('/');
                document.getElementById('description').innerText = data.description;
                if (data.name) {
                    document.getElementById('openPopupButton_left_2').classList.add('hidden')
                } else {
                    document.getElementById('openPopupButton_left_2').classList.remove('hidden')
                }
                document.getElementById('name').innerText = data.name;
                document.getElementById('e-mail').innerText = data.email;
                document.getElementById('phone').innerText = data.phone;
                document.getElementById('type').innerText = data.type;
            })
            .catch(error => console.error('Error:', error));
    }
</script>
