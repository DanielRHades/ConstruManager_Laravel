@extends('layouts.app')
@section('side-menu-items')
@foreach ($contracts as $contract)
<x-side-menu-item id="{{$contract->id}}" primary="Contrato {{$contract->id}}" primary2="{{$contract->date}}" secondary="{{$contract->name}}" route="momazos.com" />
@endforeach

<div class="fixed bottom-12">
    <button id="openPopupButton_left" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</button>
</div>

<div id="form_add_contract" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_contract')
    </div>
</div>

<div id="form_add_customer" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_customer')
    </div>
</div>

<script>
    document.getElementById('openPopupButton_left').addEventListener('click', function() {
        document.getElementById('form_add_contract').classList.toggle('hidden');
    });
    let currentItemId
    document.addEventListener('DOMContentLoaded', function() {
        const sideMenuItems = document.querySelectorAll('.side-menu-item');
        sideMenuItems.forEach(item => {
            item.addEventListener('click', function(event) {
                currentItemId = this.id;
                document.getElementById('selected-main').classList.remove('hidden')
                document.getElementById('selected-submenu').classList.add('hidden')
                document.getElementById('buttons-submenu').classList.remove('hidden')
                fetch(`/contracts/${currentItemId}`)
                    .then(response => response.json())
                    .then(data => {
                        data = data[0]
                        document.getElementById('id').innerText = data.id;
                        document.getElementById('date').innerText = data.date;
                        document.getElementById('description').innerText = data.description;
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
                switch (currentCategory) {
                    case 'contacts':
                        document.getElementById('table-submenu-head').innerHTML = '<th class="text-start">Nombre</th><th class="text-start">Cargo</th><th class="text-start">Correo</th><th class="text-start">Teléfono</th>'

                        break;
                    case 'materials':
                        document.getElementById('table-submenu-head').innerHTML = '<th class="text-start">Nombre</th><th class="text-start">Cantidad</th><th class="text-start">Precio/Unidad</th>'
                        break;
                    case 'machinery':
                        document.getElementById('table-submenu-head').innerHTML = '<th class="text-start">Nombre</th><th class="text-start">Días</th><th class="text-start">Precio/Día</th>'
                        break;
                    case 'records':
                        document.getElementById('table-submenu-head').innerHTML = '<th class="text-start">Código</th><th class="text-start">Fecha</th>'
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

<div id="form_add_contact" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_contact')
    </div>
</div>

<script>
    document.getElementById('openPopupButton_right').addEventListener('click', function() {
        document.getElementById('form_add_contact').classList.toggle('hidden');
    });
</script>

@endsection
