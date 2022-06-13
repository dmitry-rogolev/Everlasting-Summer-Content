<x-element.flex class="h-100" flex="flex-column justify-content-end h-100">
    <h4 class="name bg-{{ $theme }} text-{{ $inversion_themes->get($theme) }} text-center mb-0 pt-2 pb-1 {{ $class }}" {{ $attributes }}>
        {{ $slot }}
    </h4>
</x-element.flex>