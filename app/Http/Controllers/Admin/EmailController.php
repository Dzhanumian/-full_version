<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Event_log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_owner');
    }
    
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.passw_log.editEmail', ['user'=>$user]);
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'max:500']
        ]);

        $user = User::find($id);

        $user->update([
            'email' => $request->input('email'),
        ]);

        $name = $user->name;
        $log = new Event_log();
        $log->log($name, $id, 'обновил эл адрес');

        // return redirect('/dashboard/users');
        echo "<script>window.close()</script>";
    }
}

