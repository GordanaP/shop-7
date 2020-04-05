@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- <form action="{{ route('shopping.cart.store', $product) }}" method="POST">

    @csrf

    @if (Request::route('product'))
        <div class="form-group">
            <input type="text" name="quantity" id="quantity"
            class="form-control text-center mt-4" value="1">

            <x-error field="quantity" />
        </div>
    @endif

    <button type="submit" class="btn btn-success w-full rounded-full
    {{ $btnSize == 'small' ? 'btn-sm' : '' }}">
        <i class="fas fa-shopping-cart fa-sm"></i> Add to cart
    </button>
</form> --}}