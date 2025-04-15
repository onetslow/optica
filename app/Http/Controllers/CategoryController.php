<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Метод для вывода всех категорий
    public function index()
    {
        $categories = Category::all();
        $user = Auth::user();

        return view('categories.index', compact('categories','user'));
    }

    // Метод для вывода одной категории и связанных с ней продуктов
    public function show($id)
    {
        $user = Auth::user();
        $category = Category::find($id);

        if (!$category) {
            return view('categories.show', [
                'category' => null,
                'products' => [],
                'user' => $user 
            ]);
        }

        // Если найдена — получить связанные продукты
        $products = $category->products;

        // Вернуть представление с категорией и её продуктами
        return view('categories.show', compact('category', 'products', 'user'));
    }
}
