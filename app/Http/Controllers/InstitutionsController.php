<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class InstitutionsController extends Controller
{
    public function index()
    {
    }

    public function saveInstitutions($institutions)
    {
        $date = Carbon::now();
        try {
            foreach ($institutions as $institution) {
                DB::connection()->getPdo();
                if(!DB::table('institutions')->where('id', intval($institution['id']))->exists()) {
                    DB::table('institutions')->insert([
                        'id' => intval($institution['id']),
                        'name' => !empty($institution['name']) ? $institution['name'] : '',
                        'urlHomeApp' => !empty($institution['urlHomeApp']) ? $institution['urlHomeApp'] : ''
                    ]); 
                }
            }
            return true;
        } catch (\Exception $e) {
            die( "Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }
}
