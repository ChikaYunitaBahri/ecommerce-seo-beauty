@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Notifikasi Sukses CRUD --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Jika Admin, tampilkan TABEL CRUD --}}
    @if(Auth::user()->hasRole('admin'))
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-3 text-primary">Manage Product</h2>
            <a href="{{ route('products.create') }}" class="btn btn-primary ms-auto">Add Product</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th> <!-- Kolom Actions hanya untuk Admin -->
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" 
                                  method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    {{-- Jika User, tampilkan CARD PRODUK dengan tombol Add to Cart --}}
    @elseif(Auth::user()->hasRole('user'))
        <h2 class="mb-3 text-primary">Product</h2>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded-3">
                        <!-- Gambar Produk -->
                        <img src="{{ asset('images/' . $product->image) }}" 
                             class="card-img-top rounded-top" alt="{{ $product->name }}">
                        <div class="card-body text-left">
                            <!-- Nama Produk -->
                            <h5 class="card-title fw-bold text-dark">{{ $product->name }}</h5>
                            <!-- Harga -->
                            <p class="card-text text-primary fs-5">
                                Rp{{ number_format($product->price, 0, ',', '.') }}
                            </p>
                            <!-- Tombol View Detail, Add to Cart & Quantity -->
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('products.show', $product->id) }}" 
                                   class="btn btn-outline-primary px-3">
                                    View Detail
                                </a>
                                <form action="{{ route('cart.add') }}" 
                                      method="POST" class="d-inline d-flex gap-2">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-primary">
                                        Add to Cart <i class="bi bi-cart"></i>
                                    </button>
                                    <input type="number" name="quantity" 
                                           value="1" min="1" class="form-control text-center" style="width: 60px;">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
