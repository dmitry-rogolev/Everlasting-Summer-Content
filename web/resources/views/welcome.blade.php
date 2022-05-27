<x-layout>

    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:theme>{{ $theme }}</x-slot:theme>

    <x-body>

        <x-slot:theme>{{ $theme }}</x-slot:theme>
        <x-slot:class></x-slot:class>
        <x-slot:style></x-slot:style>

        <x-element.background>

            <x-slot:theme>{{ $theme }}</x-slot:theme>
            <x-slot:class></x-slot:class>
            <x-slot:style></x-slot:style>

            <x-element.flex>

                <x-slot:theme>{{ $theme }}</x-slot:theme>
                <x-slot:class></x-slot:class>
                <x-slot:style></x-slot:style>
                <x-slot:flex>flex-column align-items-center</x-slot:flex>

                <x-body.header>

                    <x-slot:theme>{{ $theme }}</x-slot:theme>
                    <x-slot:class>col-12 max-width-xl</x-slot:class>
                    <x-slot:style></x-slot:style>

                    <x-element.flex>

                        <x-slot:theme>{{ $theme }}</x-slot:theme>
                        <x-slot:class></x-slot:class>
                        <x-slot:style></x-slot:style>
                        <x-slot:flex></x-slot:flex>

                        <x-element.nav>

                            <x-slot:theme>{{ $theme }}</x-slot:theme>
                            <x-slot:class>col-12 px-0</x-slot:class>
                            <x-slot:style></x-slot:style>

                            <x-element.flex>

                                <x-slot:theme>{{ $theme }}</x-slot:theme>
                                <x-slot:class></x-slot:class>
                                <x-slot:style></x-slot:style>
                                <x-slot:flex></x-slot:flex>

                                <x-element.div>

                                    <x-slot:theme>{{ $theme }}</x-slot:theme>
                                    <x-slot:class>col-12 my-2 px-0</x-slot:class>
                                    <x-slot:style></x-slot:style>

                                    <x-body.header.menu theme="{{ $theme }}" class="" style="" name="" url="" links="" themes="" login="true" />

                                </x-element.div>

                                <x-element.div>

                                    <x-slot:theme>{{ $theme }}</x-slot:theme>
                                    <x-slot:class>col-12 mb-2 px-0</x-slot:class>
                                    <x-slot:style></x-slot:style>

                                    <x-body.header.breadcrumbs theme="{{ $theme }}" breadcrumbs="" />

                                </x-element.div>

                            </x-element.flex>

                        </x-element.nav>
                        
                        <x-element.section>

                            <x-slot:theme>{{ $theme }}</x-slot:theme>
                            <x-slot:class>col-12 px-0</x-slot:class>
                            <x-slot:style></x-slot:style>

                            <x-element.flex>

                                <x-slot:theme>{{ $theme }}</x-slot:theme>
                                <x-slot:class></x-slot:class>
                                <x-slot:style></x-slot:style>
                                <x-slot:flex>justify-content-between</x-slot:flex>

                                <x-element.div>

                                    <x-slot:theme>{{ $theme }}</x-slot:theme>
                                    <x-slot:class>col-2 p-0</x-slot:class>
                                    <x-slot:style></x-slot:style>

                                    @if ($referer && is_string($referer))
                                        <x-element.flex>

                                            <x-slot:theme>{{ $theme }}</x-slot:theme>
                                            <x-slot:class></x-slot:class>
                                            <x-slot:style></x-slot:style>
                                            <x-slot:flex></x-slot:flex>

                                            <x-element.a>

                                                <x-slot:theme>{{ $theme }}</x-slot:theme>
                                                <x-slot:class></x-slot:class>
                                                <x-slot:style></x-slot:style>
                                                <x-slot:name></x-slot:name>
                                                <x-slot:href>{{ $referer }}</x-slot:href>

                                                <x-element.button theme="{{ $theme }}" name="<" title="Назад" />
                                            
                                            </x-element.a>

                                        </x-element.flex>
                                    @endif

                                </x-element.div>

                                <x-element.div>

                                    <x-slot:theme>{{ $theme }}</x-slot:theme>
                                    <x-slot:class>col-8 p-0</x-slot:class>
                                    <x-slot:style></x-slot:style>

                                    @if ($header && is_string($header))
                                        <x-element.flex>

                                            <x-slot:theme>{{ $theme }}</x-slot:theme>
                                            <x-slot:class></x-slot:class>
                                            <x-slot:style></x-slot:style>
                                            <x-slot:flex>justify-content-center</x-slot:flex>

                                            <x-element.header3 theme="{{ $theme }}" name="{{ $header }}" />

                                        </x-element.flex>
                                    @endif

                                </x-element.div>

                                <x-element.div>

                                    <x-slot:theme>{{ $theme }}</x-slot:theme>
                                    <x-slot:class>col-2 p-0</x-slot:class>
                                    <x-slot:style></x-slot:style>

                                    <x-element.flex>

                                        <x-slot:theme>{{ $theme }}</x-slot:theme>
                                        <x-slot:class></x-slot:class>
                                        <x-slot:style></x-slot:style>
                                        <x-slot:flex>justify-content-end</x-slot:flex>

                                        <x-element.a>

                                            <x-slot:theme>{{ $theme }}</x-slot:theme>
                                            <x-slot:class></x-slot:class>
                                            <x-slot:style></x-slot:style>
                                            <x-slot:name></x-slot:name>
                                            <x-slot:href>{{ url()->current() . '/download/all' }}</x-slot:href>

                                            <x-element.button theme="{{ $theme }}" name="⤓" title="Скачать все" />

                                        </x-element.a>

                                    </x-element.flex>

                                </x-element.div>

                            </x-element.flex>

                        </x-element.section>

                    </x-element.flex>

                </x-body.header>

                <x-body.main>

                    <x-slot:theme>{{ $theme }}</x-slot:theme>
                    <x-slot:class>col-12 max-width-xl</x-slot:class>
                    <x-slot:style></x-slot:style>

                    <x-element.flex>

                        <x-slot:theme>{{ $theme }}</x-slot:theme>
                        <x-slot:class></x-slot:class>
                        <x-slot:style></x-slot:style>
                        <x-slot:flex>flex-column</x-slot:flex>

                    </x-element.flex>

                </x-body.main>

            </x-element.flex>

        </x-element.background>

    </x-body>
    
</x-layout>