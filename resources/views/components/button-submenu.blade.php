@if(!empty($route))
<a href="{{ $route }}">
    <button id="{{ empty($id) ? 0 : $id }}" class="button-submenu px-3 bg-gray-100 border">
        {{ $text }}
    </button>
</a>
@else
<button id="{{ empty($id) ? 0 : $id }}" class="button-submenu px-3 bg-gray-100 border">
    {{ $text }}
</button>
@endif
