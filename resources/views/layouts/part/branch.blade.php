@if (count($category->children))
    <span class="badge badge-dark float-right">
        <i class="fa fa-plus"></i>
    </span>
    <ul>
        @php
            $level++
        @endphp
        @foreach($category->children as $child)
        <li>
            {!! str_repeat('&emsp;', $level) !!}
            <a href="{{ route('catalog.category', $child->slug) }}">{{ $child->name }}</a>
            @include('layouts.part.branch', ['category' => $child, $level])
        </li>
        @endforeach
    </ul>
@endif
