@csrf
<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
<div class="form-group">
    <label for="" class="block font-medium text-sm text-gray-700">Название профиля</label>
    <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="title"
           required maxlength="255" value="{{ old('title') ?? $profile->title ?? '' }}">
</div>
<div class="form-group">
    <label for="" class="block font-medium text-sm text-gray-700">Имя, Фамилия</label>
    <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="name"
           required maxlength="255" value="{{ old('name') ?? $profile->name ?? '' }}">
</div>
<div class="form-group">
    <label for="" class="block font-medium text-sm text-gray-700">Адрес почты</label>
    <input type="email" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="email"
           required maxlength="255" value="{{ old('email') ?? $profile->email ?? '' }}">
</div>
<div class="form-group">
    <label for="" class="block font-medium text-sm text-gray-700">Номер телефона</label>
    <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="phone"
           required maxlength="255" value="{{ old('phone') ?? $profile->phone ?? '' }}">
</div>
<div class="form-group">
    <label for="" class="block font-medium text-sm text-gray-700">Адрес доставки</label>
    <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" name="address"
           required maxlength="255" value="{{ old('address') ?? $profile->address ?? '' }}">
</div>
<div class="form-group">
    <label for="" class="block font-medium text-sm text-gray-700">Комментарий</label>
    <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-50" style="resize: none" name="comment"
              maxlength="255" rows="5">{{ old('comment') ?? $profile->comment ?? '' }}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success">Сохранить</button>
</div>