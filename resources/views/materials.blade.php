@extends('layouts.app')
@section('side-menu-items')
@foreach ($materials as $material)
<x-side-menu-item primary="{{$material->name}}" id="{{$material->id}}" />
@endforeach

<div class="fixed bottom-12">
    <button id="openPopupButton_left" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</button>
</div>

<div id="form_add_material" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_material')
    </div>
</div>
<div id="form_edit_material" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_edit_material')
    </div>
</div>

<script>
    let executing = false
    let currentItemId
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('openPopupButton_left').addEventListener('click', function() {
            document.getElementById('form_add_material').classList.toggle('hidden');
        });
        document.getElementById('edit-item').addEventListener('click', function() {
            document.getElementById('name-edit').value = document.getElementById('name').innerText
            document.getElementById('quantity-edit').value = document.getElementById('quantity').innerText
            document.getElementById('price-edit').value = document.getElementById('unit_price').innerText
            document.getElementById('form_edit_material').classList.toggle('hidden');
        });
        const sideMenuItems = document.querySelectorAll('.side-menu-item');
        sideMenuItems.forEach(item => {
            item.addEventListener('click', function(event) {
                if (executing) {
                    return;
                }
                executing = true
                currentItemId = this.id;
                document.getElementById('material_id').value = currentItemId;
                document.getElementById('selected-submenu').classList.add('hidden')
                fetch(`/materials/${currentItemId}`)
                    .then(response => response.json())
                    .then(data => {
                        data = data[0]
                        document.getElementById('name').innerText = data.name;
                        document.getElementById('quantity').innerText = data.quantity;
                        document.getElementById('unit_price').innerText = data.unit_price;
                    })
                    .then(() => {
                        document.getElementById('buttons-submenu').classList.remove('hidden')
                        document.getElementById('selected-main').classList.remove('hidden')
                        document.getElementById('selected-submenu').classList.remove('hidden')
                    })
                    .catch(error => console.error('Error:', error));
                document.getElementById('table-sub-submenu').innerHTML = ""
                fetch(`/materials/${currentItemId}/${currentCategory}`)
                    .then(response => response.json())
                    .then(data => {
                        data.map((entry) => {
                            document.getElementById('table-sub-submenu').insertAdjacentHTML('beforeend', `
<tr class="border-b">
    <td>${entry.name}</td>
    <td>${entry.email}</td>
    <td>${entry.phone}</td>
</tr>                        `)
                        })
                    })
                    .then(() => executing = false)
                    .catch(error => console.error('Error:', error));
            });
        });
    });
</script>

@endsection
@section('selected-main')
<a id="name" class="text-4xl font-bold"></a>
<br>
<strong class="text-xl font-semibold">Cantidad: </strong><span id="quantity" class="text-customYellow"></span>
<br>
<strong class="text-xl font-semibold">Precio/Unidad: </strong><span id="unit_price" class="text-customYellow"></span>
@endsection
@section('buttons-submenu')
<x-button-submenu id="suppliers" text="Proveedores" />
<script>
    const currentCategory = 'suppliers'
</script>
@endsection
@section('selected-submenu')
<table id="table-submenu" class="table-auto w-full ">
    <thead>
        <tr class="border-b">
            <th class="text-start">Nombre</th>
            <th class="text-start">Correo</th>
            <th class="text-start">Teléfono</th>
        </tr>
    </thead>
    <tbody id="table-sub-submenu">
    </tbody>
</table>

<div class="fixed bottom-12 right-8">
    <button id="openPopupButton_right" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</button>
</div>

<div id="form_add_existing_supplier" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_existing_supplier')
    </div>
</div>

<script>
    document.getElementById('openPopupButton_right').addEventListener('click', function() {
        document.getElementById('form_add_existing_supplier').classList.toggle('hidden');
    });
</script>

@endsection
