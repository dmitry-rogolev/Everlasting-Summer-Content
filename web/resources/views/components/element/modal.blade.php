<section class="modal fade {{ $class }}" tabindex="-1" aria-labelledby="{{ $labelledby }}" aria-hidden="true" {{ $attributes }}>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-{{ $theme }} border-{{ $theme }} text-{{ $inversion_themes->get($theme) }}" style="border-radius: 15px;">
            {{ $slot }}
        </div>
    </div>
</section>