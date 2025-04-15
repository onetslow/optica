<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perpage = $request ->perpage ?? 2;
        $products = Product::paginate($perpage)->withQueryString();
        $user = Auth::user();
        return view('products.index', compact('products','perpage', 'user'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        $user = Auth::user();

        if (!$product) {
            return view('products.show', ['product' => null, 'category' => null]);
        }

        $category = $product->category;

        return view('products.show', compact('product', 'category', 'user'));
    }

    public function create()
    {
        $categories = Category::all(); 
        $user = Auth::user();
        return view('products.create', compact('categories', 'user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Товар успешно добавлен!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $user = Auth::user();

        return view('products.edit', compact('product', 'categories', 'user'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Товар успешно обновлен!');
    }

    public function destroy(string $id)
{
    $product = Product::findOrFail($id);
    $user = Auth::user();

    if (! Gate::allows('destroy-product', $product)) {
        return redirect()->route('products.index')->with('message', 'У вас нет прав на удаление этого товара!');
    }

    $product->delete();

    return redirect()->route('products.index')->with('success', 'Товар успешно удалён!');
}
    public function home()
    {
        $products = Product::latest()->take(6)->get();
        $user = Auth::user();
        return view('home', compact('products', 'user'));
    }
}
