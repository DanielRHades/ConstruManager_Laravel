@extends('layouts.app')
@section('side-menu-items')
@foreach ($materials as $material)
<x-side-menu-item primary="{{$material->name}}" id="{{$material->id}}" section="materials" />
@endforeach

<div class="fixed bottom-12">
    <button id="openPopupButton_left" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</button>
</div>

<div id="form_add_material" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_material')
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('openPopupButton_left').addEventListener('click', function() {
            document.getElementById('form_add_material').classList.toggle('hidden');
        });
    });
</script>

@endsection
@section('selected-main')
@if(!empty($details))
<div class="relative">
    <div class="absolute right-0 top-0 flex">
        <img id="edit-item" src="{{asset('img/editar.png')}}" class="h-6 me-4 cursor-pointer">
        <img id="delete-item" src="{{asset('img/borrar.png')}}" class="h-6 cursor-pointer">
    </div>
</div>
<a id="name" class="text-4xl font-bold">{{$details->name}}</a>
<br>
<strong class="text-xl font-semibold">Cantidad: </strong><span id="quantity" class="text-customYellow">{{$details->quantity}}</span>
<br>
<strong class="text-xl font-semibold">Precio/Unidad: </strong><span id="unit_price" class="text-customYellow">{{$details->unit_price}}</span>
<div id="form_delete" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <x-form-delete section="materials" id="{{$details->id}}" />
    </div>
</div>
<div id="form_edit_material" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <x-form-edit-material id="{{$details->id}}" />
    </div>
</div>
<div class="fixed bottom-12 right-8">
    <button id="openPopupButton_right" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</button>
</div>

<div id="form_add_existing_supplier" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_existing_supplier')
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('openPopupButton_right').addEventListener('click', function() {
            document.getElementById('form_add_existing_supplier').classList.toggle('hidden');
        });
        document.getElementById('material_id').value = "{{$details->id}}"
        document.getElementById('current_id').value = "{{$details->id}}"
        document.getElementById('edit-item').addEventListener('click', function() {
            document.getElementById('name-edit').value = document.getElementById('name').innerText
            document.getElementById('quantity-edit').value = document.getElementById('quantity').innerText
            document.getElementById('price-edit').value = document.getElementById('unit_price').innerText
            document.getElementById('form_edit_material').classList.toggle('hidden');
        });

    })
</script>
@endif
@endsection
@if(!empty($suppliers))
@section('buttons-submenu')
<x-button-submenu id="suppliers" text="Proveedores" />
@endsection
@section('selected-submenu')
<table id="table-submenu" class="table-auto w-full ">
    <thead>
        <tr class="border-b">
            <th class="text-start">Nombre</th>
            <th class="text-start">Correo</th>
            <th class="text-start">Teléfono</th>
            <th class="text-start"></th>
        </tr>
    </thead>
    <tbody id="table-sub-submenu">
        @foreach($suppliers as $supplier)
        <tr>
            <td>{{$supplier->name}}</td>
            <td>{{$supplier->email}}</td>
            <td>{{$supplier->phone}}</td>
            <td>
                <form method="post" action="{{route('suppliers_materials.delete')}}">
                    @csrf
                    <input type="hidden" name="current_route" value="{{ Route::currentRouteName() }}">
                    <input type="hidden" name="current_id" value="{{$details->id}}">
                    <input type="hidden" name="material_id" value="{{$details->id}}">
                    <input type="hidden" name="supplier_id" value="{{$supplier->id}}">
                    <input type="image" src="{{asset('img/borrar-x.png')}}" class="cursor-pointer h-2">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@endif
