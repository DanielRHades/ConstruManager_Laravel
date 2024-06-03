@extends('layouts.app')
@section('side-menu-items')
<div class="mb-4">
    <input type="text" id="search" placeholder="Buscar por nombre o email" onkeyup="filterSuppliers()" class="w-full p-3 border border-gray-300 rounded-lg">
</div>

<div id="suppliers-list">
    @foreach ($suppliers as $supplier)
        <div class="supplier-item mb-2">
            <a href="{{ route('suppliers.details', ['id' => $supplier->id]) }}" class="group block">
                <div id="{{ $supplier->id }}" class="side-menu-item cursor-pointer border-black border-x border-b border-opacity-100 border-solid w-full p-3 justify-start group-first:border-t hover:bg-gray-300 rounded-md">
                    <p id="{{ $supplier->id }}-main-text" class="text-xl w-fit">
                        {{ $supplier->name }}
                    </p>
                    <p class="text-base text-gray-400 w-fit">{{ $supplier->email }}</p>
                </div>
            </a>
        </div>
    @endforeach
</div>

<script>
    function filterSuppliers() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const supplierItems = document.getElementsByClassName('supplier-item');
        
        for (let i = 0; i < supplierItems.length; i++) {
            const primaryText = supplierItems[i].querySelector('p[id$="-main-text"]').innerText.toLowerCase();
            const secondaryText = supplierItems[i].querySelector('p.text-base').innerText.toLowerCase();

            if (primaryText.includes(searchInput) || secondaryText.includes(searchInput)) {
                supplierItems[i].style.display = '';
            } else {
                supplierItems[i].style.display = 'none';
            }
        }
    }
</script>

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
<div class="relative p-6 bg-white border border-gray-300 rounded-lg shadow-lg" style="margin-right: 16px;">
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
<div class="fixed bottom-12 right-12">
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
@if(!empty($materials) )
@section('buttons-submenu')
<x-button-submenu id="materials" text="Materiales" />
@endsection
@section('selected-submenu')
@if(!($materials->isEmpty()))
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
                    <input type="image" src="{{asset('img/borrar-x.png')}}" class="cursor-pointer h-3">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="relative m-2">
    <a class="text-gray-400">Este proveedor no cuenta con ningún material</a>
</div>
@endif
@endsection
@endif
