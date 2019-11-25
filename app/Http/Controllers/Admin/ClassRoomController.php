<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Event_log;
use App\Class_room;
use App\Subsidiary;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


class ClassRoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_owner');
    }

    public function index()
    {
    	return view('admin.class_rooms.index', 
        [
          'rooms' => Class_room::orderBy('created_at', 'asc')->paginate(1000)
        ]);
    }

    public function create()
    {
    	$nameSubs = Subsidiary::all();

    	return view('admin.class_rooms.create', compact('nameSubs')); 
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'subsidiaries_name' => ['required', 'string', 'max:255'],
    		'room_name' => ['required', 'string', 'max:500'],
    		'seating_capacity' => ['required', 'max:500']
		]);

    	$subId = $request->input('subsidiaries_name');
    	$Sub_id = Subsidiary::where('name', $subId)->get();
    	$var = $Sub_id->first();
    	$Sub_id = $var->id;


		$Class_room = new Class_room();
  		$Class_room->add($subId, $request->input('room_name'), $request->input('seating_capacity'), $Sub_id);

  		$lastUserId = \DB::table('class_rooms')->max('id');
        $log = new Event_log();
        $log->log($subId, $lastUserId, 'добавил кабинет');

    	return redirect('dashboard/class_room');
    }

    public function edit($id)
    {
        $room = Class_room::find($id);
        $nameSubs = Subsidiary::all();
        return view('admin.class_rooms.edit', compact('nameSubs', 'room'));
    }

    public function update(Request $request, $id)
    {   
        $this->validate($request, [
            'subsidiaries_name' => ['required', 'string', 'max:255'],
            'room_name' => ['required', 'string', 'max:255'],
            'seating_capacity'=> ['required', 'max:255'],
        ]);
    
        $Class_room = Class_room::find($id);
        $dateTime = Carbon::now('Europe/Kiev');


        $subId = $request->input('subsidiaries_name');
        $Sub_id = Subsidiary::where('name', $subId)->get();
        $var = $Sub_id->first();
        $Sub_id = $var->id;


        $Class_room->update([
            'subsidiaries_id' => $Sub_id,
            'subsidiaries_name' => $request->input('subsidiaries_name'), 
            'room_name' => $request->input('room_name'),
            'seating_capacity' => $request->input('seating_capacity'),
            'created_at' => $dateTime,
        ]);

        $log = new Event_log();
        $log->log($request->input('subsidiaries_name'), $id, 'обновил кабинет');
        
        // return redirect('/dashboard/class_room');
        echo "<script>window.close()</script>";
    }


    public function destroy($id)
    {

        $delUsers = Class_room::find($id);

        $log = new Event_log();
        $log->log($delUsers->room_name, $id, 'удалил кабинет');

        Class_room::find($id)->delete();

        return redirect('/dashboard/class_room');
    }
    
}
