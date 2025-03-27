@extends('layouts.app')

@section('content')
<div class="container">
    
    {{-- Authentication-based Content --}}
    @if(Auth::check())
        @if(Auth::user()->hasRole('admin'))
            {{-- Admin Dashboard --}}
            <div class="container mt-0 pt-5">
                <!-- Card Utama Admin -->
                <div class="card card-main mb-4">
                    <div class="card-body p-4 text-center">
                        <h4 class="text-primary fw-bold">Welcome to Admin Dashboard</h4>
                        <p class="text-muted">As an admin, you can manage your products.</p>
                        
                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-lg manage-btn">
                                <i class="fas fa-box"></i> Manage Products
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Bagian Card Data Admin -->
                <div class="row g-3 mb-4">
                    <!-- Card Total Products -->
                    <div class="col-md-4">
                        <div class="card info-card shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Products</h5>
                                <p class="card-text fs-4 mb-0 fw-bold">
                                    {{ $totalProducts ?? '0' }}
                                </p>
                                <small>Total Products</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Total Revenue (statis) -->
                    <div class="col-md-4">
                        <div class="card info-card shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Revenue</h5>
                                <p class="card-text fs-4 mb-0 fw-bold">
                                    Rp 120.000.000
                                </p>
                                <small>Sales Revenue</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Other Info -->
                    <div class="col-md-4">
                        <div class="card info-card shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">Orders</h5>
                                <p class="card-text fs-4 mb-0 fw-bold">
                                    1250
                                </p>
                                <small>Finished Order</small>
                            </div>
                        </div>
                    </div>
                </div>
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
            
            {{-- Features Section (features ditampilkan secara horizontal) --}}
            <div class="row mb-5">
                <!-- Card Feature: 100% Original -->
                <div class="col-md-4">
                    <div class="card feature-card shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-shield-check text-primary fs-2 mb-3"></i>
                            <h5 class="fw-bold">100% Original</h5>
                            <p class="text-muted small">Guaranteed authentic products</p>
                        </div>
                    </div>
                </div>
                <!-- Card Feature: Free Shipping -->
                <div class="col-md-4">
                    <div class="card feature-card shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-truck text-primary fs-2 mb-3"></i>
                            <h5 class="fw-bold">Free Shipping</h5>
                            <p class="text-muted small">On orders over Rp500.000</p>
                        </div>
                    </div>
                </div>
                <!-- Card Feature: Customer Support -->
                <div class="col-md-4">
                    <div class="card feature-card shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-headset text-primary fs-2 mb-3"></i>
                            <h5 class="fw-bold">Customer Support</h5>
                            <p class="text-muted small">24/7 friendly assistance</p>
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
                            <div class="card-body text-left">
                                <h5 class="card-title fw-bold text-dark">{{ $product->name }}</h5>
                                <p class="card-text text-primary fs-5">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
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
                <h3 class="mb-3 text-primary">Your Cart</h3>
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
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
/* Card Utama Admin */
.card-main {
    border: 1px solid #007bff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Tombol "Manage Products" dengan gradasi biru, teks putih dan nonaktifkan drag/select */
.manage-btn {
    background: linear-gradient(135deg, #007bff 30%, #00aaff 100%);
    color: #ffffff;
    border: none;
    -webkit-user-drag: none; /* Nonaktifkan drag pada Safari dan Chrome */
    user-select: none;       /* Nonaktifkan text selection */
}
.manage-btn:hover {
    color: #ffffff; /* Tetap putih saat hover */
}

/* Card Info (Total Products, Total Revenue, Other Info)
   dengan gradasi biru dan teks putih */
.info-card {
    background: linear-gradient(135deg, #007bff 30%, #00aaff 100%);
    border: none;
    color: #ffffff;
    border-radius: 0.5rem;
}
.info-card h5,
.info-card p,
.info-card small {
    color: #ffffff;
}

/* Card Feature (untuk fitur 100% Original, Free Shipping, Customer Support) */
.feature-card {
    background: #ffffff;
    border: 1px solid #e0e0e0;
    border-radius: 0.5rem;
}
.feature-card .card-body {
    padding: 1.5rem;
}
.feature-card i {
    color: #007bff;
}

/* Product Card */
.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background: linear-gradient(135deg, #007bff 30%, #00aaff 100%);
    color: white;
}
.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.15) !important;
}

/* Tombol .btn-primary (opsional) */
.btn-primary {
    background: linear-gradient(135deg, #007bff 30%, #00aaff 100%);
    border: none;
}
</style>
@endsection
