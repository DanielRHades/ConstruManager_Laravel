@extends('layouts.app')
@section('side-menu-items')
@foreach ($contracts as $contract)
<x-side-menu-item id="{{$contract->id}}" primary="Contrato {{$contract->id}}" primary2="{{implode('/',explode('-',$contract->date))}}" secondary="{{$contract->name}}" route="momazos.com" />
@endforeach

<div class="fixed bottom-12">
    <button id="openPopupButton_left_1" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</button>
</div>

<div class="fixed bottom-12 left-20">
    <button id="openPopupButton_left_2" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</button>
</div>

<div id="form_add_contract" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_contract')
    </div>
</div>

<div id="form_edit_contract" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_edit_contract')
    </div>
</div>

<div id="form_add_customer" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_customer')
    </div>
</div>

<div id="form_add_contact" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_contact')
    </div>
</div>

<div id="form_add_existing_material_contract" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_existing_material_contract')
    </div>
</div>

<div id="form_add_existing_machinery" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_existing_machinery')
    </div>
</div>

<div id="form_add_record" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_record')
    </div>
</div>

<script>
    let currentItemId
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('openPopupButton_left_1').addEventListener('click', function() {
            document.getElementById('form_add_contract').classList.toggle('hidden');
        });
        document.getElementById('edit-item').addEventListener('click', function() {
            document.getElementById('description-edit').value = document.getElementById('description').innerText
            document.getElementById('date-edit').value = document.getElementById('date').innerText.split('/').join('-')
            document.getElementById('form_edit_contract').classList.toggle('hidden');
        });

        document.getElementById('openPopupButton_left_2').addEventListener('click', function() {
            document.getElementById('form_add_customer').classList.toggle('hidden');
        });
        const sideMenuItems = document.querySelectorAll('.side-menu-item');
        sideMenuItems.forEach(item => {
            item.addEventListener('click', function(event) {
                currentItemId = this.id;
                document.getElementById('contract_id_customer').value = currentItemId;
                document.getElementById('contract_id_contact').value = currentItemId;
                document.getElementById('contract_id_material').value = currentItemId;
                document.getElementById('contract_id_machinery').value = currentItemId;
                document.getElementById('contract_id_record').value = currentItemId;
                document.getElementById('selected-main').classList.remove('hidden')
                document.getElementById('selected-submenu').classList.add('hidden')
                document.getElementById('buttons-submenu').classList.remove('hidden')
                fetch(`/contracts/${currentItemId}`)
                    .then(response => response.json())
                    .then(data => {
                        data = data[0]
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
            });
        });
    });
</script>

@endsection
@section('selected-main')
<h1 class="text-4xl font-bold">Contrato <a id="id"></a> - <a id="date"></a></h1>
</br>
<p id="description"></p>
</br>
<strong class="bottom-0"><a id="name"></a> - <a id="e-mail"></a> - <a id="phone"></a> - <a id="type"></a></strong>
@endsection
@section('buttons-submenu')
<x-button-submenu id="contacts" text="Contactos" />
<x-button-submenu id="materials" text="Materiales" />
<x-button-submenu id="machinery" text="Maquinarias" />
<x-button-submenu id="records" text="Registros" />
<script>
    let currentCategory
    document.addEventListener('DOMContentLoaded', function() {
        const submenuButtons = document.querySelectorAll('.button-submenu');
        submenuButtons.forEach(item => {
            item.addEventListener('click', function(event) {
                currentCategory = this.id;
                document.getElementById(currentCategory).disabled = true
                switch (currentCategory) {
                    case 'contacts':
                        document.getElementById('table-submenu-head').innerHTML = '<th class="text-start">Nombre</th><th class="text-start">Cargo</th><th class="text-start">Correo</th><th class="text-start">Teléfono</th>'
                        document.getElementById('openPopupButton_right').addEventListener('click', function() {
                            document.getElementById('form_add_contact').classList.remove('hidden');
                            document.getElementById('form_add_existing_material_contract').classList.add('hidden');
                            document.getElementById('form_add_existing_machinery').classList.add('hidden');
                            document.getElementById('form_add_record').classList.add('hidden');
                        });
                        break;
                    case 'materials':
                        document.getElementById('table-submenu-head').innerHTML = '<th class="text-start">Nombre</th><th class="text-start">Cantidad</th><th class="text-start">Precio/Unidad</th>'
                        document.getElementById('openPopupButton_right').addEventListener('click', function() {
                            document.getElementById('form_add_existing_material_contract').classList.remove('hidden');
                            document.getElementById('form_add_contact').classList.add('hidden');
                            document.getElementById('form_add_existing_machinery').classList.add('hidden');
                            document.getElementById('form_add_record').classList.add('hidden');
                        });
                        break;
                    case 'machinery':
                        document.getElementById('table-submenu-head').innerHTML = '<th class="text-start">Nombre</th><th class="text-start">Días</th><th class="text-start">Precio/Día</th>'
                        document.getElementById('openPopupButton_right').addEventListener('click', function() {
                            document.getElementById('form_add_existing_machinery').classList.remove('hidden');
                            document.getElementById('form_add_contact').classList.add('hidden');
                            document.getElementById('form_add_existing_material_contract').classList.add('hidden');
                            document.getElementById('form_add_record').classList.add('hidden');
                        });
                        break;
                    case 'records':
                        document.getElementById('table-submenu-head').innerHTML = '<th class="text-start">Código</th><th class="text-start">Fecha</th>'
                        document.getElementById('openPopupButton_right').addEventListener('click', function() {
                            document.getElementById('form_add_record').classList.remove('hidden');
                            document.getElementById('form_add_existing_machinery').classList.add('hidden');
                            document.getElementById('form_add_existing_material_contract').classList.add('hidden');
                            document.getElementById('form_add_contact').classList.add('hidden');
                        });
                        break;
                }
                document.getElementById('selected-submenu').classList.remove('hidden')
                document.getElementById('table-sub-submenu').innerHTML = ""
                fetch(`/contracts/${currentItemId}/${currentCategory}`)
                    .then(response => response.json())
                    .then(data => {
                        data.map((entry) => {
                            document.getElementById('table-sub-submenu').insertAdjacentHTML('beforeend', `
<tr class="border-b">
${Object.values(entry).map((p)=>`<td>${p}</td>`).join('')}
</tr>                        `)
                        })
                    })
                    .then(() => {
                        document.getElementById(currentCategory).disabled = false
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
@endsection
@section('selected-submenu')
<table id="table-submenu" class="table-auto w-full ">
    <thead>
        <tr id="table-submenu-head" class="border-b">
        </tr>
    </thead>
    <tbody id="table-sub-submenu">
    </tbody>
</table>

<div class="fixed bottom-12 right-8">
    <button id="openPopupButton_right" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</button>
</div>

@endsection
