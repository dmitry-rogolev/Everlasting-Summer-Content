<!DOCTYPE html>
<html lang="ru">
    <x-head theme="{{ $theme }}" />
    <body class="background height-100">
        <div class="container-fluid">
            <div class="row flex-column align-items-center">
                <header class="col-12 max-width-xl">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 my-2 px-0">
                                <x-body.header.menu />
                            </div>
                            <div class="col-12 mb-2 px-0">
                                <x-body.header.breadcrumbs />
                            </div>
                        </div>
                    </div>
                </header>
                <main class="col-12 max-width-xl">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 p-0">
                                <div class="container-fluid">
                                    <div class="row flex-column">
                                        <section class="col-12 mb-2 p-0">
                                            <x-body.main.header header="{{ $header }}" referer="{{ $referer }}" />
                                        </section>
                                        <section class="col-12 p-0">
                                            {{ $slot }}
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>