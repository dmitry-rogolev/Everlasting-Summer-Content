<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-body>
        <x-element.background>
            <x-element.flex flex="flex-column align-items-center justify-content-center h-max" style="height: 100%;">
                <x-element.div class="col-xl-5 col-lg-6 col-md-7 col-sm-9 col-11 {{ 'bg-' . $theme }}" style="height: 300px;">
                    <x-element.flex flex="flex-column">
                        <x-body.header>
                            <x-element.a class="d-block">
                                <x-element.h1>
                                    {{ $title }}
                                </x-element.h1>
                            </x-element.a>
                        </x-body.header>
                    </x-element.flex>
                </x-element.div>
            </x-element.flex>
        </x-element.background>
    </x-body>
</x-layout>