@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <div class="position-relative mb-5">
        <div class="hero-gradient p-5 rounded-4 text-center text-white position-relative overflow-hidden">
            <div class="position-relative z-1">
                <h1 class="display-5 fw-bold mb-3 text-shadow">Welcome to Seo Beauty!</h1>
                <p class="lead mb-4 opacity-75">
                    Discover the finest beauty products at special prices, exclusively here.
                </p>
                <a href="#produk" class="btn btn-light btn-lg px-4 py-2 fw-bold shadow-sm">
                    View Products
                </a>
            </div>
        </div>
    </div>

    <!-- Store Information -->
    <div class="card border-0 shadow-sm mb-5 overflow-hidden">
        <div class="card-body text-center p-4">
            <h2 class="mb-3 text-primary fw-bold">Seo Beauty</h2>
            <p class="text-muted mb-4">Discover a wide range of top-quality beauty products at attractive prices.</p>
            
            <div class="d-flex justify-content-center gap-4 flex-wrap">
                <div class="info-box"><i class="fas fa-star text-warning fa-lg"></i><span>4.8/5.0</span></div>
                <div class="info-box"><i class="fas fa-users text-primary fa-lg"></i><span>12,345 Followers</span></div>
                <div class="info-box"><i class="fas fa-shopping-cart text-success fa-lg"></i><span>8,750 Buyers</span></div>
            </div>
        </div>
    </div>

    <!-- Product Section -->
    <div>
    {{-- Product List --}}
            <div class="row">
                <h3 id="produk" class="text-center mb-4 text-primary fw-bold">Our Products</h3>
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-0 rounded-3">
                            <img src="{{ asset('images/' . $product->image) }}" class="card-img-top rounded-top" alt="{{ $product->name }}">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold text-dark">{{ $product->name }}</h5>
                                <p class="card-text text-success fs-5">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary px-3">View Detail</a>
                                    <form action="{{ route('cart.add') }}" method="POST" class="d-inline d-flex gap-2">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-primary">Add to Cart <i class="bi bi-cart"></i></button>
                                        <input type="number" name="quantity" value="1" min="1" class="form-control text-center" style="width: 60px;">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
</div>

<style>
.hero-gradient {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    position: relative;
    padding: 60px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.hero-gradient::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at top right, rgba(255,255,255,0.2), transparent 50%);
    opacity: 0.4;
}

.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background: linear-gradient(135deg, #007bff 30%, #00aaff 100%);
    color: white;
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 1rem 2rem rgba(0,0,0,0.15) !important;
}


.btn-primary {
    background: linear-gradient(135deg, #007bff 30%, #00aaff 100%);
    border: none;

}
</style>
@endsection