@if ($label) 
    <label for="{{ $id }}">
        {!! $label !!}
    </label>
@endif
<select class="form-control {{ $class }}" id="{{ $id }}" {{ $attributes }}>
    {{ $slot }}
</select>