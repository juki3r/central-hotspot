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
        //50 pesos
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
        
     

        // Remia Arcenas
        $remia_sell5 = count(Voucher::where('sold_by', 'Remia Arcenas')->where('price' , 5)->get('price'))*5;
        $remia_sell10 = count(Voucher::where('sold_by', 'Remia Arcenas')->where('price' , 10)->get('price'))*10;
        $remia_sell20 = count(Voucher::where('sold_by', 'Remia Arcenas')->where('price' , 20)->get('price'))*20;
        $remia_sell50 = count(Voucher::where('sold_by', 'Remia Arcenas')->where('price' , 50)->get('price'))*50;
        $remia_total = $remia_sell5 + $remia_sell10 + $remia_sell20 + $remia_sell50;
        $remiaincome = $remia_total * 0.4;
        $remiareturnincome = $remia_total - $remiaincome;

        // Rona Africa
        $rona_sell5 = count(Voucher::where('sold_by', 'Rona Africa')->where('price' , 5)->get('price'))*5;
        $rona_sell10 = count(Voucher::where('sold_by', 'Rona Africa')->where('price' , 10)->get('price'))*10;
        $rona_sell20 = count(Voucher::where('sold_by', 'Rona Africa')->where('price' , 20)->get('price'))*20;
        $rona_sell50 = count(Voucher::where('sold_by', 'Rona Africa')->where('price' , 50)->get('price'))*50;
        $rona_total = $rona_sell5 + $rona_sell10 + $rona_sell20 + $rona_sell50;
        $ronaincome = $rona_total * 0.4;
        $ronareturnincome = $rona_total - $ronaincome;

        // Cindy Buhayan
        $cindy_sell5 = count(Voucher::where('sold_by', 'Cindy Buhayan')->where('price' , 5)->get('price'))*5;
        $cindy_sell10 = count(Voucher::where('sold_by', 'Cindy Buhayan')->where('price' , 10)->get('price'))*10;
        $cindy_sell20 = count(Voucher::where('sold_by', 'Cindy Buhayan')->where('price' , 20)->get('price'))*20;
        $cindy_sell50 = count(Voucher::where('sold_by', 'Cindy Buhayan')->where('price' , 50)->get('price'))*50;
        $cindy_total = $cindy_sell5 + $cindy_sell10 + $cindy_sell20 + $cindy_sell50;
        $cindyincome = $cindy_total * 0.4;
        $cindyreturnincome = $cindy_total - $cindyincome;

        // Jean Cayetano
        $jean_sell5 = count(Voucher::where('sold_by', 'Jean Cayetano')->where('price' , 5)->get('price'))*5;
        $jean_sell10 = count(Voucher::where('sold_by', 'Jean Cayetano')->where('price' , 10)->get('price'))*10;
        $jean_sell20 = count(Voucher::where('sold_by', 'Jean Cayetano')->where('price' , 20)->get('price'))*20;
        $jean_sell50 = count(Voucher::where('sold_by', 'Jean Cayetano')->where('price' , 50)->get('price'))*50;
        $jean_total = $jean_sell5 + $jean_sell10 + $jean_sell20 + $jean_sell50;
        $jeanincome = $jean_total * 0.4;
        $jeanreturnincome = $jean_total - $jeanincome;

        //TOTAL INCOME ADMIN

        $adminsells = $ronareturnincome + $cindyreturnincome + $jeanreturnincome;

        return view('include.adminsales', [
            'active_agents' => $active_agents,
            'remia_total' => $remia_total,
            'remiaincome' => $remiaincome,
            'remiareturnincome' => $remiareturnincome,
            'rona_total' => $rona_total,
            'ronaincome' => $ronaincome,
            'ronareturnincome' => $ronareturnincome,
            'cindy_total' => $cindy_total,
            'cindyincome' => $cindyincome,
            'cindyreturnincome' => $cindyreturnincome,
            'jean_total' => $jean_total,
            'jeanincome' => $jeanincome,
            'jeanreturnincome' => $jeanreturnincome,
            'adminsells' => $adminsells,
        ]);

    }
}
