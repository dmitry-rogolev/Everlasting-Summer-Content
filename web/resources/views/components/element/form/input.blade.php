@if ($label) 
    <x-element.form.label for="{{ $id }}">
        {{ $label }}
    </x-element.form.label>
@endif
<input {{ $attributes }} class="form-control {{ $class }}" id="{{ $id }}" @if ($small) aria-describedby="{{ $aria }}" @endif />
@if ($small)
    <x-element.small id="{{ $aria }}" class="form-text text-muted">
        {{ $small }}
    </x-element.small>
@endif