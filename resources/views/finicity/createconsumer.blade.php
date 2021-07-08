<?php 
$consumer = json_decode($responseBody, true);
?>
<html>
    <body>
        <h1>Finicity</h1>
        <h3>Created consumer</h3>
        <p>Id: {{ $consumer['id'] }}</p>
        <p>Created date: {{ $consumer['createdDate'] }}</p>
        <p>Customer Id:  {{ $consumer['customerId'] }}</p>
    </body>
</html>