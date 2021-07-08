<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AccountsACHController extends Controller
{
    public function index()
    {
    }

    public function saveAccount($account)
    {
        $date = Carbon::now();
        try {
            DB::connection()->getPdo();
            if(!DB::table('accounts_ach')->where('routingNumber', intval($account['routingNumber']))->exists()) {
                DB::table('accounts_ach')->insert([
                    'routingNumber' => intval($account['routingNumber']),
                    'realAccountNumber' => intval($account['realAccountNumber']),
                    'createdDate' => $date
                ]); 
            }
            return true;
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }
}
