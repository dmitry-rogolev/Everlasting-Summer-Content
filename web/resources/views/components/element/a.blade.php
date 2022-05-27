<a id="{{ $id }}" href="{{ $href }}" class="{{ $class }}" style="{{ $style }}">
    @if ($name) {{ $name }} @endif
    {{ $slot }}
</a>
