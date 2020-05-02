<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Order Pdf</title>
    </head>

    <style>
        body {
            font-family: sans-serif;
            color: #2d3748;
        }
        table {
            margin-top: 12px;
            width: 100%;
            border-bottom: 1px solid #eee;
            margin-bottom: 12px;
        }
        table thead th {
            padding: 12px 8px;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            text-align: left;
        }
        table tbody td {
            padding: 12px 8px;
            text-align: left;
            vertical-align: top;
        }
        table tbody tr.price {
            border: 1px solid #eee;
        }
        table tbody tr.price td {
            padding: 4px 8px;
        }

        table tbody td.grand-total {
            font-size: 15px;
            font-weight: 600;
            text-transform: uppercase;
        }
        p.title {
            margin-top: 0px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        h2 { margin: 12px 0px 36px 0px;}
        .font-bold { font-weight: 600px; }
        .font-12 { font-size: 12px; }
        .font-14 { font-size: 14px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .border-top { border-top: 1px solid #eee; }
        .mt-0 { margin-top: 0px; }
        .mb-0 { margin-bottom: 0px; }
        .mb-4 { margin-bottom: 4px; }
        .m-0 { margin: 0px; }
        .float-right { float: right; }
        .float-left { float: left; }
        .clearfix:before, .clearfix:after {
            content: " ";
            display: block;
        }
        .clearfix:after { clear: both; }
    </style>

    <body>
        <div class="container clearfix">
            <div class="float-left">
                <h4 class="mb-4">
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
                <h4 class="mb-4">Billing Details</h4>
                <div>Jane Doe</div>
                <div>Street One 32</div>
                <div>11000 Belgrade</div>
                <div>Serbia, RS</div>
                <div>Phone: +381 11 765432</div>
                <div>E-mail: jane@example.com</div>
            </div>

        </div>

        <h2 class="text-center">Order #24687</h2>

        <table>
            <thead>
                <th width="5%">#</th>
                <th width="15%">Product</th>
                <th width="35%"></th>
                <th width="15%">Price</th>
                <th width="10%" class="text-center">Qty</th>
                <th width="15%" class="text-right">Subtotal</th>
                <th></th>
            </thead>

            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <img src="{{ public_path('/images/demo_product.jpg') }}"
                        width="90%">
                    </td>
                    <td>
                        <p class="title">Product One</p>
                        <p class="font-14">
                            Subtitle about this product. This is a good product.
                        </p>
                    </td>
                    <td>$20.00</td>
                    <td class="text-center">1</td>
                    <td class="text-right">$20.00</td>
                    <td></td>
                </tr>

                <tr class="price">
                    <td colspan="3" class="border-top"></td>
                    <td colspan="2" class="text-right border-top">
                        <p class="mb-0 font-bold">Subtotal</p>
                    </td>
                    <td class="text-right border-top">
                        <p class="mb-0 font-bold">$20.00</p>
                    </td>
                    <td class="border-top"></td>
                </tr>

                <tr class="price">
                    <td colspan="3"></td>
                    <td colspan="2" class="text-right">
                        <p class="mt-0 mb-4">Discount</p>
                        <p class="m-0 font-12">ABC123 - 10% off</p>
                    </td>
                    <td class="text-right">
                        <p class="mt-0" ">-$1.00</p>
                    </td>
                    <td></td>
                </tr>

                <tr class="price">
                    <td colspan="3"></td>
                    <td colspan="2" class="text-right">
                        Tax ({{ config('cart.tax_rate') }}%)
                    </td>
                    <td class="text-right">
                        $4.00
                    </td>
                    <td></td>
                </tr>

                <tr class="price">
                    <td colspan="3"></td>
                    <td colspan="2" class="text-right">
                        Shipping & Handling:
                    </td>
                    <td class="text-right">
                        $2.00
                    </td>
                    <td></td>
                </tr>

                <tr class="price">
                    <td colspan="3"></td>
                    <td colspan="2" class="text-right grand-total">
                        <p>Grand Total:</p>
                    </td>
                    <td class="text-right grand-total">
                        <p>$26.00</p>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <h4 class="mb-4">Ship to:</h4>
        <div>John Doe</div>
        <div>Street 2</div>
        <div>11000 Belgrade</div>
        <div>Serbia, RS</div>

        <h3 class="text-center">Thank you for shopping with us!</h3>
    </body>
</html>