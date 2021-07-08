<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CashFlowCreditController extends Controller
{
    public function index()
    {
    }

    public function saveCashFlowCredit($cashFlowCredit)
    {
        $date = Carbon::now();
        try {
            DB::connection()->getPdo();
            DB::table('cash_flow_credit')->insert([
                'accountId' => !empty($cashFlowCredit['accountId']) ? intval($cashFlowCredit['accountId']) : 0,
                'sixMonthCreditTotal' => !empty($cashFlowCredit['sixMonthCreditTotal']) ? $cashFlowCredit['sixMonthCreditTotal'] : 0,
                'sixMonthCreditTotalLessTransfers' => !empty($cashFlowCredit['sixMonthCreditTotalLessTransfers']) ? $cashFlowCredit['sixMonthCreditTotalLessTransfers'] : 0,
                'twoMonthCreditTotal' => !empty($cashFlowCredit['twoMonthCreditTotal']) ? $cashFlowCredit['twoMonthCreditTotal'] : 0,
                'twoMonthCreditTotalLessTransfers' => !empty($cashFlowCredit['twoMonthCreditTotalLessTransfers']) ? intval($cashFlowCredit['twoMonthCreditTotalLessTransfers']) : 0,
                'summary' => !empty($cashFlowCredit['summary']) ? $cashFlowCredit['summary'] : null,
            ]); 
            return true;
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }
}
