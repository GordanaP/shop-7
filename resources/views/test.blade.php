<x-layouts.app>

    <h1>Test</h1>

    <form action="{{ route('tests.store') }}" method = "POST" id="testForm">

        @csrf

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" id="name" placeholder="Name"
            class="form-control">
        </div>

        <div class="form-group">
            <label>Street</label>
            <input type="text" name="address[street]" id="street" placeholder="Street"
            class="form-control">
        </div>

        <div class="form-group">
            <label>City</label>
            <input type="text" name="address[city]" id="city" placeholder="City"
            class="form-control">
        </div>

        <div class="form-group">
            <label>Country</label>
            <input type="text" name="address[country]" id="country" placeholder="Country"
            class="form-control">
        </div>

        <button type="submit" class="btn" id="testBtn">
            Submit
        </button>

    </form>

    @section('scripts')
        <script>

        var form = document.getElementById('testForm');

        form.addEventListener('submit', function(e){
            e.preventDefault();

            var submitUrl = form.action;
            var submitMethod = form.method;

            var paymentMethod = {
                billing_details : {
                    name : getById('name').value,
                    address : {
                        line1 : getById('street').value,
                        line1 : getById('postalCode').value,
                        city : getById('city').value,
                        country : getById('country').value,
                    }
                }
            }


            $.ajax({
                url: submitUrl,
                type: submitMethod,
                data: {
                    paymentMethod: paymentMethod
                },
            })
            .done(function(response) {
                console.log(response)
            });
        });

        </script>
    @endsection

</x-layouts.app>