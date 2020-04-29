<form action="{{ $route }}" method="POST"
class="form-inline">

    @csrf
    @method('DELETE')

    <button type="submit"
    class="btn btn-link text-xs text-teal-400 p-0 mb-1">
        Remove
    </button>
</form>