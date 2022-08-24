<?php

namespace App\Http\Controllers\Back\LogOut;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;

class BackLogOutController extends Controller
{   
    // ログアウト
    public function backLogOutEntry(Request $request){

        $request->session()->flush();

        return redirect('backLoginInit');
    }
}