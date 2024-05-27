@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }}>
        @foreach ((array) $messages as $message)
        @if($message == "auth.failed")
            <li>Credenciales incorrectas</li>
        @endif
        @if ($message == "validation.unique")
            <li>Este correo ya existe</li>
        @endif
        @endforeach
    </ul>
@endif
