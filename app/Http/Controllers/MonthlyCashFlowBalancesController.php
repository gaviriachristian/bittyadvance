<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class MonthlyCashFlowBalancesController extends Controller
{
    public function index()
    {
    }

    public function savemonthlyCashFlowBalances($monthlyCashFlowBalances)
    {
        $date = Carbon::now();
        try {
            foreach ($monthlyCashFlowBalances as $monthlyCashFlowBalance) {
                DB::connection()->getPdo();
                DB::table('monthly_cash_flow_balances')->insert([
                    'cashFlowBalanceId' => intval($monthlyCashFlowBalance['cashFlowBalanceId']),
                    'month' => !empty($monthlyCashFlowBalance['month']) ? $monthlyCashFlowBalance['month'] : 0,
                    'minDailyBalance' => !empty($monthlyCashFlowBalance['minDailyBalance']) ? $monthlyCashFlowBalance['minDailyBalance'] :0,
                    'maxDailyBalance' => !empty($monthlyCashFlowBalance['maxDailyBalance']) ? $monthlyCashFlowBalance['maxDailyBalance'] : 0,
                    'averageDailyBalance' => !empty($account['averageDailyBalance']) ? $account['averageDailyBalance'] : 0,
                    'standardDeviationOfDailyBalance' => !empty($account['standardDeviationOfDailyBalance']) ? $account['standardDeviationOfDailyBalance'] : 0,
                    'numberOfDaysNegativeBalance' => !empty($cashFlowDebit['numberOfDaysNegativeBalance']) ? intval($cashFlowDebit['numberOfDaysNegativeBalance']) : 0,
                    'numberOfDaysPositiveBalance' => !empty($cashFlowDebit['numberOfDaysPositiveBalance']) ? intval($cashFlowDebit['numberOfDaysPositiveBalance']) : 0,
                ]); 
            }
            return true;
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }
}
