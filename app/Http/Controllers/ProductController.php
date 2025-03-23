<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perpage = $request ->perpage ?? 2;
        $products = Product::paginate($perpage)->withQueryString();
        return view('products.index', compact('products','perpage'));
    }

    public function show($id)
    {
        // Ищем продукт
        $product = Product::find($id);

        // Проверяем, существует ли он
        if (!$product) {
            return view('products.show', ['product' => null, 'category' => null]);
        }

        // Получаем категорию продукта
        $category = $product->category;

        return view('products.show', compact('product', 'category'));
    }

    public function create()
    {
        $categories = Category::all(); // Для выбора категории в форме
        return view('products.create', compact('categories'));
    }

    // Сохранение нового продукта
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Товар успешно добавлен!');
    }

    // Форма редактирования существующего продукта
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    // Обновление продукта после редактирования
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Товар успешно обновлен!');
    }

    // Удаление продукта
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Товар удален!');
    }
}
