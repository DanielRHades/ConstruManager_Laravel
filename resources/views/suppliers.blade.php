@extends('layouts.app')
@section('side-menu-items')
@foreach ($suppliers as $supplier)
<x-side-menu-item primary="{{$supplier->name}}" secondary="{{$supplier->email}}" id="{{$supplier->id}}" section="suppliers" />
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
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('openPopupButton_left').addEventListener('click', function() {
            document.getElementById('form_add_supplier').classList.toggle('hidden');
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
<strong class="text-xl font-semibold">Email: </strong><span id="e-mail" class="text-customYellow">{{$details->email}}</span>
<br>
<strong class="text-xl font-semibold">Teléfono: </strong><span id="phone" class="text-customYellow">{{$details->phone}}</span>
<div class="fixed bottom-12 right-8">
    <button id="openPopupButton_right" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</button>
</div>

<div id="form_edit_supplier" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <x-form_edit_supplier id="{{$details->id}}" />
    </div>
</div>
<div id="form_add_existing_material_supplier" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_existing_material_supplier')
    </div>
</div>
<div id="form_delete" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <x-form-delete section="suppliers" id="{{$details->id}}" />
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('openPopupButton_right').addEventListener('click', function() {
            document.getElementById('form_add_existing_material_supplier').classList.toggle('hidden');
        });
        document.getElementById('supplier_id').value = "{{$details->id}}"
        document.getElementById('current_id').value = "{{$details->id}}"
        document.getElementById('edit-item').addEventListener('click', function() {
            document.getElementById('name-edit').value = document.getElementById('name').innerText
            document.getElementById('e-mail-edit').value = document.getElementById('e-mail').innerText
            document.getElementById('phone-edit').value = document.getElementById('phone').innerText
            document.getElementById('form_edit_supplier').classList.toggle('hidden');
        });


    })
</script>
@endif
@endsection
@if(!empty($materials))
@section('buttons-submenu')
<x-button-submenu id="materials" text="Materiales" />
@endsection
@section('selected-submenu')
<table id="table-submenu" class="table-auto w-full ">
    <thead>
        <tr class="border-b">
            <th class="text-start">Nombre</th>
            <th class="text-start">Precio/Unidad</th>
            <th class="text-start"></th>
        </tr>
    </thead>
    <tbody id="table-sub-submenu">
        @foreach ($materials as $material)
        <tr>
            <td>{{$material->name}}</td>
            <td>{{$material->unit_price}}</td>
            <td>
                <form method="post" action="{{route('suppliers_materials.delete')}}">
                    @csrf
                    <input type="hidden" name="current_route" value="{{ Route::currentRouteName() }}">
                    <input type="hidden" name="current_id" value="{{$details->id}}">
                    <input type="hidden" name="material_id" value="{{$material->id}}">
                    <input type="hidden" name="supplier_id" value="{{$details->id}}">
                    <input type="image" src="{{asset('img/borrar-x.png')}}" class="cursor-pointer h-2">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
@endif
