<?php

use App\Models\Voucher;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoucherController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {

    return view('dashboard', ['vouchers' => Voucher::get()]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    //Import CSV Voucher
    Route::post('/import', [VoucherController::class, 'import'])->name('import.voucher');

    //Agent side
    Route::post('/search', [VoucherController::class, 'search_voucher'])->name('search.voucher');
    Route::post('/sell', [VoucherController::class, 'sell'])->name('sell');

    //Status Agent
    Route::get('/AgentStatus', [VoucherController::class, 'status'])->name('status');
    Route::get('/AgentHistory', [VoucherController::class, 'history'])->name('history');

    //Admin sales
    Route::get('/adminsales', [VoucherController::class, 'sales'])->name('sales');

    //Reset sales
    Route::get('/resetsale/{active_agents[0]->name}', [VoucherController::class, 'resetsale'])->name('resetsale');
   
   
});
 
 
//  Route::post('/push_to_sell', [VoucherController::class, 'push_to_sell'])->name('push_to_sell');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
