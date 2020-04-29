<form action="{{ $route }}" method="POST">

    @csrf

    <div class="input-group">
        <input type="text" name="code" class="form-control"
        placeholder="Enter the coupon code"
        aria-label="The coupon code"
        aria-describedby="button-addon2">

        <div class="input-group-append">
            <button  type="submit" class="btn btn-outline-secondary bg-gray-200">
                Apply
            </button>
        </div>
    </div>

</form>