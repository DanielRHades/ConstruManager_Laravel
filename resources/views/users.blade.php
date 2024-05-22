@extends('layouts.app')
@section('side-menu-items')
@foreach ($users as $user)
<x-side-menu-item primary="{{$user->name}}" id="{{$user->id}}" section="users" />
@endforeach

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
<div class="relative">
    <div class="absolute right-0 top-0 flex">
        <img id="edit-item" src="{{asset('img/editar.png')}}" class="h-6 me-4 cursor-pointer">
        <img id="delete-item" src="{{asset('img/borrar.png')}}" class="h-6 cursor-pointer">
    </div>
</div>
<h1 id="name" class="text-4xl font-bold">{{$details->name}}</h1>
<br>
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
@endif
@endsection