@csrf
    <div class="col-md-6">
        <div class="mb-3"> 
            <label for="" class="block font-medium text-sm text-gray-700">Название категории</label>
            <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" 
                    name="name" required maxlength="100" value="{{ old('name') ?? $category->name ?? '' }}">
        </div>
        <div class="mb-3">
            @php
                $parent_id = old('parent_id') ?? $category->parent_id ?? 0;
            @endphp
            <label for="" class="block font-medium text-sm text-gray-700">Родитель</label>
            <select name="parent_id" class="custom-select mr-sm-2 w-50"  title="Родитель">
                <option value="0">Без родителя</option>
                @if (count($parents))
                    @include('admin.category.part.branch', ['items' => $parents, 'level' => -1])
                @endif
            </select>
        </div>
        <div class="mb-3"> 
            <label for="" class="block font-medium text-sm text-gray-700">URL</label>
            <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" 
                    name="slug" maxlength="100" value="{{ old('name') ?? $category->slug ?? '' }}">
        </div>
        <div class="mb-3"> 
            <label for="" class="block font-medium text-sm text-gray-700">Описание категории</label>
            <textarea name="content" cols="30" rows="10" placeholder="Необязательно, максимум 200 символов" 
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" style="resize: none">
                    {{ old('content') ?? $category->content ?? '' }}
            </textarea>
        </div>
        @if (isset($category))
            <input type="submit" class="btn btn-primary" value="Обновить">
        @else
            <input type="submit" class="btn btn-primary" value="Создать">
        @endif
    </div>
    <div class="mb-3 col-md-6"> 
        <label for="" class="block font-medium text-sm text-gray-700">Изображение категории</label>
        @isset($category)
            <img src="{{ asset('storage/' . $category->image) }}" alt="Изображение отсутсвует">
        @endisset
        <input type="file" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-25" name="image">
    </div>
