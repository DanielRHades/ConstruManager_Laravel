@php $id=empty($id)?0:$id @endphp
<div id="{{$id}}" class="side-menu-item cursor-pointer border-black border-x border-b border-opacity-100 border-solid w-full p-3 justify-start first:border-t hover:bg-gray-300">
    <p id="{{ $id }}-main-text" class="text-xl w-fit">
        @php
        if (!empty($primary2)) {
        echo "$primary - <span id='$id-main-text-2'>$primary2</span>";
        } else {
        echo $primary;
        }
        @endphp
    </p>
    <p class="text-base text-gray-400 w-fit">
        @php
        if (!empty($secondary)) {
        echo $secondary;
        }
        @endphp
    </p>
</div>
