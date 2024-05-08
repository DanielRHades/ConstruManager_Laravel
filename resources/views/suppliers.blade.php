@extends('layouts.app')
@section('side-menu-items')
@foreach ($suppliers as $supplier)
<x-side-menu-item primary="{{$supplier->name}}" secondary="{{$supplier->phone}}" id="{{$supplier->id}}" />
@endforeach
<div class="fixed bottom-12">
    <button id="openPopupButton_left" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</button>
</div>

<div id="form_add_supplier" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_supplier')
    </div>
</div>

<script>
    document.getElementById('openPopupButton_left').addEventListener('click', function() {
        document.getElementById('form_add_supplier').classList.toggle('hidden');
    });
    let currentItemId
    document.addEventListener('DOMContentLoaded', function() {
        const sideMenuItems = document.querySelectorAll('.side-menu-item');
        sideMenuItems.forEach(item => {
            item.addEventListener('click', function(event) {
                currentItemId = this.id;
                document.getElementById('supplier_id').value = currentItemId;
                document.getElementById('selected-main').classList.remove('hidden')
                document.getElementById('selected-submenu').classList.add('hidden')
                document.getElementById('buttons-submenu').classList.remove('hidden')
                fetch(`/suppliers/${currentItemId}`)
                    .then(response => response.json())
                    .then(data => {
                        data = data[0]
                        document.getElementById('name').innerText = data.name;
                        document.getElementById('e-mail').innerText = data.email;
                        document.getElementById('phone').innerText = data.phone;
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    });
</script>

@endsection
@section('selected-main')
<div class="relative">
    <a id="name" class="text-4xl font-bold"></a>
</div>
<div class="mt-4">
    <strong class="text-xl font-semibold">Email: </strong><span id="e-mail" class="text-customYellow"></span>
</div>
<div class="mt-2">
    <strong class="text-xl font-semibold">Teléfono: </strong><span id="phone" class="text-customYellow"></span>
</div>
@endsection
@section('buttons-submenu')
<x-button-submenu id="materials" text="Materiales" />
<script>
    let currentCategory
    document.addEventListener('DOMContentLoaded', function() {
        const submenuButtons = document.querySelectorAll('.button-submenu');
        submenuButtons.forEach(item => {
            item.addEventListener('click', function(event) {
                currentCategory = this.id;
                document.getElementById('selected-submenu').classList.remove('hidden')
                document.getElementById('table-sub-submenu').innerHTML = ""
                fetch(`/suppliers/${currentItemId}/${currentCategory}`)
                    .then(response => response.json())
                    .then(data => {
                        data.map((entry) => {
                            document.getElementById('table-sub-submenu').insertAdjacentHTML('beforeend', `
<tr class="border-b">
    <td>${entry.name}</td>
    <td>${entry.unit_price}</td>
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
        <tr class="border-b">
            <th class="text-start">Nombre</th>
            <th class="text-start">Precio/Unidad</th>
        </tr>
    </thead>
    <tbody id="table-sub-submenu">
    </tbody>
</table>

<div class="fixed bottom-12 right-8">
    <button id="openPopupButton_right" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</button>
</div>

<div id="form_add_existing_material_supplier" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_existing_material_supplier')
    </div>
</div>

<script>
    document.getElementById('openPopupButton_right').addEventListener('click', function() {
        document.getElementById('form_add_existing_material_supplier').classList.toggle('hidden');
    });
</script>

@endsection
