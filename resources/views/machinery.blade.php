@extends('layouts.app')
@section('side-menu-items')
@foreach ($machineries as $machinery)
<x-side-menu-item primary="{{$machinery->name}}" id="{{$machinery->id}}" section="machinery" />
@endforeach

<div class="fixed bottom-12">
    <button id="openPopupButton_left" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</button>
</div>

<div id="form_add_machinery" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_machinery')
    </div>
</div>

<script>
    let currentItemId
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('openPopupButton_left').addEventListener('click', function() {
            document.getElementById('form_add_machinery').classList.toggle('hidden');
        });
        document.getElementById('edit-item').addEventListener('click', function() {
            document.getElementById('name-edit').value = document.getElementById('name').innerText
            document.getElementById('quantity-edit').value = document.getElementById('quantity').innerText
            document.getElementById('price-edit').value = document.getElementById('day_price').innerText
            document.getElementById('form_edit_machinery').classList.toggle('hidden');
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
<h1 id="name" class="text-4xl font-bold">{{$details->name}}</h1>
<br>
<strong class="text-xl font-semibold">Cantidad: </strong><span id="quantity" class="text-customYellow">{{$details->quantity}}</span>
<br>
<strong class="text-xl font-semibold">Precio/Día: </strong><span id="day_price" class="text-customYellow">{{$details->day_price}}</span>
<div id="form_edit_machinery" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <x-form_edit_machinery id="{{$details->id}}" />
    </div>
</div>
<div id="form_delete" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <x-form-delete section="machinery" id="{{$details->id}}" />
    </div>
</div>
@endif
@endsection
