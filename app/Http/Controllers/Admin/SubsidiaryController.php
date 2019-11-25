<?php

namespace App\Http\Controllers\Admin;

use App\Event_log;
use App\Subsidiary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SubsidiaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_owner');
    }

    public function index()
    {
    	return view('admin.subsidiary.index', 
        [
          'subs' => Subsidiary::orderBy('created_at', 'asc')->paginate(1000)
        ]);
    }

    public function create()
    {

    	return view('admin.subsidiary.create');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'subs_name' => ['unique:subsidiaries,name', 'required', 'string', 'max:255'],
    		'address' => ['required', 'string', 'max:500'],
    		'city' => ['required', 'max:500']
		]);

		$Sub = new Subsidiary();
    	$Sub->add($request->input('subs_name'), $request->input('address'), $request->input('city'));

    	$lastUserId = \DB::table('subsidiaries')->max('id');
        $log = new Event_log();
        $log->log($request->input('subs_name'), $lastUserId, 'создал филиал');

    	return redirect()->back();
    }

    public function edit($id)
    {
    	$sub = Subsidiary::find($id);
    	return view('admin.subsidiary.edit', ['sub'=>$sub]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'subs_name' => ['required', 'string', 'max:255'],
    		'address' => ['required', 'string', 'max:500'],
    		'city' => ['required', 'string', 'max:255'],
        ]);

        $sub = Subsidiary::find($id);
        $dateTime = Carbon::now('Europe/Kiev');

        $sub->update([
            'name' => $request->input('subs_name'),
    		'adress' => $request->input('address'),
    		'city' => $request->input('city'),
          	'updated_at' => $dateTime
        ]);

        $name = $sub->name;
        $log = new Event_log();
        $log->log($name, $id, 'обновил филиал');

        // return redirect('/dashboard/subsidiary');
        echo "<script>window.close()</script>";
    }

    public function destroy($id)
    {

    	$delSub = Subsidiary::find($id);

    	$log = new Event_log();
    	$log->log($delSub->name, $id, 'удалил филиал');

    	Subsidiary::find($id)->delete();

    	return redirect('/dashboard/subsidiary');
    }
}
