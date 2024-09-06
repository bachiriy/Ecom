@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[550px]">
            @if(session('status'))
                <div class="bg-green-200 p-4 mb-4 rounded-md text-green-800">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('product.update', ['id' => $product->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-5">
                    <label
                        for="name"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Product Name
                    </label>
                    <input
                        value="{{ $product->name }}"
                        required
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Product Name "
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>

                <div class="mb-5">
                    <label
                        for="description"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Product Description
                    </label>
                    <textarea

                        required
                        rows="4"
                        name="description"
                        id="description"
                        placeholder="Type description here ..."
                        class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    >
                        {{ $product->description }}
                    </textarea>
                </div>
                <div class="mb-5">
                    <label
                        for="price"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Product Price
                    </label>
                    <input
                        value="{{ $product->price }}"
                        required
                        type="number"
                        name="price"
                        id="price"
                        placeholder="999.99$"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                <div>
                    <button
                        class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none"
                        type="submit"
                    >
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
