<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use App\Imports\VoucherImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class VoucherController extends Controller
{
    //For importing csv file voucher
    public function import (Request $request)
    {
        if(Auth::user()->usertype != 'admin'){
            return redirect('dashboard');
        }
        $request->validate([
            'voucher_file' => 'required|file'
        ]);

        Excel::import(new VoucherImport, $request->file('voucher_file'));
        return redirect()->back()->with('status', 'Import Successfully');
    }

    // for agent searching response
    public function search_voucher (Request $request)
    {
        if(Auth::user()->usertype != 'agent'){
            return redirect('dashboard');
        }
        $request->validate([
            'voucher_search' => 'required'
        ]);
        $not_used = Voucher::where('is_it_used', null)->where('price', $request->voucher_search)->get();
        if(isset($not_used[0])){
            return view('dashboard', ['voucher_to_sell' => $not_used[0]->voucher, 'voucher_price' => $not_used[0]->price]);
        }else{
            return redirect()->back()->with('status', 'Sorry No Voucher Available');
        }
        
    }
   

    //for agent sell proceed
    public function sell (Request $request) 
    {
        if(Auth::user()->usertype != 'agent'){
            return redirect('dashboard');
        }
        $request->validate([
            'sell_confirm' => 'required'
        ]);
        date_default_timezone_set('Asia/Manila');
        Voucher::where('voucher', $request->sell_confirm)->update(array('is_it_used' => 'used', 'sold_by' => $request->user()->name, 'sold_at' => date('M-d-Y H:i:s')));
        return redirect('dashboard')->with('status', 'Sell complete, Thank you agent !');
    }

    //status agent
    public function status () 
    {
        if(Auth::user()->usertype != 'agent'){
            return redirect('dashboard');
        }
        //5 pesos
        $agentstatus_sell5 = count(Voucher::where('sold_by', Auth::user()->name)->where('price' , 5)->get('price'))*5; // 6hours
        //10 pesos
        $agentstatus_sell10 = count(Voucher::where('sold_by', Auth::user()->name)->where('price' , 10)->get('price'))*10; // 12hours
        //20 pesos
        $agentstatus_sell20 = count(Voucher::where('sold_by', Auth::user()->name)->where('price' , 20)->get('price'))*20; // 24hours
        //30 pesos
        $agentstatus_sell50 = count(Voucher::where('sold_by', Auth::user()->name)->where('price' , 50)->get('price'))*50; // 3days
        // echo intval($agentstatus[0]->price).intval($agentstatus[1]->price);
        $totalsale = $agentstatus_sell5 + $agentstatus_sell10 + $agentstatus_sell20 + $agentstatus_sell50;
        $agentincome = $totalsale * 0.4;
        $adminincome = $totalsale - $agentincome;
        return view('include.agentstatus', ['totalsale' => $totalsale,'agentincome' => $agentincome, 'adminincome' => $adminincome]);
        

    }
    //agents sales history
    public function history ()
    {
        if(Auth::user()->usertype != 'agent'){
            return redirect('dashboard');
        }
        $history = Voucher::where('sold_by', Auth::user()->name)->get();
        return view('include.agenthistory', ['history' => $history]);

    }

    //Admin sales
    public function sales ()
    {
        if(Auth::user()->usertype != 'admin'){
            return redirect('dashboard');
        }
        $active_agents = User::where('usertype', 'agent')->get('name');
        $get_sales = Voucher::where('sold_by', '!=', null)->get('name');
        return $get_sales;
        // return view ('include.adminsales', ['active_agents' => $active_agents, 'get_sales' => $get_sales]);

    }
}
