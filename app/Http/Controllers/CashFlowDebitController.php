<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CashFlowDebitController extends Controller
{
    public function index()
    {
    }

    public function saveCashFlowDebit($cashFlowDebit)
    {
        $date = Carbon::now();
        try {
            DB::connection()->getPdo();
            DB::table('cash_flow_debit')->insert([
                'accountId' => !empty($cashFlowDebit['accountId']) ? intval($cashFlowDebit['accountId']) : 0,
                'sixMonthDebitTotal' => !empty($cashFlowDebit['sixMonthDebitTotal']) ? $cashFlowDebit['sixMonthDebitTotal'] : 0,
                'sixMonthDebitTotalLessTransfers' => !empty($cashFlowDebit['sixMonthDebitTotalLessTransfers']) ? $cashFlowDebit['sixMonthDebitTotalLessTransfers'] : 0,
                'twoMonthDebitTotal' => !empty($cashFlowDebit['twoMonthDebitTotal']) ? $cashFlowDebit['twoMonthDebitTotal'] : 0,
                'twoMonthDebitTotalLessTransfers' => !empty($cashFlowDebit['twoMonthDebitTotalLessTransfers']) ? intval($cashFlowDebit['twoMonthDebitTotalLessTransfers']) : 0,
                'summary' => !empty($cashFlowDebit['summary']) ? $cashFlowDebit['summary'] : null,
            ]); 
            return true;
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }
}
