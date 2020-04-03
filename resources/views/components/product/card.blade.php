<div>
    <div class="card mb-4 box-shadow">
        <img class="card-img-top" src="{{ $product->image }}" alt="Card image cap">
        <div class="card-body">
            <p class="card-text">{{ $product->description }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <button type="submit" class="btn btn-sm btn-outline-secondary">View</button>
                    <button type="aubmit" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
                <small class="text-muted">9 mins</small>
            </div>
        </div>
    </div>
</div>