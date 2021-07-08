<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class MonthlyCashFlowDebitsController extends Controller
{
    public function index()
    {
    }

    public function savemonthlyCashFlowDebits($monthlyCashFlowDebits)
    {
        $date = Carbon::now();
        try {
            foreach ($monthlyCashFlowDebits as $monthlyCashFlowDebit) {
                DB::connection()->getPdo();
                DB::table('monthly_cash_flow_debits')->insert([
                    'cashFlowDebitId' => !empty($monthlyCashFlowDebit['cashFlowDebitId']) ? intval($monthlyCashFlowDebit['cashFlowDebitId']) : 0,
                    'month' => !empty($monthlyCashFlowDebit['month']) ? $monthlyCashFlowDebit['month'] : 0,
                    'numberOfDebits' => !empty($monthlyCashFlowDebit['numberOfDebits']) ? $monthlyCashFlowDebit['numberOfDebits'] : 0,
                    'totalDebitotalDebitsAmounttsAmount' => !empty($monthlyCashFlowDebit['totalDebitsAmount']) ? $monthlyCashFlowDebit['totalDebitsAmount'] : 0,
                    'largestDebit' => !empty($monthlyCashFlowDebit['largestDebit']) ? $monthlyCashFlowDebit['largestDebit'] : 0,
                    'numberOfDebitsLessTransfers' => !empty($monthlyCashFlowDebit['numberOfDebitsLessTransfers']) ? $monthlyCashFlowDebit['numberOfDebitsLessTransfers'] : 0,
                    'totalDebitsAmountLessTransfers' => !empty($monthlyCashFlowDebit['totalDebitsAmountLessTransfers']) ? intval($monthlyCashFlowDebit['totalDebitsAmountLessTransfers']) : 0,
                    'averageDebitAmount' => !empty($monthlyCashFlowDebit['averageDebitAmount']) ? intval($monthlyCashFlowDebit['averageDebitAmount']) : 0,
                ]); 
            }
            return true;
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }
}
