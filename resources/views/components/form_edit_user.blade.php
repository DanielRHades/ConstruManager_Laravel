<div id="form_edit_user" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-lg font-bold mb-4">Editar Maquinaria</h2>

        <form id="user_form" method="POST" action="{{route('users.edit',['id'=>$id])}}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="nombre">Nombre</label>
                <input type="text" id="name-edit" name="nombre" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="tipo">Tipo</label>
                <select id="type-edit" name="tipo" class="w-full border-gray-300 rounded-md p-2">
                    <option value="usuario">Usuario</option>
                    <option value="administrador">Administrador</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2" for="email">Email</label>
                <input type="email" id="email-edit" name="email" class="w-full border-gray-300 rounded-md p-2">
            </div>          
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2"  for="password_edit">Contraseña</label>
                <input type="password" id="password-edit"  name="password_edit" required autocomplete="new-password" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-2"  for="password_confirmation_edit">Confirmación Contraseña</label>
                <input type="password" id="password_confirmation_edit"  name="password_confirmation_edit" required autocomplete="new-password" class="w-full border-gray-300 rounded-md p-2">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Actualizar</button>
                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="closeEditUser()">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function closeEditUser() {
        document.querySelector('#form_edit_user').classList.add('hidden');
    }
</script>
