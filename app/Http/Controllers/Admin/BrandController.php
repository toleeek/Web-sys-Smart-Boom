<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandCatalogRequest;
use App\Models\Brand;

class BrandController extends Controller {

    private $imageSaver;

    public function __construct(ImageSaver $imageSaver) {
        $this->imageSaver = $imageSaver;
    }

    /**
     * Показує список всіх брендів
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Показує форму для створення бренда
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.brand.create');
    }

    /**
     * Зберігає новий бренд в бд
     *
     * @param BrandCatalogRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandCatalogRequest $request) {
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, null, 'brand');
        $brand = Brand::create($data);
        return redirect()
            ->route('admin.brand.show', ['brand' => $brand->id])
            ->with('success', 'Новий бренд успішно створений');
    }

    /**
     * Показує сторінку бренда
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand) {
        return view('admin.brand.show', compact('brand'));
    }

    /**
     * Показує форму для редагування бренда
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand) {
        return view('admin.brand.edit',compact('brand'));
    }

    /**
     * Обновляє бренд
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandCatalogRequest $request, Brand $brand) {
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, $brand, 'brand');
        $brand->update($data);
        return redirect()
            ->route('admin.brand.show', ['brand' => $brand->id])
            ->with('success', 'Бренд був успішно відредаговано');
    }

    /**
     * Видаляє бренд
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand) {
        if ($brand->products->count()) {
            return back()->withErrors('Неможна видалити бренд, в якого є товари');
        }
        $this->imageSaver->remove($brand, 'brend');
        $brand->delete();
        return redirect()
            ->route('admin.brand.index')
            ->with('success', 'Бренд каталога успішно видалений');
    }
}
