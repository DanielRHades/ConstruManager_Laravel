@extends('layouts.app')
@section('side-menu-items')
<x-side-menu-item primary="Contrato 1" primary2="01/03/2024" secondary="Luis Eduardo Jaimes Hernández" route="momazos.com" />
<x-side-menu-item primary="Contrato 1" secondary="Luis Eduardo Jaimes Hernández" route="momazos.com" />

<div class="fixed bottom-12">
    <a href="#" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</a>
</div>

@endsection
@section('selected-main')
<div class="relative">
    <a class="text-3xl ">Contrato 1 - 01/03/2024</a>
    <div class="absolute right-0 top-0 flex">
        <img src="{{asset('img/editar.png')}}" class="h-6 me-4" href="">
        <img src="{{asset('img/borrar.png')}}" class="h-6" href="">
    </div>
</div>
<p>Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim labore culpa sint ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi anim cupidatat excepteur officia. Reprehenderit nostrud nostrud ipsum Lorem est aliquip amet voluptate voluptate dolor minim nulla est proident. Nostrud officia pariatur ut officia. Sit irure elit esse ea nulla sunt ex occaecat reprehenderit commodo officia dolor Lorem duis laboris cupidatat officia voluptate. Culpa proident adipisicing id nulla nisi laboris ex in Lorem sunt duis officia eiusmod. Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim. Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et culpa duis.</p>
<strong class="bottom-0">Luis Eduardo Jaimes Hernández - Luis@compañia.com - 3156843255 - Persona natural</strong>
@endsection
@section('buttons-submenu')
<x-button-submenu text="Clientes" />
<x-button-submenu text="Materiales" />
<x-button-submenu text="Maquinarias" />
<x-button-submenu text="Registros" />
@endsection
@section('selected-submenu')
<table class="table-auto w-full">
    <tr class="border-b">
        <th>Nombre</th>
        <th>Cargo</th>
        <th>Correo</th>
        <th>Teléfono</th>
    </tr>
    <tr class="border-b">
        <th>Daniel Leonardo Rodríguez Hernández</th>
        <th>Cargo 1</th>
        <th>daniel@compañia.com</th>
        <th>3214567756</th>
    </tr>
    <tr class="border-b">
        <th>Daniel Leonardo Rodríguez Hernández</th>
        <th>Cargo 1</th>
        <th>daniel@compañia.com</th>
        <th>3214567756</th>
    </tr>
    <tr class="border-b">
        <th>Daniel Leonardo Rodríguez Hernández</th>
        <th>Cargo 1</th>
        <th>daniel@compañia.com</th>
        <th>3214567756</th>
    </tr>
</table>

<div class="fixed bottom-12 right-8">
    <a href="#" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</a>
</div>

@endsection
