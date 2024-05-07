@extends('layouts.app')
@section('side-menu-items')
<x-side-menu-item primary="Vibradora de concreto" route="momazos.com" />
<x-side-menu-item primary="Trompo" route="momazos.com" />

<div class="fixed bottom-12">
    <button id="openPopupButton_left" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</button>
</div>

<div id="form_add_machinery" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_machinery')
    </div>
</div>

<script>
    document.getElementById('openPopupButton_left').addEventListener('click', function() {
        document.getElementById('form_add_machinery').classList.toggle('hidden');
    });
</script>
@endsection
@section('selected-main')
<div class="relative">
    <a class="text-4xl font-bold">Vibradora de concreto</a>
</div>
<div class="mt-4">
    <h1 class="text-xl font-semibold">Cantidad: 10 <span class="text-customYellow">100</span></h1>
</div>
<div class="mt-2">
    <strong class="text-xl font-semibold">Precio/Dia: 30000 <span class="text-customYellow">20000</span></strong>
</div>
@endsection
