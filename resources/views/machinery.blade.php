@extends('layouts.app')
@section('side-menu-items')
@foreach ($machineries as $machinery)
<x-side-menu-item primary="{{$machinery->name}}" id="{{$machinery->id}}" />
@endforeach

<div class="fixed bottom-12">
    <button id="openPopupButton_left" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</button>
</div>

<div id="form_add_machinery" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_machinery')
    </div>
</div>
<div id="form_edit_machinery" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_edit_machinery')
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
        const sideMenuItems = document.querySelectorAll('.side-menu-item');
        sideMenuItems.forEach(item => {
            item.addEventListener('click', function(event) {
                currentItemId = this.id;
                fetch(`/machinery/${currentItemId}`)
                    .then(response => response.json())
                    .then(data => {
                        data = data[0]
                        document.getElementById('name').innerText = data.name;
                        document.getElementById('quantity').innerText = data.quantity;
                        document.getElementById('day_price').innerText = data.day_price;
                    })
                    .then(() => document.getElementById('selected-main').classList.remove('hidden'))
                    .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
@endsection
@section('selected-main')
<h1 id="name" class="text-4xl font-bold"></h1>
<br>
<strong class="text-xl font-semibold">Cantidad: </strong><span id="quantity" class="text-customYellow"></span>
<br>
<strong class="text-xl font-semibold">Precio/Día: </strong><span id="day_price" class="text-customYellow"></span>
@endsection
