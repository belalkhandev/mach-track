<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryRepository $categoryRepository
    )
    {
    }

    public function index()
    {
        $categories = $this->categoryRepository->getByPaginate();

        return Inertia::render('Categories', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:categories,name'],
        ]);

        $this->categoryRepository->storeByRequest($request);

        return to_route('category.index');
    }

    public function update(Request $request, $categoryId)
    {
        $request->validate([
            'name' => ['required', 'unique:categories,name,'.$categoryId],
        ]);

        $this->categoryRepository->updateByRequest($request, $categoryId);

        return to_route('category.index');
    }

    public function destroy($categoryId)
    {
        $this->categoryRepository->deleteByRequest($categoryId);

        return to_route('category.index');
    }
}
