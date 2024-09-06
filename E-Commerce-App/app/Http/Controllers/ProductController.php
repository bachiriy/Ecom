<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::orderBy('name')->paginate(6);
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        if (Auth::check()) {
            return view('products.create');
        } else {
            abort(404);
        }
    }

    /**
     * Store a newly created product in the database
     * @param $request,
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price')
        ];
        Product::create($data);

        return redirect()->route('products.create')->with('status', 'Product created successfully!');
    }


    /**
     * Display the specified product.
     * @param $id,
     */
    public function show($id)
    {
        $product = Product::find($id);
        if ($product !== null) {
            return view('products.show', ['product' => $product]);
        } else {
            return 'product does not exist';
        }
    }

    /**
     * Show the form for editing the specified product.
     * @param $id,
     */
    public function edit($id)
    {
        if (Auth::check()) {
            $product = Product::find($id);
            return view('products.edit', ['product' => $product]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified product in the database.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price')
        ];
        $product->update($data);

        return redirect()->route('product.show', ['id' => $product->id])->with('status', 'Product updated successfully!');
    }


    /**
     * Remove the specified product from the database.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect()->route('products.index')->with('status', 'Product deleted successfully!');
    }

}
