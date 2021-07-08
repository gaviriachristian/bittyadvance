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
    <h3>Finicity - Customers Logs</h3>

            @if ($customers->isEmpty())
                <div>No Customers Logs found</div>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer ID</th>
                            <th>Event</th>
                            <th>Type</th>
                            <th>Action</th>
                            <th>partner_id</th>
                            <th>institution_id</th>
                            <th>product</th>
                            <th>screen</th>
                            <th>session_id</th>
                            <th>search_term</th>
                            <th>result_count</th>
                            <th>success</th>
                            <th>accounts</th>
                            <th>error_code</th>
                            <th>alert_type</th>
                            <th>message</th>
                            <th>title</th>
                            <th>created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{!! $customer->id !!}</td>
                                <td>{!! $customer->customer_id !!}</td>
                                <td>{!! substr($customer->event,0,20) !!}... {{ $customer->event!='"Loaded"' ? '}' : '' }}</td>
                                <td>{!! $customer->type !!}</td>
                                <td>{!! $customer->action !!}</td>
                                <td>{!! $customer->partner_id !!}</td>
                                <td>{!! $customer->institution_id !!}</td>
                                <td>{!! $customer->product !!}</td>
                                <td>{!! $customer->screen !!}</td>
                                <td>{!! $customer->session_id !!}</td>
                                <td>{!! $customer->search_term !!}</td>
                                <td>{!! $customer->result_count !!}</td>
                                <td>{!! $customer->success !!}</td>
                                <td>{!! $customer->accounts !!}</td>
                                <td>{!! $customer->error_code !!}</td>
                                <td>{!! $customer->alert_type !!}</td>
                                <td>{!! $customer->message !!}</td>
                                <td>{!! $customer->title !!}</td>
                                <td>{!! $customer->created_at !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif


    </body>
</html>