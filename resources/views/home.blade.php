@extends('layouts.app')

@section('content')
<div class="container">
    
    {{-- Authentication-based Content --}}
    @if(Auth::check())
        @if(Auth::user()->hasRole('admin'))
            {{-- Admin Dashboard --}}
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">Admin Dashboard</h4>
                <p>As an admin, you can manage products.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Manage Products</a>
            </div>
        @elseif(Auth::user()->hasRole('user'))
        {{-- Hero Section --}}
    <div class="row align-items-center py-5">
        <div class="col-lg-6">
            <div class="hero-content">
                <h1 class="display-4 mb-4 text-primary">Seo Beauty</h1>
                <p class="lead text-muted mb-4">
                    Discover the perfect blend of science and beauty. 
                    Our carefully curated skincare products are designed 
                    to enhance your natural glow and boost your confidence.
                </p>
                
                <div class="d-flex gap-3">
                    <a href="{{ route('Toko') }}" class="btn btn-primary btn-lg shadow-sm">
                        Shop Now
                        <i class="bi bi-cart-plus ms-2"></i>
                    </a>
                    <a href="{{ route('Toko') }}" class="btn btn-outline-primary btn-lg shadow-sm">
                        Learn More
                        <i class="bi bi-info-circle ms-2"></i>
                    </a>
                </div>
                
                <div class="mt-4 d-flex align-items-center">
                    <div class="me-4">
                        <small class="text-muted d-block">Trusted By</small>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-primary me-2">5k+</span>
                            <span class="text-muted">Happy Customers</span>
                        </div>
                    </div>
                    <div>
                        <small class="text-muted d-block">Ratings</small>
                        <div class="text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <span class="text-muted ms-2">(4.5/5)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="hero-image">
                <img 
                    src="{{ asset('images/beauty-hero.jpg') }}" 
                    alt="Seo Beauty Products" 
                    class="img-fluid rounded-4 shadow-lg"
                >
            </div>
        </div>
    </div>
    
    {{-- Features Section --}}
    <div class="row mb-5">
        <div class="col-12">
            <div class="features-section bg-light p-4 rounded-3 shadow-sm">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <i class="bi bi-shield-check text-primary fs-2 mb-3 d-block"></i>
                        <h5>100% Original</h5>
                        <p class="text-muted small">Guaranteed authentic products</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="bi bi-truck text-primary fs-2 mb-3 d-block"></i>
                        <h5>Free Shipping</h5>
                        <p class="text-muted small">On orders over Rp500.000</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="bi bi-headset text-primary fs-2 mb-3 d-block"></i>
                        <h5>Customer Support</h5>
                        <p class="text-muted small">24/7 friendly assistance</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Product List --}}
            <div class="row">
                <h3 class="mb-4 text-primary">Our Products</h3>
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

        
            {{-- Cart Management --}}
            <div class="mt-5">
                <h3 class="mb-3 text-primary">Manage Cart</h3>
                <div class="table">
                <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>Rp{{ number_format($item->product->price, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control d-inline w-50">
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </form>
                        </td>
                        <td>Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>


        @endif
    @else
        {{-- Guest Welcome --}}
        <div class="alert alert-warning shadow-sm" role="alert">
            <h4 class="alert-heading">Welcome!</h4>
            <p>Please log in to access your account and explore our products.</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
        </div>
    @endif
</div>

<style>
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