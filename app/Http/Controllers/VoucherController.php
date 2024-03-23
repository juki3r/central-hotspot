<?php

namespace App\Http\Controllers;

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
        if(Auth::user()->usertype != 'user'){
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
        if(Auth::user()->usertype != 'user'){
            return redirect('dashboard');
        }
        $request->validate([
            'sell_confirm' => 'required'
        ]);
        Voucher::where('voucher', $request->sell_confirm)->update(array('is_it_used' => 'used', 'sold_by' => $request->user()->name, 'sold_at' => date('M-d-Y')));
        return redirect('dashboard')->with('status', 'Thank you agent');
    }

    //status agent
    public function status () 
    {
        if(Auth::user()->usertype != 'user'){
            return redirect('dashboard');
        }
        //5 pesos
        $agentstatus_sell5 = count(Voucher::where('sold_by', Auth::user()->name)->where('price' , 5)->get('price'))*5; // 4hours
        //10 pesos
        $agentstatus_sell10 = count(Voucher::where('sold_by', Auth::user()->name)->where('price' , 10)->get('price'))*10; // 8hours
        //20 pesos
        $agentstatus_sell20 = count(Voucher::where('sold_by', Auth::user()->name)->where('price' , 20)->get('price'))*20; // 16hours
        //30 pesos
        $agentstatus_sell30 = count(Voucher::where('sold_by', Auth::user()->name)->where('price' , 30)->get('price'))*30; // 24hours
        // echo intval($agentstatus[0]->price).intval($agentstatus[1]->price);
        $totalsale = $agentstatus_sell5 + $agentstatus_sell10 + $agentstatus_sell20 + $agentstatus_sell30;
        $agentincome = $totalsale * 0.2;
        return view('include.agentstatus', ['totalsale' => $totalsale,'agentincome' => $agentincome]);
        

    }
}
