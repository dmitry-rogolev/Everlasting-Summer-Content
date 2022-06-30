@if ($paginator->hasPages())
    <nav aria-label="{{ __('element.pagination.aria') }}">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" tabindex="-1" aria-disabled="true" aria-label="{{ __('element.pagination.previous') }}">
                    <span class="page-link bg-{{ $theme }} border-{{ $theme }}" aria-hidden="true">&lsaquo;</span>
                </li>
            @else 
                <li class="page-item">
                    <a class="page-link bg-{{ $theme }} border-{{ $theme }}" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('element.pagination.previous') }}">&lsaquo;</a>
                </li>
            @endif
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link bg-{{ $theme }} border-{{ $theme }}">{{ $element }}</span>
                    </li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link border-{{ $theme }}">{{ $page }}</span>
                            </li>
                        @else 
                            <li class="page-item">
                                <a class="page-link bg-{{ $theme }} border-{{ $theme }}" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link bg-{{ $theme }} border-{{ $theme }}" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('element.pagination.next') }}">&rsaquo;</a>
                </li>
            @else 
                <li class="page-item disabled" tabindex="-1" aria-disabled="true" aria-label="{{ __('element.pagination.next') }}">
                    <span class="page-link bg-{{ $theme }} border-{{ $theme }}" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif