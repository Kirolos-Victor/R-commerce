<!DOCTYPE html>
<html lang="en" @if(LaravelLocalization::getCurrentLocaleName()== 'Arabic') dir="rtl" @endif>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt</title>
    <style>
        * {
            font-size: 12px;
            font-family: 'Times New Roman';
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        td.description,
        th.description {
            width: 75px;
            max-width: 75px;
        }

        td.quantity,
        th.quantity {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 155px;
            max-width: 155px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        @media print {
            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }
    </style>
</head>
<body>
<div class="ticket">
    <img src="{{asset('/assets/images/logo/LogoC.jpg')}}" alt="Logo">
    <p class="centered">RECEIPT
{{--        <br>Address line 1--}}
{{--        <br>Address line 2</p>--}}
    <table>
        <thead>
        <tr>
            <th class="quantity">{{__("Qty")}}</th>
            <th class="description">{{__("Description")}}</th>
            <th class="price">{{__("Price")}}</th>
        </tr>
        </thead>
        <tbody>
       @foreach($order->orderItems as $item)
        <tr>
            <td class="quantity">{{$item->quantity}}
            </td>

            <td class="description">{{$item->product_name}}</td>
            <td class="price">${{$item->unit_price}}</td>
        </tr>
        @foreach($item->orderItemAddons as $addon)
        <tr>
            <td class="quantity">{{$addon->addon_quantity}}
            </td>

            <td class="description">{{$addon->addon_name}}</td>
            <td class="price">${{$addon->addon_unit_price}}</td>
        </tr>
        @endforeach


       @endforeach
       <tr>
           <td>
               {{__("Total Price")}}:
           </td>

           <td ></td>
           <td class="price">{{$totalCartPrice}}</td>
       </tr>
        </tbody>
    </table>
    <p class="centered">{{__("Thanks for your purchase")}}!
        <br>{{url('/')}}</p>
</div>
<button id="btnPrint" class="hidden-print">Print</button>
<script>
    const $btnPrint = document.querySelector("#btnPrint");
    $btnPrint.addEventListener("click", () => {
        window.print();
    });
</script>
</body>
</html>
