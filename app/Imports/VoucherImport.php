<?php

namespace App\Imports;

use App\Models\Voucher;
use Maatwebsite\Excel\Concerns\ToModel;

class VoucherImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $voucher_same = Voucher::where('voucher',$row[0])->first();
            if($voucher_same){
                $voucher_same->update([
                    'price'   => $row[1], 
                ]);
            }else{
                Voucher::create([
                    'voucher' => $row[0],
                    'price'   => $row[1], 
                ]);
            }

            
     
    }
}
