@php $level++ @endphp
@foreach($parents as $parent)
    <option value="{{ $parent->id }}" @if ($parent->id == $parent_id) selected @endif>
        @if ($level) {!! str_repeat('&nbsp;&nbsp;&nbsp;', $level) !!}  @endif {{ $parent->name }}
    </option>
    @if ($parent->children->count())
        @include('admin.category.part.branch', ['parents' => $parent->children, 'level' => $level])
    @endif
@endforeach