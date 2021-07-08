<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class MonthlyCashFlowCreditsController extends Controller
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
                    'cashFlowCreditId' => !empty($monthlyCashFlowCredit['cashFlowCreditId']) ? intval($monthlyCashFlowCredit['cashFlowCreditId']) : 0,
                    'month' => !empty($monthlyCashFlowCredit['month']) ? $monthlyCashFlowCredit['month'] : 0,
                    'numberOfCredits' => !empty($monthlyCashFlowCredit['numberOfCredits']) ? $monthlyCashFlowCredit['numberOfCredits'] : 0,
                    'totalCreditsAmount' => !empty($monthlyCashFlowCredit['totalCreditsAmount']) ? $monthlyCashFlowCredit['totalCreditsAmount'] : 0,
                    'largestCredit' => !empty($monthlyCashFlowCredit['largestCredit']) ? $monthlyCashFlowCredit['largestCredit'] : 0,
                    'numberOfCreditsLessTransfers' => !empty($monthlyCashFlowCredit['numberOfCreditsLessTransfers']) ? $monthlyCashFlowCredit['numberOfCreditsLessTransfers'] : 0,
                    'totalCreditsAmountLessTransfers' => !empty($monthlyCashFlowCredit['totalCreditsAmountLessTransfers']) ? intval($monthlyCashFlowCredit['totalCreditsAmountLessTransfers']) : 0,
                    'averageCreditAmount' => !empty($monthlyCashFlowCredit['averageCreditAmount']) ? intval($monthlyCashFlowCredit['averageCreditAmount']) : 0,
                    'estimatedNumberOfLoanDeposits' => !empty($monthlyCashFlowCredit['estimatedNumberOfLoanDeposits']) ? intval($monthlyCashFlowCredit['estimatedNumberOfLoanDeposits']) : 0,
                    'estimatedLoanDepositAmount' => !empty($monthlyCashFlowCredit['estimatedLoanDepositAmount']) ? intval($monthlyCashFlowCredit['estimatedLoanDepositAmount']) : 0,
                ]); 
            }
            return true;
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }
}
