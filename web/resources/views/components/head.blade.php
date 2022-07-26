<head>
    <meta charset="{{ $charset }}" />
    <meta name="viewport" content="{{ $viewport }}" />
    <meta name="keywords" content="{{ $keywords }}" />
    <meta name="description" content="{{ $description }}" />
    <meta name="author" lang="ru" content="{{ $author }}" />
    <meta name="robots" content="{{ $robots }}" />
    <link href="{{ $bs_css }}" type="text/css" rel="stylesheet" /> 
    @vite(["resources/" . $css_app, "resources/" . $theme])
    <link href="{{ $favicon }}" rel="shortcut icon" type="image/x-icon">
    <script src="{{ $jquery }}"></script>
    <script src="{{ $bs_js }}"></script>
    @vite("resources/" . $js_app)
    <title>{{ $title }}</title>
</head>
