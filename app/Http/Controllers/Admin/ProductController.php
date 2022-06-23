<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageSaver;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCatalogRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller {

    private $imageSaver;

    public function __construct(ImageSaver $imageSaver) {
        $this->imageSaver = $imageSaver;
    }

    /**
     * Показує список усіх товарів
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $roots = Category::where('parent_id', 0)->get();
        $products = Product::paginate(5);
        return view('admin.product.index', compact('products', 'roots'));
    }

    /**
     * Показує товари категорії
     *
     * @return \Illuminate\Http\Response
     */
    public function category(Category $category) {
        $products = $category->products()->paginate(5);
        return view('admin.product.category', compact('category', 'products'));
    }

    /**
     * Показує форму для створення товару
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $items = Category::all();

        $brands = Brand::all();
        return view('admin.product.create', compact('items', 'brands'));
    }

    /**
     * Зберігає товар в бд
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCatalogRequest $request) {
        $request->merge([
            'new' => $request->has('new'),
            'hit' => $request->has('hit'),
            'sale' => $request->has('sale'),
        ]);
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, null, 'product');
        $product = Product::create($data);
        return redirect()
            ->route('admin.product.show', ['product' => $product->id])
            ->with('success', 'Новий товар успішно створений');
    }

    /**
     * Показывает страницу товара
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product) {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Показує форму для редагування товару
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product) {

        $items = Category::all();

        $brands = Brand::all();
        return view('admin.product.edit', compact('product', 'items', 'brands'));
    }

    /**
     * Обновляє товар каталогу в бд
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCatalogRequest $request, Product $product) {
        $request->merge([
            'new' => $request->has('new'),
            'hit' => $request->has('hit'),
            'sale' => $request->has('sale'),
        ]);
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, $product, 'product');
        $product->update($data);
        return redirect()
            ->route('admin.product.show', ['product' => $product->id])
            ->with('success', 'Товар був успішно обновлений');
    }

    /**
     * Видаляє товар каталогу із бд
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product) {
        $this->imageSaver->remove($product, 'product');
        $product->delete();
        return redirect()
            ->route('admin.catalog.index')
            ->with('success', 'Товар каталогу успішно видалений');
    }
}
