<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
        .full-height {
            height: 100vh;
        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .position-ref {
            position: relative;
        }
        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }
        .content {
            text-align: center;
        }
        .title {
            font-size: 84px;
        }
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <h1>Authorize Payment Integration</h1>
        <form class="" action="{{ url('/recurringbilling') }}" method="post">
            {{ csrf_field() }}
            <h3>Credit Card Information</h3>
            <div class="form-group">
                <label for="cnumber">Card Number</label>
                <input type="text" class="form-control" id="cnumber" name="cnumber" placeholder="Enter Card Number">
            </div>
            <div class="form-group">
                <label for="card-expiry-month">Expiration Month</label>
                {{ Form::selectMonth(null, null, ['name' => 'card_expiry_month', 'class' => 'form-control', 'required']) }}
            </div>
            <div class="form-group">
                <label for="card-expiry-year">Expiration Year</label>
                {{ Form::selectYear(null, date('Y'), date('Y') + 10, null, ['name' => 'card_expiry_year', 'class' => 'form-control', 'required']) }}
            </div>
            <div class="form-group">
                <label for="ccode">Card Code</label>
                <input type="text" class="form-control" id="ccode" name="ccode" placeholder="Enter Card Code">
            </div>
            <div class="form-group">
                <label for="camount">Amount</label>
                <input type="text" class="form-control" id="camount" name="camount" placeholder="Enter Amount" >
            </div>
            <div class="form-group">
                <label for="startdate">Start Date</label>
                <input type="date" class="form-control" id="startdate" name="startdate" placeholder="Enter Start Date" >
            </div>
{{--            <div class="form-group">--}}
{{--                <label for="enddate">End Date</label>--}}
{{--                <input type="date" class="form-control" id="enddate" name="enddate" placeholder="Enter End Date" >--}}
{{--            </div>--}}
            <div class="form-group">
                <label for="intervalLength">Interval Length</label>
                <input type="text" class="form-control" id="intervalLength" name="intervalLength" placeholder="Enter Interval Length" >
            </div>
            <div class="form-group">
                <label for="InvoiceNumber">Invoice Number</label>
                <input type="text" class="form-control" id="InvoiceNumber" name="InvoiceNumber" placeholder="Enter Invoice Number" >
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
