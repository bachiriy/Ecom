@extends('layouts.app')

@section('content')
    <style>@import url(https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css);</style>

    @if(session('status'))
        <div class="bg-red-200 p-4 mb-4 rounded-md text-green-800">
            {{ session('status') }}
        </div>
    @endif

    <div class="min-h-screen bg-yellow-300 p-5 lg:p-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="max-w-sm mx-auto bg-white shadow-md rounded-md overflow-hidden">
                    <img src="https://pngimg.com/uploads/raincoat/raincoat_PNG53.png" class="w-full h-32 object-cover" alt="{{ $product->name }}">
                    <div class="p-4">
                        <h1 class="font-bold text-lg">{{ $product->name }}</h1>
                        <p class="text-sm">{{ substr($product->description, 0, 100) }} {{ strlen($product->description) > 100 ? '...' : '' }}</p>
                        <div class="flex justify-between items-center mt-4">
                            <div>
                                <span class="text-sm font-bold">${{ $product->price }}</span>
                            </div>
                            <div>
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="text-blue-500 hover:text-blue-700 mr-2">Edit</a>
                                    <form action="{{ route('product.destroy', ['id' => $product->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    {{ $products->links() }}
    </div>

@endsection
