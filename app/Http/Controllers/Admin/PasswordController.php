<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Event_log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{   
    public function __construct()
    {
        $this->middleware('admin_owner');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.passw_log.edit', ['user'=>$user]);
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'password' => ['required', 'min:1']
        ]);

        $user = User::find($id);
        $new_password = $request->input('password');

        $user->update([
            'password' => Hash::make($new_password),
        ]);

        $name = $user->name;
        $log = new Event_log();
        $log->log($name, $id, 'обновил пароль');

        // return redirect('/dashboard/users');
        echo "<script>window.close()</script>";
    }
}

