<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FinicityController extends Controller
{
    public function index()
    {
    }

    public function show()
    {
    }

    public function getToken()
    {
        $client = new Client();
        $url = env('API_BASE_URL')."/aggregation/v2/partners/authentication";

        $params = [
            "partnerId" => env('FINICITY_PARTNER_ID'),
            "partnerSecret" => env('FINICITY_PARTNER_SECRET')
        ];

        $headers = [
            'Content-Type' => env('APLICATION_JSON'),
            'Accept' => env('APLICATION_JSON'),
            'Finicity-App-Key' => env('FINICITY_APP_KEY')
        ];

        $response = $client->request('POST', $url, [
            'json' => $params,
            'headers' => $headers,
            'verify'  => false,
        ]);

        $responseBody = $response->getBody();
        $finicityAppToken = json_decode($responseBody->getContents());
        
        session(['finicityAppToken' => $finicityAppToken->token]);

        return $finicityAppToken->token;
    }

    public function generateV2ConnectURLLinks($customerId, $consumerId)
    {
        $client = new Client();
        $url = env('API_BASE_URL')."/connect/v2/generate";
        $token = !empty(session('finicityAppToken')) ? session('finicityAppToken') : $this->getToken();

        $params = [
            "partnerId" => env('FINICITY_PARTNER_ID'),
            "customerId" => $customerId,
            "consumerId" => $consumerId,
            "fromDate" => time() - (1*24*60*60),
            "singleUseUrl" => true
        ];

        $headers = [
            'Content-Type' => env('APLICATION_JSON'),
            'Accept' => env('APLICATION_JSON'),
            'Finicity-App-Key' => env('FINICITY_APP_KEY'),
            'Finicity-App-Token' => $token
        ];

        $response = $client->request('POST', $url, [
            'json' => $params,
            'headers' => $headers,
            'verify'  => false
        ]);

        $responseBody = $response->getBody();
        $connectUrl = json_decode($responseBody->getContents());
        
        return $connectUrl->link;
    }

    public function connectIframe($customerId, $consumerId)
    {
        $url = $this->generateV2ConnectURLLinks($customerId, $consumerId);
        $token = !empty(session('finicityAppToken')) ? session('finicityAppToken') : $this->getToken();

        return view('finicity.connectiframe', compact('url', 'token', 'customerId'));
    }

    public function getCustomersAccounts($customerId, $status='active')
    {
        $client = new Client();
        $url = env('API_BASE_URL')."/aggregation/v1/customers/{$customerId}/accounts?status={$status}";
        $token = !empty(session('finicityAppToken')) ? session('finicityAppToken') : $this->getToken();

        $headers = [
            'Content-Type' => env('APLICATION_JSON'),
            'Accept' => env('APLICATION_JSON'),
            'Finicity-App-Key' => env('FINICITY_APP_KEY'),
            'Finicity-App-Token' => $token,
        ];

        $response = $client->request('GET', $url, [
            'headers' => $headers,
            'verify'  => false,
        ]);

        $responseBody = json_decode($response->getBody(), true);
        
        $accounts = $responseBody["accounts"];
        $account = new AccountsController();
        if($account->saveAccounts($customerId, $accounts)) {
            return $responseBody;
        } else {
            return "Could not save accounts";
        }
    }

    public function getAccountOwner($customerId, $accountId)
    {
        $client = new Client();
        $url = env('API_BASE_URL')."/aggregation/v1/customers/{$customerId}/accounts/{$accountId}/owner";
        $token = !empty(session('finicityAppToken')) ? session('finicityAppToken') : $this->getToken();

        $headers = [
            'Content-Type' => env('APLICATION_JSON'),
            'Accept' => env('APLICATION_JSON'),
            'Finicity-App-Key' => env('FINICITY_APP_KEY'),
            'Finicity-App-Token' => $token,
        ];

        $response = $client->request('GET', $url, [
            'headers' => $headers,
            'verify'  => false,
        ]);

        $contents = $response->getBody()->getContents();
        $owner = json_decode($contents, true);
        $owner['customerId'] = $customerId;
        $owner['accountId'] = $accountId;

        $account = new AccountsController();
        if($account->saveAccountOwner($owner)) {
            return $owner;
        } else {
            return "Could not save account owner";
        }
    }

    public function getCustomers($start=0, $limit=100, $type='testing')
    {
        $client = new Client();
        $url = env('API_BASE_URL')."/aggregation/v1/customers?search=&username=&start={$start}&limit={$limit}&type={$type}";
        $token = !empty(session('finicityAppToken')) ? session('finicityAppToken') : $this->getToken();
        
        $headers = [
            'Content-Type' => env('APLICATION_JSON'),
            'Accept' => env('APLICATION_JSON'),
            'Finicity-App-Key' => env('FINICITY_APP_KEY'),
            'Finicity-App-Token' => $token,
        ];

        $response = $client->request('GET', $url, [
            'headers' => $headers,
            'verify'  => false,
        ]);

        $responseBody = json_decode($response->getBody(), true);
        $customers = $responseBody["customers"];
        $customer = new CustomersController();
        if($customer->saveCustomers($customers)) {
            return $responseBody;
        } else {
            return "Could not save customers";
        }
    }

    public function getCustomerTransactionsAll($customerId)
    {
        try {
            $client = new Client();
            // 2016-07-12 / 2021-07-12
            //$url = "https://api.finicity.com/aggregation/v3/customers/{$customerId}/transactions?fromDate=1468353073&toDate=1626119473&start=1&limit=1000&sort=desc&includePending=true";
            // 2019-10-12 / 2021-04-14
            $url = "https://api.finicity.com/aggregation/v3/customers/{$customerId}/transactions?fromDate=1570896373&toDate=1618391120&limit=1000&sort=asc";
            $token = !empty(session('finicityAppToken')) ? session('finicityAppToken') : $this->getToken();

            $headers = [
                'Content-Type' => env('APLICATION_JSON'),
                'Accept' => env('APLICATION_JSON'),
                'Finicity-App-Key' => env('FINICITY_APP_KEY'),
                'Finicity-App-Token' => $token,
            ];

            $response = $client->request('GET', $url, [
                'headers' => $headers,
                'verify'  => false
            ]);

            $responseBody = json_decode($response->getBody(), true);
            $transactions = $responseBody["transactions"];
            $transaction = new TransactionsController();
            if($transaction->saveTransactions($transactions)) {
                return $transactions;
            } else {
                return "Could not save transactions";
            }
  
        } catch (Exception $e) {
            echo 'Catch exception: ',  $e->getMessage();
        }
    }

    public function getCustomerAccountTransactions($customerId, $accountId)
    {
        try {
            $client = new Client();
            $url = "https://api.finicity.com/aggregation/v3/customers/{$customerId}/accounts/{$accountId}/transactions?fromDate=1619841600&toDate=1626062400&start=1&limit=1000&sort=desc&includePending=false";
            $token = !empty(session('finicityAppToken')) ? session('finicityAppToken') : $this->getToken();

            $headers = [
                'Content-Type' => env('APLICATION_JSON'),
                'Accept' => env('APLICATION_JSON'),
                'Finicity-App-Key' => env('FINICITY_APP_KEY'),
                'Finicity-App-Token' => $token,
            ];

            $response = $client->request('GET', $url, [
                'headers' => $headers,
                'verify'  => false
            ]);

            $responseBody = json_decode($response->getBody(), true);
            $transactions = $responseBody["transactions"];
            $transaction = new TransactionsController();
            if($transaction->saveTransactions($transactions)) {
                return $transactions;
            } else {
                return "Could not save transactions";
            }
        } catch (Exception $e) {
            echo 'Catch exception: ',  $e->getMessage();
        }
    }    

    public function getCustomerAccountTransactionsReport($customerId, $accountId, $from, $to)
    {
        try {
            $client = new Client();
            $url = "https://api.finicity.com/aggregation/v3/customers/{$customerId}/accounts/{$accountId}/transactions?fromDate={$from}&toDate={$to}&start=1&limit=1000&sort=desc&includePending=false";
            $token = !empty(session('finicityAppToken')) ? session('finicityAppToken') : $this->getToken();

            $headers = [
                'Content-Type' => env('APLICATION_JSON'),
                'Accept' => env('APLICATION_JSON'),
                'Finicity-App-Key' => env('FINICITY_APP_KEY'),
                'Finicity-App-Token' => $token,
            ];

            $response = $client->request('GET', $url, [
                'headers' => $headers,
                'verify'  => false
            ]);

            $responseBody = json_decode($response->getBody(), true);
            $transactions = $responseBody["transactions"];
            $report = [];
            foreach ($transactions as $transaction) {
                //if($transaction['status']=='active') {
                    //if($transaction['categorization']['category']=="Income") {
                        $year = date("Y", $transaction['postedDate']);
                        $month = date("m", $transaction['postedDate']);
                        if(!isset($report[$year])) {
                            $report[$year] = [];
                        }
                        if(!isset($report[$year][$month])) {
                            $report[$year][$month] = [];
                        }
                        if(isset($report[$year][$month]['minDailyBalance'])) {
                            if($transaction['amount'] < $report[$year][$month]['minDailyBalance']) {
                                $report[$year][$month]['minDailyBalance'] = $transaction['amount'];
                            }
                        } else {
                            $report[$year][$month]['minDailyBalance'] = $transaction['amount'];
                        }
                        if(isset($report[$year][$month]['maxDailyBalance'])) {
                            if($transaction['amount'] > $report[$year][$month]['minDailyBalance']) {
                                $report[$year][$month]['maxDailyBalance'] = $transaction['amount'];
                            }
                        } else {
                            $report[$year][$month]['maxDailyBalance'] = $transaction['amount'];
                        }
                        $report[$year][$month]['count'] = isset($report[$year][$month]['count']) ? $report[$year][$month]['count']+1 : 1;
                        $report[$year][$month]['total'] = isset($report[$year][$month]['total']) ? $report[$year][$month]['total']+$transaction['amount'] : $transaction['amount'];
                        $report[$year][$month]['averege'] = $report[$year][$month]['total'] / $report[$year][$month]['count']; 
                    //}
                //}
            }
            return $report;
        } catch (Exception $e) {
            echo 'Catch exception: ',  $e->getMessage();
        }
    }    


    public function generateCashFlowReport($customerId, $accountId)
    {
        $client = new Client();
        $url = "https://api.finicity.com/decisioning/v2/customers/{$customerId}/cashFlowBusiness?fromDate=1593576000";
        $token = !empty(session('finicityAppToken')) ? session('finicityAppToken') : $this->getToken();

        $params = [
            "accountIds" => $accountId,
        ];

        $headers = [
            'Content-Type' => env('APLICATION_JSON'),
            'Accept' => env('APLICATION_JSON'),
            'Finicity-App-Key' => env('FINICITY_APP_KEY'),
            'Finicity-App-Token' => $token
        ];

        $response = $client->request('POST', $url, [
            'json' => $params,
            'headers' => $headers,
            'verify'  => false
        ]);

        $responseBody = $response->getBody();

        return $responseBody;
    }

    public function getReportByCustomer($customerId, $reportId)
    {
        $client = new Client();
        $url = "https://api.finicity.com/decisioning/v3/customers/{$customerId}/reports/{$reportId}";
        $token = !empty(session('finicityAppToken')) ? session('finicityAppToken') : $this->getToken();

        $headers = [
            'Content-Type' => env('APLICATION_JSON'),
            'Accept' => env('APLICATION_JSON'),
            'Finicity-App-Key' => env('FINICITY_APP_KEY'),
            'Finicity-App-Token' => $token,
            'purpose' => '26'
        ];

        $response = $client->request('GET', $url, [
            'headers' => $headers,
            'verify'  => false
        ]);

        $responseBody = $response->getBody();
        return $responseBody;

        /*
        $responseBody = json_decode($response->getBody(), true);
        $report = $responseBody["report"];
        $transaction = new TransactionsController();
        if($transaction->saveCashFlowReport($report)) {
            return $report;
        } else {
            return "Could not save report";
        }
        */
    }

    public function getAccountACHDetails($customer, $account)
    {
        try {
            $client = new Client();
            $url = "https://api.finicity.com/aggregation/v1/customers/{$customer}/accounts/{$account}/details";
            $token = !empty(session('finicityAppToken')) ? session('finicityAppToken') : $this->getToken();

            $headers = [
                'Content-Type' => env('APLICATION_JSON'),
                'Accept' => env('APLICATION_JSON'),
                'Finicity-App-Key' => env('FINICITY_APP_KEY'),
                'Finicity-App-Token' => $token,
            ];

            $response = $client->request('GET', $url, [
                'headers' => $headers
            ]);

            //$responseBody = $response->getBody();
            $responseBody = json_decode($response->getBody(), true);
            $account = new AccountsACHController();
            if($account->saveAccount($responseBody)) {
                return $responseBody;
            } else {
                return "Could not save account ACH";
            }
        } catch (Exception $e) {
            echo 'Catch exception: ',  $e->getMessage();
        }
    }


    public function addTestingCustomer($username, $firstName, $lastName)
    {
        $client = new Client();
        $url = env('API_BASE_URL')."/aggregation/v2/customers/testing";
        $token = !empty(session('finicityAppToken')) ? session('finicityAppToken') : $this->getToken();

        $params = [
            "username" => $username,
            "firstName" => $firstName,
            "lastName" => $lastName
        ];

        $headers = [
            'Content-Type' => env('APLICATION_JSON'),
            'Accept' => env('APLICATION_JSON'),
            'Finicity-App-Key' => env('FINICITY_APP_KEY'),
            'Finicity-App-Token' => $token
        ];

        $response = $client->request('POST', $url, [
            'json' => $params,
            'headers' => $headers,
            'verify'  => false
        ]);
        $responseBody = $response->getBody();

        return $responseBody;
    }


    public function createConsumer($customerId)
    {
        $client = new Client();
        $url = env('API_BASE_URL')."/decisioning/v1/customers/{$customerId}/consumer";
        $token = !empty(session('finicityAppToken')) ? session('finicityAppToken') : $this->getToken();

        $params = [
            "firstName" => "John",
            "lastName" => "Smith",
            "address" => "434 W Ascension Way",
            "city" => "Murray",
            "state" => "UT",
            "zip" => "84123",
            "phone" => "6786786786",
            "ssn" => "111222333",
            "birthday" => [
                "year" => 1989,
                "month" => 8,
                "dayOfMonth" => 13
            ],
            "suffix" => "Mr"
        ];

        $headers = [
            'Content-Type' => env('APLICATION_JSON'),
            'Accept' => env('APLICATION_JSON'),
            'Finicity-App-Key' => env('FINICITY_APP_KEY'),
            'Finicity-App-Token' => $token
        ];

        $response = $client->request('POST', $url, [
            'json' => $params,
            'headers' => $headers,
            'verify'  => false
        ]);

        $responseBody = $response->getBody();
        return $responseBody;
    }
     
}
