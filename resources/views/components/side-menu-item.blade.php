    <div id="{{empty($id)?0:$id}}" class="side-menu-item cursor-pointer border-black border-x border-b border-opacity-100 border-solid w-full p-3 justify-start first:border-t hover:bg-gray-300">
        <p class="text-xl w-fit">
            @php
            {{
        if (!empty($primary2)) {
            echo $primary . ' - ' . $primary2;
        } else {
            echo $primary;
        }
        }}
            @endphp
        </p>
        <p class="text-base text-gray-400 w-fit">
            @php
            {{
        if (!empty($secondary)) {
            echo $secondary;
        }}}
            @endphp
        </p>
    </div>
