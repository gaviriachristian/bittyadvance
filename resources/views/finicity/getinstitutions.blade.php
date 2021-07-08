<?php
$institutions = json_decode($responseBody, true);
?>
<html>
    <body>
    <h1>Finicity</h1>
    <h3>Institutions</h3>
    <ul>
    @foreach($institutions['institutions'] as $institution)
        <li>{{ $institution['name'] }}</li>
    @endforeach
    </ul>
    </body>
</html>