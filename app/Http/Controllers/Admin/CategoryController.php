<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCatalogRequest;
use App\Models\Category;

class CategoryController extends Controller {

    private $imageSaver;

    public function __construct(ImageSaver $imageSaver) {
        $this->imageSaver = $imageSaver;
    }

    /**
     * Показує список всіх категорії
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index() {
        $items = Category::all();
        return view('admin.category.index', compact('items'));
    }

    /**
     * Показує форму для створення категорії
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $items = Category::all();
        return view('admin.category.create', compact('items'));
    }

    /**
     * Зберігає нову категорію в базу даних
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCatalogRequest $request) {
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, null, 'category');
        $category = Category::create($data);
        return redirect()
            ->route('admin.category.show', ['category' => $category->id])
            ->with('success', 'Нова категорія успішно створена');
    }

    /**
     * Показує сторінку категорії
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category) {
        return view('admin.category.show', compact('category'));
    }

    /**
     * Показує форму для редагування категорії
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category) {
        // все категории для возможности выбора родителя
        $items = Category::all();
        return view('admin.category.edit',compact('category', 'items'));
    }

    /**
     * Оновлює категорію каталога
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryCatalogRequest $request, Category $category) {
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, $category, 'category');
        $category->update($data);
        return redirect()
            ->route('admin.category.show', ['category' => $category->id])
            ->with('success', 'Категорія була успішно виправлена');
    }

    /**
     * Видаляє категорію каталога
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category) {
        if ($category->children->count()) {
            $errors[] = 'Неможна видалити категорію із дочірніми категоріями';
        }
        if ($category->products->count()) {
            $errors[] = 'Неможна видалити категорію, яка містить товари';
        }
        if (!empty($errors)) {
            return back()->withErrors($errors);
        }
        $this->imageSaver->remove($category, 'category');
        $category->delete();
        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Категорія каталога успішно видалена');
    }
}
