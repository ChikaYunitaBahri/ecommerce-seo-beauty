@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow-sm" alt="{{ $product->name }}">
        </div>
        <div class="col-md-6">
            <h2 class="fw-bold">{{ $product->name }}</h2>
            <p class="text-muted">{{ $product->description }}</p>
            <h4 class="text-primary">Price: Rp{{ number_format($product->price, 0, ',', '.') }}</h4>

            <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                @csrf
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control w-50">
                </div>
                <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-cart"></i> Add to Cart</button>
            </form>
        </div>
    </div>
</div>
@endsection