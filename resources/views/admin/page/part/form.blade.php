@csrf
<div class="form-group">
    <label for="" class="block font-medium text-sm text-gray-700">Наименование страницы</label>
    <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-75" name="name" placeholder="Наименование"
           required maxlength="100" value="{{ old('name') ?? $page->name ?? '' }}">
</div>
<div class="form-group">
    <label for="" class="block font-medium text-sm text-gray-700">URL</label>
    <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-75" name="slug" placeholder="Оставьте поле пустым для автогенерации"
           maxlength="100" value="{{ old('slug') ?? $page->slug ?? '' }}">
</div>
<div class="form-group">
    <label for="" class="block font-medium text-sm text-gray-700">Родительская страница</label>
    @php
        $parent_id = old('parent_id') ?? $page->parent_id ?? 0;
    @endphp
    <select name="parent_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-75" title="Родитель">
        <option value="0">Без родителя</option>
        @foreach($parents as $parent)
            <option value="{{ $parent->id }}" @if ($parent->id == $parent_id) selected @endif>
                {{ $parent->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="" class="block font-medium text-sm text-gray-700">Контент страницы</label>
    <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-75" name="content" placeholder="Контент (html)"
              id="editor" rows="10">{{ old('content') ?? $page->content ?? '' }}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Сохранить</button>
</div>
