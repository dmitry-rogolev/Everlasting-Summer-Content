<div class="custom-control custom-checkbox">
    <input type="checkbox" class="custom-control-input {{ $class }}" id="{{ $id }}" {{ $attributes }} />
    @if ($label) 
        <x-element.form.label class="custom-control-label" for="{{ $id }}">
            {{ $label }}
        </x-element.form.label>
    @endif
</div>
<script>
    $("{{ $id }}").prop("indeterminate", true);
</script>