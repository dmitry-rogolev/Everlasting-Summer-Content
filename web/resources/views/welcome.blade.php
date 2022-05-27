<x-layout>

    <x-slot:title>
        {{ $title }}
    </x-slot:title>
    <x-slot:theme>
        {{ $theme }}
    </x-slot:theme>

    <body class="background height-100">
        <div class="background-albugo height-100">
            <div class="container-fluid">
                <div class="row flex-column align-items-center">
                    <x-body.header theme="{{ $theme }}" class="col-12 max-width-xl" />
                    <main class="col-12 max-width-xl">
                        <div class="container-fluid">
                            <div class="row flex-column">
                                <section class="col-12 mb-2 p-0">
                                    <x-body.main.header header="{{ $header }}" referer="{{ $referer }}" />
                                </section>
                                <section class="col-12 p-0">
                                    
                                </section>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </body>
    
</x-layout>