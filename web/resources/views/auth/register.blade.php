<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-body>
        <x-element.background>
            <x-element.flex class="{{ 'bg-' . $theme }}" style="height: 300px;" flex="flex-column">

            </x-element.flex>
        </x-element.background>
    </x-body>
</x-layout>