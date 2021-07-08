<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AccountReportController extends Controller
{
    public function index()
    {
    }

    public function saveAccountReport($accountsReports)
    {
        $date = Carbon::now();
        try {
            foreach ($accountsReports as $accountReport) {
                DB::connection()->getPdo();
                DB::table('account_report')->insert([
                    'reportId' => intval($account['reportId']),
                    'accountId' => intval($account['accountId']),
                ]); 
            }
            return true;
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }     
}
