<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CashFlowBalanceController extends Controller
{
    public function index()
    {
    }

    public function saveCashFlowBalance($cashFlowBalance)
    {
        $date = Carbon::now();
        try {
            DB::connection()->getPdo();
            DB::table('cash_flow_balance')->insert([
                'accountId' => !empty($cashFlowBalance['accountId']) ? intval($cashFlowBalance['accountId']) : 0,
                'minDailyBalance' => !empty($cashFlowBalance['minDailyBalance']) ? $cashFlowBalance['minDailyBalance'] : 0,
                'maxDailyBalance' => !empty($cashFlowBalance['maxDailyBalance']) ? $cashFlowBalance['maxDailyBalance'] : 0,
                'sixMonthAverageDailyBalance' => !empty($cashFlowBalance['sixMonthAverageDailyBalance']) ? $cashFlowBalance['sixMonthAverageDailyBalance'] : 0,
                'twoMonthAverageDailyBalance' => !empty($cashFlowBalance['twoMonthAverageDailyBalance']) ? intval($cashFlowBalance['twoMonthAverageDailyBalance']) : 0,
                'sixMonthStandardDeviationOfDailyBalance' => !empty($cashFlowBalance['sixMonthStandardDeviationOfDailyBalance']) ? $cashFlowBalance['sixMonthStandardDeviationOfDailyBalance'] : 0,
                'twoMonthStandardDeviationOfDailyBalance' => !empty($cashFlowBalance['twoMonthStandardDeviationOfDailyBalance']) ? $cashFlowBalance['twoMonthStandardDeviationOfDailyBalance'] : 0,
                'numberOfDaysNegativeBalance' => !empty($cashFlowBalance['numberOfDaysNegativeBalance']) ? intval($cashFlowBalance['numberOfDaysNegativeBalance']) : 0,
                'numberOfDaysPositiveBalance' => !empty($cashFlowBalance['numberOfDaysPositiveBalance']) ? intval($cashFlowBalance['numberOfDaysPositiveBalance']) : 0,
                'summary' => !empty($cashFlowBalance['summary']) ? $cashFlowBalance['summary'] : null,
            ]); 
            return true;
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }
}
