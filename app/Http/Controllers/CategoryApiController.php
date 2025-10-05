<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Exception;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response(Category::limit($request->perpage ?? 5)
            ->offset(($request->perpage ?? 5) * ($request->page ?? 0))
            ->get()
        );
    }

    public function total()
    {
        return response(Category::all()->count());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! Gate::allows('create-category')) {
            return response()->json([
                'code' => 1,
                'message' => 'У вас нет прав на добавление категории',
            ]);
        }
        
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'image' => 'required|file'
        ]);
        
        $file = $request->file('image');
        $fileName = rand(1, 100000) . '_' . $file->getClientOriginalName();

        try {
            $path = Storage::disk('s3')->putFileAs('category_pictures', $file, $fileName);


            if (!$path) {
                return response()->json([
                    'code' => 2,
                    'message' => 'Не удалось загрузить файл в S3',
                ]);
            }

            $fileUrl = "https://" . env('AWS_BUCKET') . ".storage.yandexcloud.net/" . $path;

        } catch (Exception $e) {
            return response()->json([
                'code' => 2,
                'message' => 'Ошибка загрузки файла в хранилище S3',
                'error' => $e->getMessage(), 
            ]);
        }
        
        $category = new Category($validated);
        $category->picture_url = $fileUrl;
        $category->save();

        return response()->json([
            'code' => 0,
            'message' => 'Категория успешно добавлена',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Category::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
