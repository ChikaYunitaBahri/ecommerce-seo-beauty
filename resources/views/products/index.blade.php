@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-3 text-primary">Products</h2>

        @if(Auth::user()->hasRole('admin'))
        <a href="{{ route('products.create') }}" class="btn btn-primary ms-auto">Add Product</a>
        @endif
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                @if(Auth::user()->hasRole('admin'))
                <th>Actions</th> <!-- Kolom Actions hanya untuk Admin -->
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>

                @if(Auth::user()->hasRole('admin'))
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>

    @if(Auth::user()->hasRole('user'))
    <div class="alert alert-info mt-4">
        <strong>Info:</strong> Anda hanya dapat melihat produk. Jika ingin membeli, silakan hubungi admin.
    </div>
    @endif

</div>
@endsection