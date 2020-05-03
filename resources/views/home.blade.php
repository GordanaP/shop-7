<x-layouts.app>
    @section('links')
        <style>
            body { background: #eee; }
            span { font-size:15px; }
        </style>
    @endsection

    <div class="container mt-8">
        <div class="row">
            <x-home.card
                title="My Profile"
                icon="fa-user-alt"
            >
                Lorem ipsum dolor sit amet, id quo eruditi eloquentiam.
                Assum decore te sed. Elitr scripta ocurreret qui ad.
            </x-home.card>

            <x-home.card
                title="My Orders"
                icon="fa-cubes"
                :route="route('users.orders.index', Auth::user())"
            >
                Lorem ipsum dolor sit amet, id quo eruditi eloquentiam.
                Assum decore te sed. Elitr scripta ocurreret qui ad.
            </x-home.card>

            <x-home.card
                title="Address Book"
                icon="fa-map-marked"
            >
                Lorem ipsum dolor sit amet, id quo eruditi eloquentiam.
                Assum decore te sed. Elitr scripta ocurreret qui ad.
            </x-home.card>
        </div>
    </div>
</x-layouts.app>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Order Pdf</title>

        <style>
            table th, table td { padding: 12px 8px; }
            table td {
                text-align: left;
                vertical-align: top;
            }
            table tbody tr.price td { padding: 4px 8px;}
            .w-full { width: 100%; }
            .font-sans { font-family: sans-serif; }
            .text-semibold { font-weight: 600; }
            .text-gray-800 { color: #2d3748; }
            .uppercase { text-transform: uppercase; }
            .tracking-wide { letter-spacing: 1px; }
            .font-12 { font-size: 12px; }
            .font-14 { font-size: 14px; }
            .font-15 { font-size: 15px; }
            .m-0 { margin: 0px; }
            .mx-0 { margin-left: : 0px; margin-right: 0px}
            .mt-0 { margin-top: 0px; }
            .mb-0 { margin-bottom: 0px; }
            .mt-1 { margin-top: 4px; }
            .mb-1 { margin-bottom: 4px; }
            .mt-3 { margin-top: 12px; }
            .mb-3 { margin-top: 12px; }
            .mb-12 { margin-bottom: 36px; }
            .my-3 { margin-top: 12px; margin-bottom: 12px; }
            .py-1 { padding-top: 4px; padding-bottom: 4px; }
            .py-3 { padding-top: 12px; padding-bottom: 12px; }
            .px-2 { padding-left: 8px; padding-right: 8px; }
            .border-b-gray { border-bottom: 1px solid #eee; }
            .border-t-gray { border-top: 1px solid #eee; }
            .border-y-gray { border-bottom: 1px solid #eee; border-top: 1px solid #eee; }
            .align-top { vertical-align: top; }
            .text-center { text-align: center; }
            .text-right { text-align: right; }
            .text-left { text-align: left; }
            .float-right { float: right; }
            .float-left { float: left; }
            .clearfix:before, .clearfix:after {
                content: " ";
                display: block;
            }
            .clearfix:after { clear: both; }
        </style>
    </head>

    <body class="font-sans text-gray-800">
        <div class="container clearfix">
            <div class="float-left">
                <h4 class="mb-1">
                    My Shop
                </h4>
                <div>Street One 22</div>
                <div>11000 Belgrade</div>
                <div>Serbia, RS</div>
                <div>Phone: +381 11 134567</div>
                <div>E-mail: office@my-shop.com</div>
                <p>Date: 2020-06-04</p>
            </div>
            <div class="float-right">
                <h4 class="mb-1">Billing Details</h4>
                <div>Jane Doe</div>
                <div>Street One 32</div>
                <div>11000 Belgrade</div>
                <div>Serbia, RS</div>
                <div>Phone: +381 11 765432</div>
                <div>E-mail: jane@example.com</div>
            </div>

        </div>

        <h2 class="text-center mt-3 mx-0 mb-12">Invoice #24687</h2>

        <table class="w-full my-3 border-b-gray">
            <thead>
                <th width="15%" class="border-y-gray text-left">Product</th>
                <th width="35%" class="border-y-gray text-left"></th>
                <th width="15%" class="border-y-gray text-left">Price</th>
                <th width="10%" class="border-y-gray text-center">Qty</th>
                <th width="15%" class="border-y-gray text-right">Subtotal</th>
            </thead>

            <tbody>
                <tr>
                    <td>
                        <img src="{{ public_path('/images/demo_product.jpg') }}"
                        width="90%">
                    </td>
                    <td>
                        <p class="mt-0 font-12 uppercase text-semibold tracking-wide">Product One</p>
                        <p class="font-14">
                            Subtitle about this product. This is a good product.
                        </p>
                    </td>
                    <td>$20.00</td>
                    <td class="text-center">1</td>
                    <td class="text-right">$20.00</td>
                </tr>

                <tr class="price">
                    <td colspan="4" class="text-right border-t-gray">
                        <p class="mb-0 text-semibold">Subtotal</p>
                    </td>
                    <td class="text-right border-t-gray">
                        <p class="mb-0 text-semibold">$20.00</p>
                    </td>
                </tr>

                <tr class="price">
                    <td colspan="4" class="text-right">
                        <p class="mt-0 mb-1">Discount</p>
                        <p class="m-0 font-12">ABC123 - 10% off</p>
                    </td>
                    <td class="text-right">
                        <p class="mt-0" ">-$1.00</p>
                    </td>
                </tr>

                <tr class="price">
                    <td colspan="4" class="text-right">
                        Tax ({{ config('cart.tax_rate') }}%)
                    </td>
                    <td class="text-right">
                        $4.00
                    </td>
                </tr>

                <tr class="price">
                    <td colspan="4" class="text-right">
                        Shipping & Handling:
                    </td>
                    <td class="text-right">
                        $2.00
                    </td>
                </tr>

                <tr class="price">
                    <td colspan="4" class="text-right font-15 text-semibold uppercase">
                        <p class="mt-1">Grand Total:</p>
                    </td>
                    <td class="text-right font-15 text-semibold uppercase">
                        <p class="mt-1">$26.00</p>
                    </td>
                </tr>
            </tbody>
        </table>

        <h4 class="mb-1">Ship to:</h4>
        <div>John Doe</div>
        <div>Street 2</div>
        <div>11000 Belgrade</div>
        <div>Serbia, RS</div>

        <h3 class="text-center">Thank you for shopping with us!</h3>
    </body>
</html>