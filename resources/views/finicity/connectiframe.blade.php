<html>
    <head>
        <meta name="csrf-token" content="{{$token}}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <h1>Finicity</h1>
        <h3>Connect Iframe</h3>
        <section id="finicity-connect-bank-api">
            <div id="connect-container">
                <iframe style="display: none;" src="{{$url}}" frameborder="0"></iframe>
            </div>
        </section>
    </body>
</html>
<script src="https://connect2.finicity.com/assets/sdk/finicity-connect.min.js"></script>

<script defer>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    ahref = "{{$url}}";
    ahref = ahref.replace(/&amp;/g, '&');
    fetch(ahref, {
        method: 'GET',
        redirect: 'follow',
        mode: "no-cors",
        headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
        },
    })
    .then((response) => response.text())
    .then((html) => {
        const customerId = "{{$customerId}}";
        const finicityConnectUrl = html.finicityConnectUrl;
        window.finicityConnect.launch('https://connect2.finicity.com/institution/search/', {
            selector: '#connect-container',
            overlay: 'rgba(255,255,255, 0)',
            success: (event) => {
                $.ajax({
                    type: 'POST',
                    url: '/customerslogs/savecustomerlogs',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "event": event,
                        "customerId": customerId,
                    },
                    success: function(data) {
                        console.log('Response: ', data);
                    }
                });
                console.log('Success trace logs ', event);
            },
            cancel: (event) => {
                $.ajax({
                    type: 'POST',
                    url: '/customerslogs/savecustomerlogs',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "event": event,
                        "customerId": customerId,
                    },
                    success: function(data) {
                        console.log('Response: ', data);
                    }
                });
                console.log('Cancel trace logs ', event);
                //console.log('The user cancelled the iframe', event);
            },
            error: (error) => {
                $.ajax({
                    type: 'POST',
                    url: '/customerslogs/savecustomerlogs',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "event": error,
                        "customerId": customerId,
                    },
                    success: function(data) {
                        console.log('Response: ', data);
                    }
                });
                console.log('Error trace logs ', error);
                //console.log('Some runtime error was generated during insideConnect ', error);
            },
            loaded: () => {
                $.ajax({
                    type: 'POST',
                    url: '/customerslogs/savecustomerlogs',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "event": 'Loaded',
                        "customerId": customerId,
                    },
                    success: function(data) {
                        console.log('Response: ', data);
                    }
                });
                console.log('Loaded trace logs');
                //console.log('This gets called only once after the iframe has finished loading ');
            },
            route: (event) => {
                $.ajax({
                    type: 'POST',
                    url: '/customerslogs/savecustomerlogs',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "event": event,
                        "customerId": customerId,
                    },
                    success: function(data) {
                        console.log('Response: ', data);
                    }
                });
                console.log('Route trace logs ', event);
            },
            user: (event) => {
                $.ajax({
                    type: 'POST',
                    url: '/customerslogs/savecustomerlogs',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "event": event,
                        "customerId": customerId,
                    },
                    success: function(data) {
                        console.log('Response: ', data);
                    }
                });
                console.log('User trace logs ', event);
                
                /*
                if(event.data.action == "DiscoverAccountsSuccess") {
                    $.ajax({
                        type: 'GET',
                        url: '/finicity/getcustomersaccounts/customer/{{$customerId}}',
                        success: function(data) {
                            console.log('getCustomerAccounts: ', data);
                        }
                    });
                }

                if(event.data.action == "Initialize") {
                    var accountId = "5016727701";
                    $.ajax({
                        type: 'GET',
                        url: '/finicity/getaccountowner/customer/{{$customerId}}/account/'+accountId,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "customerId": {{$customerId}},
                            "accountId": accountId
                        },
                        success: function(data) {
                            console.log('getAccountOwner: ', data);
                        }
                    });
                }
                

                if(event.data.action == "Initialize") {
                    $.ajax({
                        type: 'POST',
                        url: '/accounts/generatecashflowreport',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            console.log('generatecashflowreport: ', data);
                        }
                    });
                }

                if(event.data.action == "Initialize") {
                    $.ajax({
                        type: 'POST',
                        url: '/accounts/getreportbycustomer',
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            console.log('getreportbycustomer: ', data);
                        }
                    });
                }
                

                // var from = new Date("2021-05-01 0:00");
                // var to = new Date("2021-06-27 0:00");
                // var timestampfrom = from.getTime() / 1000;
                // var timestampto = to.getTime() / 1000;
                if(event.data.action == "Initialize") {
                    $.ajax({
                        type: 'GET',
                        url: '/accounts/getcustomertransactionsall',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            console.log('getcustomertransactionsall: ', data);
                        }
                    });
                }
                */
            }                                
        });
    });
</script>
