@extends('layouts.app')
@section('side-menu-items')
<x-side-menu-item primary="Cemento Bolsa 20KG" route="momazos.com" />
<x-side-menu-item primary="Grava Bolsa 20KG" route="momazos.com" />

<div class="fixed bottom-12">
    <button id="openPopupButton_left" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</button>
</div>

<div id="form_add_material" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_material')
    </div>
</div>

<script>
    document.getElementById('openPopupButton_left').addEventListener('click', function() {
        document.getElementById('form_add_material').classList.toggle('hidden');
    });
</script>

@endsection
@section('selected-main')
<div class="relative">
    <a class="text-4xl font-bold">Cemento Bolsa 20KG</a>
</div>
<div class="mt-4">
    <h1 class="text-xl font-semibold">Cantidad: <span class="text-customYellow">100</span></h1>
</div>
<div class="mt-2">
    <strong class="text-xl font-semibold">Precio/Unidad: <span class="text-customYellow">20000</span></strong>
</div>
@endsection
@section('buttons-submenu')
<x-button-submenu text="Proveedores" />
@endsection
@section('selected-submenu')
<table class="table-auto w-full">
    <tr class="border-b">
        <th>Nombre</th>
        <th>Correo</th>
        <th>Teléfono</th>
    </tr>
    <tr class="border-b">
        <th>Daniel Leonardo Rodríguez Hernández</th>
        <th>daniel@compañia.com</th>
        <th>3214567756</th>
    </tr>
    <tr class="border-b">
        <th>Daniel Leonardo Rodríguez Hernández</th>
        <th>daniel@compañia.com</th>
        <th>3214567756</th>
    </tr>
    <tr class="border-b">
        <th>Daniel Leonardo Rodríguez Hernández</th>
        <th>daniel@compañia.com</th>
        <th>3214567756</th>
    </tr>
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
