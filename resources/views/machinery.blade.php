@extends('layouts.app')
@section('side-menu-items')
<div class="mb-4">
    <input type="text" id="search" placeholder="Buscar por nombre" onkeyup="filterMachineries()" class="w-full p-3 border border-gray-300 rounded-lg">
</div>

<div id="machinery-list">
    @foreach ($machineries as $machinery)
        <div class="machinery-item mb-2">
            <a href="{{ route('machinery.details', ['id' => $machinery->id]) }}" class="group block">
                <div id="{{ $machinery->id }}" class="side-menu-item cursor-pointer border-black border-x border-b border-opacity-100 border-solid w-full p-3 justify-start group-first:border-t hover:bg-gray-300 rounded-md">
                    <p id="{{ $machinery->id }}-main-text" class="text-xl w-fit">
                        {{ $machinery->name }}
                    </p>
                    <p class="text-base text-gray-400 w-fit">{{ $machinery->description }}</p>
                </div>
            </a>
        </div>
    @endforeach
</div>

<script>
    function filterMachineries() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const machineryItems = document.getElementsByClassName('machinery-item');
        
        for (let i = 0; i < machineryItems.length; i++) {
            const primaryText = machineryItems[i].querySelector('p[id$="-main-text"]').innerText.toLowerCase();
            const secondaryText = machineryItems[i].querySelector('p.text-base').innerText.toLowerCase();

            if (primaryText.includes(searchInput) || secondaryText.includes(searchInput)) {
                machineryItems[i].style.display = '';
            } else {
                machineryItems[i].style.display = 'none';
            }
        }
    }
</script>

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
<div class="relative p-6 bg-white border border-gray-300 rounded-lg" style="margin-right: 16px;">
<div class="relative">
    <div class="absolute right-0 top-0 flex">
        <img id="edit-item" src="{{asset('img/editar.png')}}" class="h-6 me-4 cursor-pointer">
        <img id="delete-item" src="{{asset('img/borrar.png')}}" class="h-6 cursor-pointer">
    </div>
</div>
<h1 id="name" class="text-4xl font-bold">{{$details->name}}</h1>
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
</div>
@endif
@endsection
