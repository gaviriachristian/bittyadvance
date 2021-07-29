<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class MonthlyBalanceReportController extends Controller
{
    public function index()
    {
    }

    public function saveMonyhlyBalanceReport($responseReport)
    {
        $date = Carbon::now();
        try {
            foreach ($responseReport as $report) {
                DB::connection()->getPdo();
                DB::table('monthly_balance_report')->insert([
                    'month' => !empty($report['month']) ? $report['month'] : null,
                    'days_negative' => !empty($report['daysNegative']) ? $report['daysNegative'] : 0,
                    'average' => !empty($report['average']) ? $report['average'] : 0,
                    'loan_debits_total' => !empty($report['loanDebitsTotal']) ? $report['loanDebitsTotal'] : 0,
                    'loan_deposit_total' => !empty($report['loanDepositTotal']) ? $report['loanDepositTotal'] : 0,
                    'account_id' => !empty($report['account_id']) ? $report['account_id'] : 0,
                    'customer_id' => !empty($report['customer_id']) ? $report['customer_id'] : 0,
                    'created_at' => $date
                ]); 
            }
            return true;
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }

    public function deleteMonthlyBalanceReport($accountId)
    {
        try {
            DB::connection()->getPdo();
            DB::table('monthly_balance_report')->where('account_id', '=', $accountId)->delete();
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }
}
