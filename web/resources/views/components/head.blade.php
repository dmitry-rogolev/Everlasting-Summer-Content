<meta charset="{{ $charset }}" />
<meta name="viewport" content="{{ $viewport }}" />
<meta name="keywords" content="{{ $keywords }}" />
<meta name="description" content="{{ $description }}" />
<meta name="author" lang="ru" content="{{ $author }}" />
<meta name="robots" content="{{ $robots }}" />
<link 
    href="{{ $css_bs }}"
    type="text/css" 
    rel="stylesheet" 
    integrity="{{ $css_bs_integrity }}" 
    crossorigin="anonynous" />
<link 
    href=" {{ $font }}"
    type="text/css" 
    rel="stylesheet" />
<link 
    href="{{ $css_app }}" 
    type="text/css" 
    rel="stylesheet" />
<link 
    href="{{ $theme }}" 
    type="text/css" 
    rel="stylesheet" />
<link 
    href="{{ $favicon }}" 
    rel="shortcut icon" 
    type="image/x-icon">
<script 
    src="{{ $jq }}" 
    integrity="{{ $jq_integrity }}" 
    crossorigin="anonymous" 
    type="text/javascript" 
    defer>
</script>
<script 
    src="{{ $js_bs }}"
    integrity="{{ $js_bs_integrity }}"
    crossorigin="anonymous"
    type="text/javascript" 
    defer>
</script>
<title>{!! $title !!}</title>
