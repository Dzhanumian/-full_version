<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    protected $fillable = [
        'id', 'student_id', 'group_id', 'group_name', 'invoice', 'designed', 'comment', 'month','created_at', 'updated_at', 'quantity', 'tarif', 'balance', 'initials', 'type', 'status'
    ];

    public function add($student_id, $group_id, $group_name, $invoice, $comment, $month, $quantity, $tarif, $balance, $initials, $type, $status)
    {	
    	$dateTime = Carbon::now('Europe/Kiev');
    	$lastId = \DB::table('finances')->max('id');	
    	$userId = Auth::id();

		Finance::create([

		    'id' => $lastId+1,
		    'student_id' => $student_id, 
		    'group_id' => $group_id,
		    'group_name' => $group_name, 
		    'invoice' => $invoice,
		    'month' => $month,
		    'quantity' =>$quantity,
		    'designed' => $userId,
		    'comment' => $comment,
		    'created_at' => $dateTime,
		    'tarif' => $tarif,
		    'balance' => $balance,
		    'initials' => $initials,
		    'type' => $type,
		    'status' => $status
		]);
	}
}
