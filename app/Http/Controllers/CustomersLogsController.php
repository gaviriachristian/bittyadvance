<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CustomersLogsController extends Controller
{
    public function index()
    {
    }

    public function saveCustomersLogs(Request $request)
    {
        $event = json_encode($request->event);
        $date = Carbon::now();
        try {
            DB::connection()->getPdo();
            DB::table('customers_logs')->insert([
                'event' => $event,
                'customer_id' => intval($request->customerId),
                'type' => !empty($request->event['type']) ? $request->event['type'] : '',
                'action' => !empty($request->event['data']['action']) ? $request->event['data']['action'] : '',
                'partner_id' => !empty($request->event['data']['partnerId']) ? $request->event['data']['partnerId'] : '',
                'institution_id' => !empty($request->event['data']['institutionId']) ? $request->event['data']['institutionId'] : '',
                'product' => !empty($request->event['data']['product']) ? $request->event['data']['product'] : '',
                'screen' => !empty($request->event['data']['screen']) ? $request->event['data']['screen'] : '',
                'session_id' => !empty($request->event['data']['session_id']) ? $request->event['data']['session_id'] : '',
                'search_term' => !empty($request->event['data']['search_term']) ? $request->event['data']['search_term'] : '',
                'result_count' => !empty($request->event['data']['result_count']) ? $request->event['data']['result_count'] : '',
                'success' => !empty($request->event['data']['success']) ? $request->event['data']['success'] : '',
                'accounts' => !empty($request->event['data']['accounts']) ? $request->event['data']['accounts'] : '',
                'error_code' => !empty($request->event['data']['error_code']) ? $request->event['data']['error_code'] : '',
                'alert_type' => !empty($request->event['data']['alert_type']) ? $request->event['data']['alert_type'] : '',
                'message' => !empty($request->event['data']['message']) ? $request->event['data']['message'] : '',
                'title' => !empty($request->event['data']['title']) ? $request->event['data']['title'] : '',
                'created_at' => $date
            ]); 
            echo "Saved customer log";
        } catch (\Exception $e) {
            echo "Could not connect to the database.  Please check your configuration. error:" . $e ;
        }
        //return view('customerslogs.savecustomerlogs', compact('token'));
    }     

    public function getDataCustomersLogs()
    {
        try {
            DB::connection()->getPdo();
            $customers = DB::table('customers_logs')->get();
            return view('customerslogs.getdatacustomerlogs', compact('customers'));
        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }     
}
