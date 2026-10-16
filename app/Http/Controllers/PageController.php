<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;

class PageController extends Controller
{
    private function products(): Collection
    {
        return collect(config('titian.products'));
    }

    public function home()
    {
        return view('home', [
            'featured' => $this->products()->where('featured', true)->values(),
            'flavors' => config('titian.flavors'),
        ]);
    }

    public function menu()
    {
        return view('menu', [
            'products' => $this->products(),
            'flavors' => config('titian.flavors'),
        ]);
    }

    public function show(string $slug)
    {
        $product = $this->products()->firstWhere('slug', $slug);

        abort_if($product === null, 404);

        return view('detail', ['product' => $product]);
    }

    public function custom()
    {
        return view('custom', ['products' => $this->products()]);
    }

    public function cart()
    {
        return view('cart');
    }
}
