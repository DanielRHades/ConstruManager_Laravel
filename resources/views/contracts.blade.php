@extends('layouts.app')
@section('side-menu-items')
<x-side-menu-item primary="Contrato 1" primary2="01/03/2024" secondary="Luis Eduardo Jaimes Hernández" route="momazos.com" />
<x-side-menu-item primary="Contrato 2" primary2="05/03/2024" secondary="Luis Eduardo Jaimes Hernández" route="momazos.com" />

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
</script>

@endsection
@section('selected-main')
<h1 class="text-4xl font-bold">Contrato 1 - 07/05/2024</h1>
</br>
<p>Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim labore culpa sint ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi anim cupidatat excepteur officia. Reprehenderit nostrud nostrud ipsum Lorem est aliquip amet voluptate voluptate dolor minim nulla est proident. Nostrud officia pariatur ut officia. Sit irure elit esse ea nulla sunt ex occaecat reprehenderit commodo officia dolor Lorem duis laboris cupidatat officia voluptate. Culpa proident adipisicing id nulla nisi laboris ex in Lorem sunt duis officia eiusmod. Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim. Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et culpa duis.</p>
</br>
<strong class="bottom-0">Luis Eduardo Jaimes Hernández - Luis@compañia.com - 3156843255 - Persona natural</strong>
@endsection
@section('buttons-submenu')
<x-button-submenu text="Contactos" />
<x-button-submenu text="Materiales" />
<x-button-submenu text="Maquinarias" />
<x-button-submenu text="Registros" />
@endsection
@section('selected-submenu')
<table class="table-auto w-full">
    <tr class="border-b">
        <th>Nombre</th>
        <th>Rol</th>
        <th>Correo</th>
        <th>Teléfono</th>
    </tr>
    <tr class="border-b">
        <th>Pedro Sanchez</th>
        <th>Ingeniero</th>
        <th>daniel@compañia.com</th>
        <th>3214567756</th>
    </tr>
    <tr class="border-b">
        <th>Daniel Leonardo Rodríguez Hernández</th>
        <th>Arquitecto</th>
        <th>daniel@compañia.com</th>
        <th>3214567756</th>
    </tr>
    <tr class="border-b">
        <th>Daniel Leonardo Rodríguez Hernández</th>
        <th>Encargado de obra</th>
        <th>daniel@compañia.com</th>
        <th>3214567756</th>
    </tr>
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
