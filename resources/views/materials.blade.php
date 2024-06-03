@extends('layouts.app')
@section('side-menu-items')
<div class="mb-4">
    <input type="text" id="search" placeholder="Buscar por nombre" onkeyup="filterMaterials()" class="w-full p-3 border border-gray-300 rounded-lg">
</div>

<div id="materials-list">
    @foreach ($materials as $material)
        <div class="material-item mb-2">
            <a href="{{ route('materials.details', ['id' => $material->id]) }}" class="group block">
                <div id="{{ $material->id }}" class="side-menu-item cursor-pointer border-black border-x border-b border-opacity-100 border-solid w-full p-3 justify-start group-first:border-t hover:bg-gray-300 rounded-md">
                    <p id="{{ $material->id }}-main-text" class="text-xl w-fit">
                        {{ $material->name }}
                    </p>
                    <p class="text-base text-gray-400 w-fit">{{ $material->description }}</p>
                </div>
            </a>
        </div>
    @endforeach
</div>

<script>
    function filterMaterials() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const materialItems = document.getElementsByClassName('material-item');
        
        for (let i = 0; i < materialItems.length; i++) {
            const primaryText = materialItems[i].querySelector('p[id$="-main-text"]').innerText.toLowerCase();
            const secondaryText = materialItems[i].querySelector('p.text-base').innerText.toLowerCase();

            if (primaryText.includes(searchInput) || secondaryText.includes(searchInput)) {
                materialItems[i].style.display = '';
            } else {
                materialItems[i].style.display = 'none';
            }
        }
    }
</script>


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
<div class="relative p-6 bg-white border border-gray-300 rounded-lg" style="margin-right: 16px;">
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
</div>
<div class="fixed bottom-12 right-12">
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
@if(!empty($suppliers) )
@section('buttons-submenu')
<x-button-submenu id="suppliers" text="Proveedores" />
@endsection
@section('selected-submenu')
@if(!($suppliers->isEmpty()))
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
                    <input type="image" src="{{asset('img/borrar-x.png')}}" class="cursor-pointer h-3 mr-3">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="relative m-2">
    <a class="text-gray-400">Este material no cuenta con ningún proveedor</a>
</div>
@endif
@endsection
@endif
