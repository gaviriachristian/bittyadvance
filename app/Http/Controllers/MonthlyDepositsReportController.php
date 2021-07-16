<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class MonthlyDepositsReportController extends Controller
{
    public function index()
    {
    }

    public function saveMonthlyDepositsReport($responseReport)
    {
        $date = Carbon::now();
        try {
            foreach ($responseReport as $report) {
                DB::connection()->getPdo();
                DB::table('monthly_deposits_report')->insert([
                    'year_month' => !empty($report['year_month']) ? $report['year_month'] : null,
                    'amount' => !empty($report['amount']) ? $report['amount'] : 0,
                    'underwriting_total' => !empty($report['underwriting_total']) ? $report['underwriting_total'] : 0,
                    'positive_transaction_count' => !empty($report['positive_transaction_count']) ? $report['positive_transaction_count'] : 0,
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

    public function deleteMonthlyDepositsReport($customerId, $accountId)
    {
        try {
            DB::connection()->getPdo();
            DB::table('monthly_deposits_report')->where('account_id', '=', $accountId)->delete();
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }
}
