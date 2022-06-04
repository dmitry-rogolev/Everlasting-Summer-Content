@if ($label)
    <label for="{{ $id }}">
        {!! $label !!}
    </label>
@endif
<input type="range" class="custom-range {{ $class }}" id="{{ $id }}" {{ $attributes }} />