@extends('layouts.app')
@section('side-menu-items')
@foreach ($suppliers as $supplier)
<x-side-menu-item primary="{{$supplier->name}}" secondary="{{$supplier->email}}" id="{{$supplier->id}}" />
@endforeach
<div class="fixed bottom-12">
    <button id="openPopupButton_left" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</button>
</div>

<div id="form_add_supplier" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_supplier')
    </div>
</div>
<div id="form_edit_supplier" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_edit_supplier')
    </div>
</div>

<script>
    let currentItemId
    let executing = false
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('openPopupButton_left').addEventListener('click', function() {
            document.getElementById('form_add_supplier').classList.toggle('hidden');
        });
        document.getElementById('edit-item').addEventListener('click', function() {
            document.getElementById('name-edit').value = document.getElementById('name').innerText
            document.getElementById('e-mail-edit').value = document.getElementById('e-mail').innerText
            document.getElementById('phone-edit').value = document.getElementById('phone').innerText
            document.getElementById('form_edit_supplier').classList.toggle('hidden');
        });
        const sideMenuItems = document.querySelectorAll('.side-menu-item');
        sideMenuItems.forEach(item => {
            item.addEventListener('click', function(event) {
                if (executing) {
                    return;
                }
                executing = true
                currentItemId = this.id;
                document.getElementById('supplier_id').value = currentItemId;
                document.getElementById('selected-submenu').classList.add('hidden')
                fetch(`/suppliers/${currentItemId}`)
                    .then(response => response.json())
                    .then(data => {
                        data = data[0]
                        document.getElementById('name').innerText = data.name;
                        document.getElementById('e-mail').innerText = data.email;
                        document.getElementById('phone').innerText = data.phone;
                    })
                    .then(() => {
                        document.getElementById('buttons-submenu').classList.remove('hidden')
                        document.getElementById('selected-main').classList.remove('hidden')

                    })
                    .catch(error => console.error('Error:', error));
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
<strong class="text-xl font-semibold">Email: </strong><span id="e-mail" class="text-customYellow"></span>
<br>
<strong class="text-xl font-semibold">Teléfono: </strong><span id="phone" class="text-customYellow"></span>
@endsection
@section('buttons-submenu')
<x-button-submenu id="materials" text="Materiales" />
<script>
    const currentCategory = 'materials'
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
