<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Confirm Order</title>

        <style>
            .clearfix:before, .clearfix:after {
                content: " ";
                display: block;
            }
            .clearfix:after { clear: both; }
            .float-left { float: left; }
            .float-right { float: right; }
        </style>
    </head>

    <body style="padding: 20px; background-color: #eee; font-family: sans-serif;">
        <div class="clearfix">
            <div class="float-left" style="vertical-align: bottom">
                <img src="{{ $message->embed('images/logo.png') }}" width="40px">
            </div>
            <div class="float-right"
            style="text-transform: uppercase; font-weight: 600; color: #a0aec0;
            font-size: 11px; vertical-align: bottom">
                Shop with joy
            </div>
        </div>

        <div style="background-color: #ffffff; padding: 8px 16px; font-size: 12px;">
            <h1 class="page-title" style="font-weight: 200">
                Your Order #{{ $order->order_number }}
            </h1>

            <hr>

            <p>Dear {{ optional(optional($order->user)->customer)->name ?? 'customer' }},</p>

            <p>Thank you for your order from MyShop. We love sharing a happy way
            of shopping online and hope you will enjoy your experience with us.</p>

            <h4>Order details</h4>

            <p>Please find attached the invoice for your order.</p>

            <h4>What's next?</h4>

            <p>Your order will be delivered to your address in 2-5 business days.
            You will get another email from us once it's shipped. You can check
            the status of your order by <a href="http://localhost:8000/login">
            logging into your account</a></p>

            <h4>Any questions about your order?</h4>

            <p>If you have any questions about your order, please feel free to contact us at
                <a href="#">support@myshop.com</a></p>

            <h3 style="text-align: center; margin-top: 40px">
                Thank you for shopping with us!
            </h3>
        </div>
    </body>
</html>