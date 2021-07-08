<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield("titulo")</title>
        <style>
        /*
            Poner bordes a las tablas. Tomado de:
            https://parzibyte.me/blog/2018/10/16/tabla-html-bordes-css/
        */
        table {
            border-collapse: collapse;
        }
        
        table,
        th,
        td {
            border: 1px solid black;
        }
        
        th,
        td {
            padding: 5px;
        }
        </style>
    </head>
    <body>
    <h3>Finicity - Transactions</h3>

            @if ($transactions->isEmpty())
                <div>No transactions found</div>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>amount</th>
                            <th>accountId</th>
                            <th>customerId</th>
                            <th>status</th>
                            <th>description</th>
                            <th>memo</th>
                            <th>feeAmount</th>
                            <th>symbol</th>
                            <th>unitQuantity</th>
                            <th>unitAction</th>
                            <th>confirmationNumber</th>
                            <th>payeeId</th>
                            <th>extendedPayeeName</th>
                            <th>originalCurrency</th>
                            <th>runningBalanceAmount</th>
                            <th>escrowTaxAmount</th>
                            <th>escrowInsuranceAmount</th>
                            <th>created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{!! $transaction->id !!}</td>
                                <td>{!! $transaction->amount !!}</td>
                                <td>{!! $transaction->accountId !!}</td>
                                <td>{!! $transaction->customerId !!}</td>
                                <td>{!! $transaction->status !!}</td>
                                <td>{!! $transaction->description !!}</td>
                                <td>{!! $transaction->memo !!}</td>
                                <td>{!! $transaction->feeAmount !!}</td>
                                <td>{!! $transaction->symbol !!}</td>
                                <td>{!! $transaction->unitQuantity !!}</td>
                                <td>{!! $transaction->unitAction !!}</td>
                                <td>{!! $transaction->confirmationNumber !!}</td>
                                <td>{!! $transaction->payeeId !!}</td>
                                <td>{!! $transaction->extendedPayeeName !!}</td>
                                <td>{!! $transaction->originalCurrency !!}</td>
                                <td>{!! $transaction->runningBalanceAmount !!}</td>
                                <td>{!! $transaction->escrowTaxAmount !!}</td>
                                <td>{!! $transaction->escrowInsuranceAmount !!}</td>
                                <td>{!! $transaction->created_at !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif


    </body>
</html>