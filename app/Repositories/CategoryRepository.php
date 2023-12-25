<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryRepository extends Repository
{
    public function model()
    {
        return Category::class;
    }

    public function storeByRequest(Request $request)
    {
        return $this->query()->create([
            'name' => $request->get('name'),
            'is_active' => $request->get('is_active')
        ]);
    }

    public function updateByRequest(Request $request, $categoryId)
    {
        return $this->query()->findOrFail($categoryId)?->update([
            'name' => $request->get('name'),
            'is_active' => $request->get('is_active')
        ]);
    }

    public function deleteByRequest($categoryId)
    {
        return $this->query()->findOrFail($categoryId)?->delete();
    }

}
