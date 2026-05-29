<!DOCTYPE html>
<html>
<head>
    <title>Payment Receipt</title>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>

    <style>
        body{
            font-family: Arial;
            padding:40px;
        }

        .receipt{
            max-width:700px;
            margin:auto;
            border:1px solid #ccc;
            padding:30px;
        }

        .title{
            font-size:28px;
            font-weight:bold;
            margin-bottom:20px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        td{
            padding:10px;
            border-bottom:1px solid #eee;
        }
    </style>
</head>
<body>

<div class="receipt">

    <div class="title">
        Payment Receipt
    </div>

    <table>

        <tr>
            <td><strong>Receipt No.</strong></td>
            <td>RCPT-{{ str_pad($payment->id,5,'0',STR_PAD_LEFT) }}</td>
        </tr>

        <tr>
            <td><strong>Tenant</strong></td>
            <td>{{ $payment->lease?->tenant?->name }}</td>
        </tr>

        <tr>
            <td><strong>Property</strong></td>
            <td>{{ $payment->lease?->property?->name }}</td>
        </tr>

        <tr>
            <td><strong>Lease</strong></td>
            <td>{{ $payment->lease?->lease_number }}</td>
        </tr>

        <tr>
            <td><strong>Amount Paid</strong></td>
            <td>₱{{ number_format($payment->amount,2) }}</td>
        </tr>

        <tr>
            <td><strong>Method</strong></td>
            <td>{{ ucfirst($payment->method) }}</td>
        </tr>

        <tr>
            <td><strong>Payment Date</strong></td>
            <td>{{ optional($payment->payment_date)->format('F d, Y') }}</td>
        </tr>

        <tr>
            <td><strong>Status</strong></td>
            <td>{{ ucfirst($payment->status) }}</td>
        </tr>

    </table>

    <div style="margin-top:40px;">
        Thank you for your payment.
    </div>

</div>

</body>
</html>