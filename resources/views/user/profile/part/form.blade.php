@csrf
<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
<div class="form-group">
    <input type="text" class="form-control" name="title" placeholder="Назва профілю"
           required maxlength="255" value="{{ old('title') ?? $profile->title ?? '' }}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="Імя, Прізвище"
           required maxlength="255" value="{{ old('name') ?? $profile->name ?? '' }}">
</div>
<div class="form-group">
    <input type="email" class="form-control" name="email" placeholder="Адреса пошти"
           required maxlength="255" value="{{ old('email') ?? $profile->email ?? '' }}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="phone" placeholder="Номер телефону"
           required maxlength="255" value="{{ old('phone') ?? $profile->phone ?? '' }}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="address" placeholder="Адреса доставки"
           required maxlength="255" value="{{ old('address') ?? $profile->address ?? '' }}">
</div>
<div class="form-group">
    <textarea class="form-control" name="comment" placeholder="Коментар"
              maxlength="255" rows="2">{{ old('comment') ?? $profile->comment ?? '' }}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success">Зберегти</button>
</div>
