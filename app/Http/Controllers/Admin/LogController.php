<?php

namespace App\Http\Controllers\Admin;

use App\Event_log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	return view('admin.log.index', 
        [
          'logs' => Event_log::orderBy('created_at', 'desc')->paginate(1000)
        ]);
    }

}