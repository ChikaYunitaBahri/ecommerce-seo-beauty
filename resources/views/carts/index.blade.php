@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3 text-primary">Your Shopping Cart</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table align-middle">
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
            @php
                $grandTotal = 0;
            @endphp

            @foreach ($cartItems as $item)
                @php
                    $itemTotal = $item->product->price * $item->quantity;
                    $grandTotal += $itemTotal;
                @endphp
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>Rp{{ number_format($item->product->price, 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center">
                            @csrf
                            @method('PATCH')
                            <input 
                                type="number" 
                                name="quantity" 
                                value="{{ $item->quantity }}" 
                                min="1" 
                                class="form-control d-inline w-50 me-2"
                            >
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </form>
                    </td>
                    <td>Rp{{ number_format($itemTotal, 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                class="btn btn-sm btn-danger" 
                                onclick="return confirm('Are you sure?')"
                            >
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach

            <!-- Baris Total Transaksi -->
            <tr>
                <td colspan="3" class="text-end fw-bold">Grand Total:</td>
                <td colspan="2" class="text-primary fs-5">
                    Rp{{ number_format($grandTotal, 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Tombol Checkout -->
    <div class="d-flex justify-content-end">
        <form action="">
            @csrf
            <input type="hidden" name="total" value="{{ $grandTotal }}">
            <button type="submit" class="btn btn-success btn-lg">
                Checkout
            </button>
        </form>
    </div>
</div>
@endsection
