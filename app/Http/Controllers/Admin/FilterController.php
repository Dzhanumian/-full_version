<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilterController extends Controller
{
    public function student_filter(Request $request)
    {
        $status = $request->input('status');
        $payouts = $request->input('payouts');
                
        //return redirect()->back();
        return redirect('/dashboard/students/'.$status.'/'.$payouts);
    }
}
