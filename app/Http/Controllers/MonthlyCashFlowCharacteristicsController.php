<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class MonthlyCashFlowCharacteristicsController extends Controller
{
    public function index()
    {
    }

    public function savemonthlyCashFlowCredits($monthlyCashFlowCredits)
    {
        $date = Carbon::now();
        try {
            foreach ($monthlyCashFlowCredits as $monthlyCashFlowCredit) {
                DB::connection()->getPdo();
                DB::table('monthly_cash_flow_credits')->insert([
                    'cashFlowCreditId' => !empty($monthlyCashFlowCredit['cashFlowCharacteristicId']) ? intval($monthlyCashFlowCredit['cashFlowCharacteristicId']) : 0,
                    'month' => !empty($monthlyCashFlowCredit['month']) ? $monthlyCashFlowCredit['month'] : 0,
                    'totalCreditsLessTotalDebits' => !empty($monthlyCashFlowCredit['totalCreditsLessTotalDebits']) ? $monthlyCashFlowCredit['totalCreditsLessTotalDebits'] : 0,
                    'totalCreditsLessTotalDebitsLessTransfers' => !empty($monthlyCashFlowCredit['totalCreditsLessTotalDebitsLessTransfers']) ? $monthlyCashFlowCredit['totalCreditsLessTotalDebitsLessTransfers'] : 0,
                    'averageTransactionAmount' => !empty($monthlyCashFlowCredit['averageTransactionAmount']) ? $monthlyCashFlowCredit['averageTransactionAmount'] : 0,
                ]); 
            }
            return true;
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }
}
