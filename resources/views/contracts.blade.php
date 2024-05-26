@extends('layouts.app')
@section('side-menu-items')
@foreach ($contracts as $contract)
<x-side-menu-item id="{{$contract->id}}" primary="Contrato {{$contract->id}}" primary2="{{implode('/',explode('-',$contract->date))}}" secondary="{{$contract->name}}" section="contracts" />
@endforeach

<div class="fixed bottom-12">
    <button id="openPopupButton_left_1" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</button>
</div>



<div id="form_add_contract" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_contract')
    </div>
</div>

<script>
    document.getElementById('openPopupButton_left_1').addEventListener('click', function() {
        document.getElementById('form_add_contract').classList.toggle('hidden');
    });
</script>

@endsection
@if(!empty($details))
<div id="form_edit_contract" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <x-form_edit_contract id="{{$details->id}}" />
    </div>
</div>

<div id="form_add_customer" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_customer')
    </div>
</div>

<div id="form_delete" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <x-form-delete section="contracts" id="{{$details->id}}" />
    </div>
</div>


@section('selected-main')
<div class="relative">
    <div class="absolute right-0 top-0 flex">
        <img id="edit-item" src="{{asset('img/editar.png')}}" class="h-6 me-4 cursor-pointer">
        <img id="delete-item" src="{{asset('img/borrar.png')}}" class="h-6 cursor-pointer">
    </div>
</div>
<h1 class="text-4xl font-bold">Contrato <a id="id">{{$details->id}}</a> - <a id="date">{{$details->date}}</a></h1>
</br>
<p id="description">{{$details->description}}</p>
</br>
@if (!empty($details->name))
<strong class="bottom-0"><a id="name">{{ $details->name }}</a> - <a id="e-mail">{{ $details->email }}</a> - <a id="phone">{{ $details->phone }}</a> - <a id="type">{{ $details->type }}</a></strong>

@else
<div class="fixed bottom-12 left-20">
    <button id="openPopupButton_left_2" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</button>
</div>
<script>
    document.getElementById('openPopupButton_left_2').addEventListener('click', function() {
        document.getElementById('form_add_customer').classList.toggle('hidden');
        document.getElementById('contract_id_customer').value = "{{$details->id}}"
    });
</script>
@endif
<script>
    document.getElementById('edit-item').addEventListener('click', function() {
        document.getElementById('description-edit').value = document.getElementById('description').innerText
        document.getElementById('date-edit').value = document.getElementById('date').innerText.split('/').join('-')
        document.getElementById('form_edit_contract').classList.toggle('hidden');
    });
</script>
@endsection
@section('buttons-submenu')
<x-button-submenu id="contacts" text="Contactos" route="{{route('contracts.categories',['id'=>$details->id,'category'=>'contacts'])}}" active="{{!empty($category)?($category == 'contacts'):false}}" />
<x-button-submenu id="materials" text="Materiales" route="{{route('contracts.categories',['id'=>$details->id,'category'=>'materials'])}}" active="{{!empty($category)?($category == 'materials'):false}}" />
<x-button-submenu id="machinery" text="Maquinarias" route="{{route('contracts.categories',['id'=>$details->id,'category'=>'machinery'])}}" active="{{!empty($category)?($category == 'machinery'):false}}" />
<x-button-submenu id="records" text="Registros" route="{{route('contracts.categories',['id'=>$details->id,'category'=>'records'])}}" active="{{!empty($category)?($category == 'records'):false}}" />
@if(!empty($category))
<div class="fixed bottom-12 right-8">
    <button id="openPopupButton_right" class="bg-customYellow hover:bg-yellow-400 text-white font-bold py-4 px-4 rounded-lg shadow-lg">+</button>
</div>
@switch($category)

@case('contacts')
<div id="form_add_contact" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_contact')
    </div>
</div>
@section('selected-submenu')
@if(!($data->isEmpty()))
<table id="table-submenu" class="table-auto w-full ">
    <thead>
        <tr id="table-submenu-head" class="border-b">
            <th class="text-left">Nombre</th>
            <th class="text-left">Rol</th>
            <th class="text-left">Email</th>
            <th class="text-left">Teléfono</th>
            <th class="text-left"></th>
        </tr>
    </thead>
    <tbody id="table-sub-submenu">
        @if(!empty($data))
        @foreach($data as $entry)
        <tr >
            <td class="border-b">{{$entry->name}}</td>
            <td class="border-b">{{$entry->role}}</td>
            <td class="border-b">{{$entry->email}}</td>
            <td class="border-b">{{$entry->phone}}</td>
            <td>
                <form class="flex justify-center align-middle mb-0" method="post" action="{{route('contacts.delete')}}">
                    @csrf
                    <input type="hidden" name="current_route" value="{{ Route::currentRouteName() }}">
                    <input type="hidden" name="current_id" value="{{$details->id}}">
                    <input type="hidden" name="contact_id" value="{{$entry->id}}">
                    <input type="image" src="{{asset('img/borrar-x.png')}}" class="cursor-pointer h-3">
                </form>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
@else
<div class="relative m-2">
    <a class="text-gray-400">Este contrato no cuenta con ningún contacto</a>
</div>
@endif
<script>
    document.getElementById('openPopupButton_right').addEventListener('click', function() {
        document.getElementById('form_add_contact').classList.toggle('hidden')
        document.getElementById('contract_id').value = "{{$details->id}}"
        document.getElementById('contract_category').value = "{{$category}}"
    })
</script>

@endsection
@case('materials')
<div id="form_add_existing_material_contract" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_existing_material_contract')
    </div>
</div>
@section('selected-submenu')
@if(!($data->isEmpty()))
<table id="table-submenu" class="table-auto w-full ">
    <thead>
        <tr id="table-submenu-head" class="border-b">
            <th class="text-left">Nombre</th>
            <th class="text-left">Cantidad</th>
            <th class="text-left">Precio/Unidad</th>
            <th class="text-left"></th>
        </tr>
    </thead>
    <tbody id="table-sub-submenu">
        @if(!empty($data))
        @foreach($data as $entry)
        <tr>
            <td class="border-b">{{$entry->name}}</td>
            <td class="border-b">{{$entry->quantity}}</td>
            <td class="border-b">{{$entry->unit_price}}</td>
            <td>
                <form class="flex justify-center align-middle mb-0" method="post" action="{{route('contracts_materials.delete')}}">
                    @csrf
                    <input type="hidden" name="current_route" value="{{ Route::currentRouteName() }}">
                    <input type="hidden" name="contract_id" value="{{$details->id}}">
                    <input type="hidden" name="material_id" value="{{$entry->id}}">
                    <input type="image" src="{{asset('img/borrar-x.png')}}" class="cursor-pointer h-3">
                </form>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
@else
<div class="relative m-2">
    <a class="text-gray-400">Este contrato no cuenta con ningún material</a>
</div>
@endif
<script>
    document.getElementById('openPopupButton_right').addEventListener('click', function() {
        document.getElementById('form_add_existing_material_contract').classList.toggle('hidden')
        document.getElementById('contract_id').value = "{{$details->id}}"
        document.getElementById('contract_category').value = "{{$category}}"
    })
</script>


@endsection
@case('machinery')
<div id="form_add_existing_machinery" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_existing_machinery')
    </div>
</div>
@section('selected-submenu')
@if(!($data->isEmpty()))
<table id="table-submenu" class="table-auto w-full ">
    <thead>
        <tr id="table-submenu-head" class="border-b">
            <th class="text-left">Nombre</th>
            <th class="text-left">Cantidad</th>
            <th class="text-left">Días</th>
            <th class="text-left">Precio/Día</th>
            <th class="text-left"></th>
        </tr>
    </thead>
    <tbody id="table-sub-submenu">
        @if(!empty($data))
        @foreach($data as $entry)
        <tr>
            <td class="border-b">{{$entry->name}}</td>
            <td class="border-b">{{$entry->quantity}}</td>
            <td class="border-b">{{$entry->days}}</td>
            <td class="border-b">{{$entry->day_price}}</td>
            <td>
                <form class="flex justify-center align-middle mb-0" method="post" action="{{route('contracts_machinery.delete')}}">
                    @csrf
                    <input type="hidden" name="current_route" value="{{ Route::currentRouteName() }}">
                    <input type="hidden" name="contract_id" value="{{$details->id}}">
                    <input type="hidden" name="machinery_id" value="{{$entry->id}}">
                    <input type="image" src="{{asset('img/borrar-x.png')}}" class="cursor-pointer h-3 ">
                </form>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
@else
<div class="relative m-2">
    <a class="text-gray-400">Este contrato no cuenta con ningúna maquinaria</a>
</div>
@endif
<script>
    document.getElementById('openPopupButton_right').addEventListener('click', function() {
        document.getElementById('form_add_existing_machinery').classList.toggle('hidden')
        document.getElementById('contract_id').value = "{{$details->id}}"
        document.getElementById('contract_category').value = "{{$category}}"
    })
</script>


@endsection
@case('records')
<div id="form_add_record" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_add_record')
    </div>
</div>
<div id="form_edit_record" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.form_edit_record')
    </div>
</div>
<div id="record-details" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        @include('components.record_details_popup')
    </div>
</div>
@section('selected-submenu')
@if(!($data->isEmpty()))
<table id="table-submenu" class="table-auto w-full ">
    <thead>
        <tr id="table-submenu-head" class="border-b">
            <th class="text-left">Código</th>
            <th class="text-left">Fecha</th>
            <th class="text-left"></th>
            <th class="text-left"></th>
            <th class="text-left"></th>
        </tr>
    </thead>
    <tbody id="table-sub-submenu">
        @if(!empty($data))
        @foreach($data as $entry)
        <tr>
            <td class="border-b">{{$entry->id}}</td>
            <td class="border-b">{{$entry->date}}</td>
            <td>
                <form class="flex justify-center align-middle mb-0" method="post" action="{{route('records.delete')}}">
                    @csrf
                    <input type="hidden" name="current_route" value="{{ Route::currentRouteName() }}">
                    <input type="hidden" name="current_id" value="{{$details->id}}">
                    <input type="hidden" name="record_id" value="{{$entry->id}}">
                    <input type="image" src="{{asset('img/borrar-x.png')}}" class="cursor-pointer h-3">
                </form>
            </td>
            <td><img id="record-button-{{$entry->id}}" src="{{asset('img/editar.png')}}" class="cursor-pointer h-2" /></td>
            <td><img id="record-button-details-{{$entry->id}}" src="{{asset('img/mas.png')}}" class="cursor-pointer h-2" /></td>
            <script>
                document.getElementById('record-button-{{$entry->id}}').addEventListener('click', function() {
                    document.getElementById('form_edit_record').classList.toggle('hidden')
                    document.getElementById('record_id').value = "{{$entry->id}}"
                    document.getElementById('record_contract_id').value = "{{$details->id}}"
                    fetch('/records/{{$entry->id}}')
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('record-description-edit').value = data.description
                            document.getElementById('record-date-edit').value = data.date
                        })
                        .catch(err => console.log(err))
                })
                document.getElementById('record-button-details-{{$entry->id}}').addEventListener('click', function() {
                    fetch('/records/{{$entry->id}}')
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('record-details-date').innerText = data.date.split('-').join('/')
                            document.getElementById('record-details-description').innerText = data.description

                        })
                        .then(document.getElementById('record-details').classList.toggle('hidden'))
                })
            </script>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
@else
<div class="relative m-2">
    <a class="text-gray-400">Este contrato no cuenta con ningún registro</a>
</div>
@endif

<script>
    document.getElementById('openPopupButton_right').addEventListener('click', function() {
        document.getElementById('form_add_record').classList.toggle('hidden')
        document.getElementById('contract_id').value = "{{$details->id}}"
        document.getElementById('contract_category').value = "{{$category}}"
    })
</script>


@endsection
@endswitch

@endif
@endsection
@endif
