@foreach ($pages->where('parent_id', 0) as $page)
    @if (count($pages->where('parent_id', $page->id)))
        <li class="nav-item dropdown" style="color: white">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
               role="button" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false" style="color: white">
                {{ $page->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="color: white">
                <a class="dropdown-item" href="{{ route('page.show', ['page' => $page->slug]) }}" style="color: white">
                    {{ $page->name }}
                </a>
                <div class="dropdown-divider" style="color: white"></div>
                @foreach ($pages->where('parent_id', $page->id) as $child)
                    <a class="dropdown-item" href="{{ route('page.show', ['page' => $child->slug]) }}" style="color: white">
                        {{ $child->name }}
                    </a>
                @endforeach
            </div>
        </li>
    @else
        <li class="nav-item" style="color: white">
            <a class="nav-link" href="{{ route('page.show', ['page' => $page->slug]) }}">
                {{ $page->name }}
            </a>
        </li>
    @endif
@endforeach
