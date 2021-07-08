<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CashFlowCharacteristicController extends Controller
{
    public function index()
    {
    }

    public function saveCashFlowCharacteristic($cashFlowCharacteristic)
    {
        $date = Carbon::now();
        try {
            DB::connection()->getPdo();
            DB::table('cash_flow_characteristic')->insert([
                'accountId' => !empty($cashFlowCharacteristic['accountId']) ? intval($cashFlowCharacteristic['accountId']) : 0,
                'averageMonthlyNet' => !empty($cashFlowCharacteristic['averageMonthlyNet']) ? $cashFlowCharacteristic['averageMonthlyNet'] : 0,
                'averageMonthlyNetLessTransfers' => !empty($cashFlowCharacteristic['averageMonthlyNetLessTransfers']) ? $cashFlowCharacteristic['averageMonthlyNetLessTransfers'] : 0,
                'sixMonthAverageTotalCreditsLessTotalDebits' => !empty($cashFlowCharacteristic['sixMonthAverageTotalCreditsLessTotalDebits']) ? $cashFlowCharacteristic['sixMonthAverageTotalCreditsLessTotalDebits'] : 0,
                'sixMonthAverageTotalCreditsLessTotalDebitsLessTransfers' => !empty($cashFlowCharacteristic['sixMonthAverageTotalCreditsLessTotalDebitsLessTransfers']) ? intval($cashFlowCharacteristic['sixMonthAverageTotalCreditsLessTotalDebitsLessTransfers']) : 0,
                'twoMonthAverageTotalCreditsLessTotalDebits' => !empty($cashFlowCharacteristic['twoMonthAverageTotalCreditsLessTotalDebits']) ? $cashFlowCharacteristic['twoMonthAverageTotalCreditsLessTotalDebits'] : 0,
                'twoMonthAverageTotalCreditsLessTotalDebitsLessTransfers' => !empty($cashFlowCharacteristic['twoMonthAverageTotalCreditsLessTotalDebitsLessTransfers']) ? $cashFlowCharacteristic['twoMonthAverageTotalCreditsLessTotalDebitsLessTransfers'] : 0,
                'summary' => !empty($cashFlowCharacteristic['summary']) ? $cashFlowCharacteristic['summary'] : null,
            ]); 
            return true;
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }
}
