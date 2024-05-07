@extends('layouts.app')
@section('side-menu-items')
<x-side-menu-item primary="Pedro Perez" secondary="3203123001" route="momazos.com" />
<x-side-menu-item primary="Luis Jaimes" secondary="3203123001" route="momazos.com" />

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
</script>

@endsection
@section('selected-main')
<div class="relative">
    <a class="text-4xl font-bold">Pedro Perez</a>
</div>
<div class="mt-4">
    <h1 class="text-xl font-semibold">Email: <span class="text-customYellow">pedro@gmail.com</span></h1>
</div>
<div class="mt-2">
    <strong class="text-xl font-semibold">Telefono: <span class="text-customYellow">3203123001</span></strong>
</div>
@endsection
@section('buttons-submenu')
<x-button-submenu text="Materiales" />
@endsection
@section('selected-submenu')
<table class="table-auto w-full">
    <tr class="border-b">
        <th>Nombre</th>
        <th>Precio/Unidad</th>
    </tr>
    <tr class="border-b">
        <th>Cemento Bolsa 10KG</th>
        <th>10000</th>
    </tr>
    <tr class="border-b">
        <th>Grava Bolsa 30KG</th>
        <th>50000</th>
    </tr>
    <tr class="border-b">
        <th>Arena Bolsa 15KG</th>
        <th>40000</th>
    </tr>
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
