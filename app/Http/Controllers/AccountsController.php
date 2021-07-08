<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AccountsController extends Controller
{
    public function index()
    {
    }

    public function saveAccounts($customerId, $accounts)
    {
        $date = Carbon::now();
        try {
            
            foreach ($accounts as $account) {
                DB::connection()->getPdo();
                if(!DB::table('accounts')->where('id', intval($account['id']))->exists()) {
                    DB::table('accounts')->insert([
                        'id' => intval($account['id']),
                        'number' => intval($account['number']),
                        //'customerId' => intval(substr($account['customerId'],0,18)),
                        'customerId' => intval($account['customerId']),
                        'type' => !empty($account['type']) ? $account['type'] : '',
                        'accountNumberDisplay' => !empty($account['accountNumberDisplay']) ? $account['accountNumberDisplay'] : '',
                        'name' => !empty($account['name']) ? $account['name'] : '',
                        'aggregationStatusCode' => !empty($account['aggregationStatusCode']) ? intval(substr($account['aggregationStatusCode'],0,18)) : 0,
                        'status' => !empty($account['status']) ? $account['status'] : '',
                        'institutionId' => !empty($account['institutionId']) ? $account['institutionId'] : '',
                        'currency' => !empty($account['currency']) ? $account['currency'] : '',
                        'institutionLoginId' => !empty($account['institutionLoginId']) ? $account['institutionLoginId'] : '',
                        'displayPosition' => !empty($account['displayPosition']) ? $account['displayPosition'] : '',
                        'financialinstitutionAccountStatus' => !empty($account['financialinstitutionAccountStatus']) ? $account['financialinstitutionAccountStatus'] : '',
                        'accountNickname' => !empty($account['accountNickname']) ? $account['accountNickname'] : '',
                        'created_at' => $date
                    ]); 
                }

                //$this->getAccountOwner($customerId, $account['id']);
                //$this->generateCashFlowReport($customerId, $account['id']);
            }
            return true;
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }     

    public function saveAccountOwner($owner)
    {
        $date = Carbon::now();
        try {
            DB::connection()->getPdo();
            if(!DB::table('account_owner')->where('customer_id', intval($owner['customerId']))->exists()) {
                DB::table('account_owner')->insert([
                    'customer_id' => intval($owner['customerId']),
                    'account_id' => intval($owner['accountId']),
                    'owner_name' => !empty($owner['ownerName']) ? $owner['ownerName'] : '',
                    'owner_address' => !empty($owner['ownerAddress']) ? intval(substr($owner['ownerAddress'],0,18)) : 0,
                    'created_at' => $date
                ]); 
            }
            return true;
        } catch (\Exception $e) {
            die( "Could not connect to the database. Please check your configuration. error:" . $e );
        }
    }

    public function getDataAccounts()
    {
        try {
            DB::connection()->getPdo();
            $accounts = DB::table('accounts')->get();
            return view('accounts.getdatacustomerlogs', compact('accounts'));
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }

}
