<div class="custom-file">
    <input type="file" class="custom-file-input {{ $class }}" {{ $attributes }} id="{{ $id }}" onchange="document.querySelector('label[for={{ $id }}]').textContent = this.files[0].name;" />
    @if ($label)
        <label style="border-radius: .5rem" class="custom-file-label bg-{{ $theme }} border-secondary text-{{ $inversion_themes->get($theme) }}" for="{{ $id }}">
            {{ $label }}
        </label>
    @endif
</div>