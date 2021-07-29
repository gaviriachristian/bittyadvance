<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Database\Connection;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    // Test database connection
    try {
        DB::connection()->getPdo();
        echo "Connected successfully to: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        die("Could not connect to the database. Please check your configuration. error:" . $e );
    }

    return view('welcome');
});

Route::get('/finicity/gettoken', 'FinicityController@getToken');
Route::get('/finicity/generatev2connecturllinks/customer/{customer}/consumer/{consumer}', 'FinicityController@generateV2ConnectURLLinks');
Route::get('/finicity/connectiframe/customer/{customer}/consumer/{consumer}', 'FinicityController@connectIframe');

Route::get('/finicity/addtestingcustomer/username/{username}/firstname/{firstname}/lastname/{lastname}', 'FinicityController@addTestingCustomer');
Route::get('/finicity/createconsumer/customer/{customer}', 'FinicityController@createConsumer');

Route::get('/finicity/getcustomers/start/{start}/limit/{limit}/type/{type}', 'FinicityController@getCustomers');
Route::get('/finicity/getcustomersaccounts/customer/{customer}/status/{status}', 'FinicityController@getCustomersAccounts');
Route::get('/finicity/getcustomersaccount/customer/{customer}/account/{account}', 'FinicityController@getCustomersAccount');
Route::get('/finicity/getaccountowner/customer/{customer}/account/{account}', 'FinicityController@getAccountOwner');

Route::get('/finicity/generatecashflowreport/customer/{customer}/account/{account}', 'FinicityController@generateCashFlowReport');
Route::get('/finicity/getreportbycustomer/customer/{customer}/report/{report}', 'FinicityController@getReportByCustomer');

Route::get('/finicity/getcustomertransactionsall/customer/{customer}/from/{from}/to/{to}', 'FinicityController@getCustomerTransactionsAll');
Route::get('/finicity/getcustomeraccounttransactions/customer/{customer}/account/{account}/from/{from}/to/{to}', 'FinicityController@getCustomerAccountTransactions');
Route::get('/finicity/getcustomeraccounttransactionsreport/customer/{customer}/account/{account}/from/{from}/to/{to}', 'FinicityController@getCustomerAccountTransactionsReport');
Route::get('/finicity/getmonthlydepositsreport/customer/{customer}/account/{account}/from/{from}/to/{to}', 'FinicityController@getMonthlyDepositsReport');
Route::get('/finicity/getdailybalancereport/customer/{customer}/account/{account}/from/{from}', 'FinicityController@getDailyBalanceReport');

Route::get('/finicity/getaccountachdetails/customer/{customer}/account/{account}', 'FinicityController@getAccountACHDetails');

Route::post('/customerslogs/savecustomerlogs', 'CustomersLogsController@saveCustomersLogs');
Route::get('/customerslogs/getdatacustomerlogs', 'CustomersLogsController@getDataCustomersLogs');
//Route::get('/customerslogs/setcustomerlogs', 'CustomersLogsController@setCustomersLogs');
//Route::get('/customerslogs/setcustomerlogs/{action}/{event}/{CustomerId}', 'CustomersLogsController@setCustomersLogs');

Route::resources([
    'projects' => 'ProjectController',
    'finicity' => 'FinicityController',
]);
