@php
if (!empty($active) && $active==true){
$bg='bg-gray-300';
}else {
$bg='bg-gray-100';
}
@endphp
@if(!empty($route))
<a href="{{ $route }}">
    <button id="{{ empty($id) ? 0 : $id }}" class="button-submenu px-3 {{$bg}} border">
        {{ $text }}
    </button>
</a>
@else
<button id="{{ empty($id) ? 0 : $id }}" class="button-submenu px-3 {{$bg}} border">
    {{ $text }}
</button>
@endif
