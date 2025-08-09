@foreach ($items['pages']->where('parent_id', 0) as $page)
    @if (count($page->children))
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
               role="button" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
                <div class="d-flex align-items-center">
                    {{ $page->name }}
                    <div class="pl-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </div>
                </div>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('page.show', $page->slug) }}">
                    {{ $page->name }}
                </a>
                <div class="dropdown-divider"></div>
                @foreach ($items['pages']->where('parent_id', $page->id) as $child)
                    <a class="dropdown-item" href="{{ route('page.show', $child->slug) }}">
                        {{ $child->name }}
                    </a>
                @endforeach
            </div>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('page.show', $page->slug) }}">
                {{ $page->name }}
            </a>
        </li>
    @endif
@endforeach