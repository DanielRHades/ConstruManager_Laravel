@extends('layouts.app')
@section('side-menu-items')
<div class="mb-4">
    <input type="text" id="search" placeholder="Buscar por nombre" onkeyup="filterUsers()" class="w-full p-3 border border-gray-300 rounded-lg">
</div>

<div id="users-list">
    @foreach ($users as $user)
        <div class="user-item mb-2">
            <a href="{{ route('users.details', ['id' => $user->id]) }}" class="group block">
                <div id="{{ $user->id }}" class="side-menu-item cursor-pointer border-black border-x border-b border-opacity-100 border-solid w-full p-3 justify-start group-first:border-t hover:bg-gray-300 rounded-md">
                    <p id="{{ $user->id }}-main-text" class="text-xl w-fit">
                        {{ $user->name }}
                    </p>
                    <p class="text-base text-gray-400 w-fit">{{ $user->email }}</p>
                </div>
            </a>
        </div>
    @endforeach
</div>

<script>
    function filterUsers() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const userItems = document.getElementsByClassName('user-item');
        
        for (let i = 0; i < userItems.length; i++) {
            const primaryText = userItems[i].querySelector('p[id$="-main-text"]').innerText.toLowerCase();

            if (primaryText.includes(searchInput)) {
                userItems[i].style.display = '';
            } else {
                userItems[i].style.display = 'none';
            }
        }
    }
</script>

<script>
    let currentItemId
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('edit-item').addEventListener('click', function() {
            document.getElementById('name-edit').value = document.getElementById('name').innerText
            document.getElementById('email-edit').value = document.getElementById('email').innerText
            document.getElementById('form_edit_user').classList.toggle('hidden');
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
<strong class="text-xl font-semibold">Tipo: </strong><span id="type" class="text-customYellow">{{$details->type}}</span>
<br>
<strong class="text-xl font-semibold">Email: </strong><span id="email" class="text-customYellow">{{$details->email}}</span>
<div id="form_edit_user" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <x-form_edit_user id="{{$details->id}}" />
    </div>
</div>
<div id="form_delete" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <x-form-delete section="users" id="{{$details->id}}" />
    </div>
</div>
</div>
@endif
@endsection