<form action="{{ $billingAddress ? $deleteBilling : $deleteShipping  }}"
    method="POST" class="form-inline"
>

    @csrf

    @method('DELETE')

    <button type="submit">
        <i class="far fa-trash-alt mr-1" aria-hidden="hidden"></i>
    </button>

</form>
