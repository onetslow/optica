<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Метод для вывода всех категорий
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Метод для вывода одной категории и связанных с ней продуктов
    public function show($id)
    {
        // Найти категорию по id
        $category = Category::find($id);

        // Если категория не найдена — показать сообщение об ошибке
        if (!$category) {
            return view('categories.show', [
                'category' => null,
                'products' => []
            ]);
        }

        // Если найдена — получить связанные продукты
        $products = $category->products;

        // Вернуть представление с категорией и её продуктами
        return view('categories.show', compact('category', 'products'));
    }
}
