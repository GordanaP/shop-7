<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Order @yield('order-number')</title>

        <style>
            .logo-title {position: absolute; left: 50px; top:-15px;}
            table th, table td { padding: 12px 8px; }
            table td {
                text-align: left;
                vertical-align: top;
            }
            table tbody tr.price td { padding: 4px 8px;}
            .relative {position: relative}
            .w-full { width: 100%; }
            .w-80 { width: 80%; }
            .font-sans { font-family: sans-serif; }
            .text-semibold { font-weight: 600; }
            .text-gray-800 { color: #2d3748; }
            .uppercase { text-transform: uppercase; }
            .line-through { text-decoration: line-through }
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
            .mr-2 { margin-right: 8px; }
            .my-3 { margin-top: 12px; margin-bottom: 12px; }
            .py-1 { padding-top: 4px; padding-bottom: 4px; }
            .py-3 { padding-top: 12px; padding-bottom: 12px; }
            .py-4 { padding-top: 16px; padding-bottom: 16px; }
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
                <x-partials.logo-header />
                <p>
                    <span class="text-semibold">Order Date:</span>
                    @yield('payment-date')
                </p>
            </div>
            <div class="float-right">
                <h4 class="mb-1">Billing Details</h4>
                @yield('billing-details')
            </div>
        </div>

        <h2 class="text-center mt-3 mx-0 mb-12">
            Invoice @yield('order-number')
        </h2>

        <table class="w-full my-3 border-b-gray">
            <thead>
                <th width="15%" class="border-y-gray text-left">Product</th>
                <th width="40%" class="border-y-gray text-left"></th>
                <th width="25%" class="border-y-gray text-left">Price</th>
                <th width="5%"  class="border-y-gray text-center">Qty</th>
                <th width="15%" class="border-y-gray text-right">Subtotal</th>
            </thead>

            <tbody>
                @yield('order-details')
            </tbody>
        </table>

        <h4 class="mb-1">Ship to:</h4>
        @yield('shipping-details')

        <h3 class="text-center">Thank you for shopping with us!</h3>
    </body>
</html>