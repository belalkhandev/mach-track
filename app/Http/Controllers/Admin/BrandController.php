<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BrandRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BrandController extends Controller
{
    public function __construct(
        protected BrandRepository $brandRepository
    )
    {
    }

    public function index()
    {
        $brands = $this->brandRepository->getByPaginate();


        return Inertia::render('Brands', [
            'brands' => $brands
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:brands,name'],
        ]);

        $this->brandRepository->storeByRequest($request);

        return to_route('brand.index');
    }

    public function update(Request $request, $brandId)
    {
        $request->validate([
            'name' => ['required', 'unique:brands,name,'.$brandId],
        ]);

        $this->brandRepository->updateByRequest($request, $brandId);

        return to_route('brand.index');
    }

    public function destroy($brandId)
    {
        $this->brandRepository->deleteByRequest($brandId);

        return to_route('brand.index');
    }
}
