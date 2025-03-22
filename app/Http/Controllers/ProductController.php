<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
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
}
