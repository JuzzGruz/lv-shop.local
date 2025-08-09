<form action="{{ route('basket.checkout') }}" method="get" id="profiles">
    <div class="form-group">
        <label for="" class="block font-medium">Выберите профиль</label>
        <select name="profile_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50">
            <option value="0">Данные прошлого заказа</option>
            @foreach($profiles as $profile)
                <option value="{{ $profile->id }}"@if($profile->id == $current) selected @endif>
                    {{ $profile->title }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Выбрать</button>
    </div>
</form>