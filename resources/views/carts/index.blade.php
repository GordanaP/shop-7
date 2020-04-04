<x-layouts.app>

    <div class="bg-white p-4 border">
        <table class="table border mb-0 ordered-items">

            <thead>
                <th width="15%">Item</th>
                <th width="25%"></th>
                <th class="text-center" width="20%">Price</th>
                <th class="text-center" width="15%">Qty</th>
                <th class="text-right" width="15%">Subtotal</th>
                <th class="text-right"><i class="fa-fa-cog"></i></th>
            </thead>

            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>
                            <img class="img-fluid rounded w-4/5 mt-2"
                            src="http://lorempixel.com/200/120/food/3/"
                            alt="Item image">
                        </td>
                        <td width="35%">
                            <p class="text-uppercase mb-2">
                                <a href="#" class="font-semibold tracking-wide">
                                    {{ $item->title }}
                                </a>
                            </p>
                            <p class="text-xs text-gray-500">{{ $item->subtitle }}</p>
                        </td>

                        <td class="text-center">
                            {{ $item->price }}
                        </td>

                        <td class="text-center" width="10%">
                            <span class="flex justify-between">
                                <form action="{{ route('shopping.cart.update', $item->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <div class="mx-auto flex">
                                        <div class="form-group">
                                            <input type="text" name="quantity" id="quantity"
                                                class="form-control text-center"
                                                value="{{ $item->quantity }}">
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </span>
                        </td>

                        <td class="text-right">
                            {{ Str::price_in_dollars($item->subtotal_in_dollars) }}
                        </td>

                        <td class="text-right">
                            Remove
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</x-layouts.app>