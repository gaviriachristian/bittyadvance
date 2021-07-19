<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class DailyBalanceReportController extends Controller
{
    public function index()
    {
    }

    public function saveDailyBalanceReport($responseReport)
    {
        $date = Carbon::now();
        try {
            foreach ($responseReport as $report) {
                DB::connection()->getPdo();
                DB::table('daily_balance_report')->insert([
                    'day' => !empty($report['day']) ? $report['day'] : null,
                    'balance' => !empty($report['balance']) ? $report['balance'] : 0,
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

    public function deleteDailyBalanceReport($customerId, $accountId)
    {
        try {
            DB::connection()->getPdo();
            DB::table('daily_balance_report')->where('account_id', '=', $accountId)->delete();
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }
}
