<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CustomersController extends Controller
{
    public function index()
    {
    }

    public function saveCustomers($customers)
    {
        $date = Carbon::now();
        try {
            foreach ($customers as $customer) {
                DB::connection()->getPdo();
                if(!DB::table('customers')->where('id', intval($customer['id']))->exists()) {
                    $createdDate = date('Y-m-d H:i:s', !empty($customer['createdDate']) ? $customer['createdDate'] : null);
                    DB::table('customers')->insert([
                        'id' => intval($customer['id']),
                        'username' => !empty($customer['username']) ? $customer['username'] : '',
                        'firstName' => !empty($customer['firstName']) ? $customer['firstName'] : '',
                        'lastName' => !empty($customer['lastName']) ? $customer['lastName'] : '',
                        'type' => !empty($customer['type']) ? $customer['type'] : '',
                        'createdDate' => $createdDate,
                        'created_at' => $date
                    ]); 
                }
            }
            return true;
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }     
}
