<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class TransactionsController extends Controller
{
    public function index()
    {
    }

    public function saveTransactions($transactions)
    {
        $date = Carbon::now();
        try {
            
            foreach ($transactions as $transaction) {
                DB::connection()->getPdo();
                if(!DB::table('transactions')->where('id', intval($transaction['id']))->exists()) {
                    DB::table('transactions')->insert([
                        'id' => intval($transaction['id']),
                        'amount' => $transaction['amount'],
                        'accountId' =>  !empty($transaction['accountId']) ? $transaction['accountId'] : '',
                        'customerId' => !empty($transaction['customerId']) ? $transaction['customerId'] : '',
                        'status' => !empty($transaction['status']) ? $transaction['status'] : '',
                        'description' => !empty($transaction['description']) ? $transaction['description'] : '',
                        'memo' => !empty($transaction['memo']) ? $transaction['memo'] : '',
                        'feeAmount' => !empty($transaction['feeAmount']) ? $transaction['feeAmount'] : 0,
                        'symbol' => !empty($transaction['symbol']) ? $transaction['symbol'] : '',
                        'unitQuantity' => !empty($transaction['unitQuantity']) ? intval(substr($transaction['unitQuantity'],0,18)) : 0,
                        'unitAction' => !empty($transaction['unitAction']) ? $transaction['unitAction'] : '',
                        //'postedDate' => !empty($transaction['postedDate']) ? $transaction['postedDate'] : '',
                        //'transactionDate' => !empty($transaction['transactionDate']) ? $transaction['transactionDate'] : '',
                        //'createdDate' => !empty($transaction['createdDate']) ? $transaction['createdDate'] : '',
                        'confirmationNumber' => !empty($transaction['confirmationNumber']) ? $transaction['confirmationNumber'] : '',
                        'payeeId' => !empty($transaction['payeeId']) ? $transaction['payeeId'] : '',
                        'extendedPayeeName' => !empty($transaction['extendedPayeeName']) ? $transaction['extendedPayeeName'] : '',
                        'originalCurrency' => !empty($transaction['originalCurrency']) ? $transaction['originalCurrency'] : '',
                        'runningBalanceAmount' => !empty($transaction['runningBalanceAmount']) ? intval(substr($transaction['runningBalanceAmount'],0,18)) : 0,
                        'escrowTaxAmount' => !empty($transaction['escrowTaxAmount']) ? intval(substr($transaction['escrowTaxAmount'],0,18)) : 0,
                        'escrowInsuranceAmount' => !empty($transaction['escrowInsuranceAmount']) ? intval(substr($transaction['escrowInsuranceAmount'],0,18)) : 0,
                        'escrowPmiAmount' => !empty($transaction['escrowPmiAmount']) ? intval(substr($transaction['escrowPmiAmount'],0,18)) : 0,
                        'escrowFeesAmount' => !empty($transaction['escrowFeesAmount']) ? intval(substr($transaction['escrowFeesAmount'],0,18)) : 0,
                        'escrowOtherAmount' => !empty($transaction['escrowOtherAmount']) ? intval(substr($transaction['escrowOtherAmount'],0,18)) : 0,
                        'inv401kSource' => !empty($transaction['inv401kSource']) ? $transaction['inv401kSource'] : '',
                        'relatedInstitutionTradeId' => !empty($transaction['relatedInstitutionTradeId']) ? $transaction['relatedInstitutionTradeId'] : '',
                        'subaccountSecurityType' => !empty($transaction['subaccountSecurityType']) ? $transaction['subaccountSecurityType'] : '',
                        'penaltyAmount' => !empty($transaction['penaltyAmount']) ? intval(substr($transaction['penaltyAmount'],0,18)) : 0,
                        'sharesPerContract' => !empty($transaction['sharesPerContract']) ? intval(substr($transaction['sharesPerContract'],0,18)) : 0,
                        'stateWithholding' => !empty($transaction['stateWithholding']) ? intval(substr($transaction['stateWithholding'],0,18)) : 0,
                        'taxesAmount' => !empty($transaction['taxesAmount']) ? intval(substr($transaction['taxesAmount'],0,18)) : 0,
                        'unitPrice' => !empty($transaction['unitPrice']) ? intval(substr($transaction['unitPrice'],0,18)) : 0,
                        'securedType' => !empty($transaction['securedType']) ? $transaction['securedType'] : '',
                        'reveralInstitutionTransactionId' => !empty($transaction['reveralInstitutionTransactionId']) ? $transaction['reveralInstitutionTransactionId'] : '',
                        'investmentTransactionType' => !empty($transaction['investmentTransactionType']) ? $transaction['investmentTransactionType'] : '',
                        'created_at' => $date
                    ]); 
                }
            }
            return true;
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }     


    public function saveCashFlowReport($report)
    {
        $date = Carbon::now();
        try {
            DB::connection()->getPdo();
            if(!DB::table('customer_report')->where('id', intval($report['id']))->exists()) {
                DB::table('customer_report')->insert([
                    'id' => intval($report['id']),
                    'customer_id' => $report['customerId'],
                    'account_id' => $report['accountId'],
                    'url' => "http://localhost/finicity/getreportbycustomer/customer/".$report['customerId'] . " /report/".$report['id'],
                    'created_at' => $date
                ]); 
            }
            return true;
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }

    public function getDataTransactions()
    {
        try {
            DB::connection()->getPdo();
            $transactions = DB::table('transactions')->get();
            return view('transactions.getdatatransactions', compact('transactions'));
        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }     
}
