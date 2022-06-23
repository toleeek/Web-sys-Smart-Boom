@csrf
<div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="Назва"
           required maxlength="100" value="{{ old('name') ?? $category->name ?? '' }}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="slug" placeholder="Слоган"
           required maxlength="100" value="{{ old('slug') ?? $category->slug ?? '' }}">
</div>
<div class="form-group">
    @php
        $parent_id = old('parent_id') ?? $category->parent_id ?? 0;
    @endphp
    <select name="parent_id" class="form-control" title="Батько">
        <option value="0">Без батька</option>
        @if (count($items))
            @include('admin.category.part.branch', ['level' => -1, 'parent' => 0])
        @endif
    </select>
</div>
<div class="form-group">
    <textarea class="form-control" name="content" placeholder="Короткий опис" maxlength="200"
              rows="3">{{ old('content') ?? $category->content ?? '' }}</textarea>
</div>
<div class="form-group">
    <input type="file" class="form-control-file" name="image" accept="image/png, image/jpeg">
</div>
@isset($category->image)
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" name="remove" id="remove">
        <label class="form-check-label" for="remove">
            Видалити завантажене фото?
        </label>
    </div>
@endisset
<div class="form-group">
    <button type="submit" class="btn btn-primary">Зберегти</button>
</div>
