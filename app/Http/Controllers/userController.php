<?php

namespace App\Http\Controllers;

use App\Exports\load;
use App\Exports\Finance_execl;
use Maatwebsite\Excel\Facades\Excel;

use App\execl_date;
use App\User;
use App\Group;
use App\Event_log;
use App\Lesson;
use App\Group_students;
use App\Lesson_students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class userController extends Controller
{

    public function index()
    {   
        $role = Auth::user()->role;

        if ($role == 'owner'){
            return view('admin.users.index', 
            [
                'users' => User::orderBy('created_at', 'asc')->paginate(15)
            ]);
        }else{

            return view('admin.users.index', 
            [
                'users' => User::where('role', '!=', 'owner')->orderBy('created_at', 'asc')->paginate(15)
            ]);
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', ['user'=>$user]);
    }



    protected $allslots=array('admin', 'teacher', 'owner', 'dismissed');
    protected $allslotss=array('admin', 'teacher', 'dismissed');
    


    public function update(Request $request, $id)
    {   
        if (Auth::user()->role == 'owner') {
            $this->validate($request, [
                'surname' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'patronymic'=> ['max:255'],
                'phone_number'=> ['required', 'numeric'],
                //'email' => ['required', 'string', 'email', 'max:500'],
                // 'password' => ['required', 'string', 'min:10', 'confirmed'],
                'role' => 'required|in:' . implode(',', $this->allslots),
                'teaches' => ['required', 'string', 'max:10'],
                'level_and_language'=> ['required', 'string', 'max:500'],
                'comment' => ['max:1000'],
                'date_of_birth' => ['date', 'size:10'],
                'employment_date' => ['date', 'size:10'],
            ]);
        }
        if (Auth::user()->role == 'admin') {
            $this->validate($request, [
                'surname' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'patronymic'=> ['max:255'],
                'phone_number'=> ['required', 'numeric'],
                //'email' => ['required', 'string', 'email', 'max:500'],
                // 'password' => ['required', 'string', 'min:10', 'confirmed'],
                'role' => 'required|in:' . implode(',', $this->allslotss),
                'teaches' => ['required', 'string', 'max:10'],
                'level_and_language'=> ['required', 'string', 'max:500'],
                'comment' => ['max:1000'],
                'date_of_birth' => ['date', 'size:10'],
                'employment_date' => ['date', 'size:10'],
            ]);
        }

        $user = User::find($id);
        $new_password = $request->input('password');
        $dateTime = Carbon::now('Europe/Kiev');


        $user->update([
            //'password' => Hash::make($new_password),
            // 'email' => $request->input('email'),
            'surname' => $request->input('surname'),
            'name' => $request->input('name'),
            'patronymic' => $request->input('patronymic'),
            'level_and_language' => $request->input('level_and_language'),
            'role' => $request->input('role'),
            'teaches' =>$request->input('teaches'),
            'comment' => $request->input('comment'),
            'phone_number' => $request->input('phone_number'),
            'date_of_birth' => $request->input('date_of_birth'),
            'employment_date' => $request->input('employment_date'),
            'date_of_dismissal' => $request->input('date_of_dismissal'),
            'updated_at' => $dateTime
        ]);

        $log = new Event_log();
        $log->log($request->input('name'), $id, 'обновил');
        
        return redirect('/dashboard/users');
    }


    public function destroy($id)
    {

        $delUsers = User::find($id);

        $log = new Event_log();
        $log->log($delUsers->name, $id, 'удалил');

        User::find($id)->delete();

        return redirect('/dashboard/users');
    }

    public function excel(Request $request){
        
        //dd($request);
        $execl_date = execl_date::find(1);

        $execl_date->update([
            'date_from' => $request->input('from'),
            'date_befor' => $request->input('before')
        ]);
        if($request->input('finance') != 'true')
        {
            return Excel::download(new load(), 'student.xlsx');
        }
        return Excel::download(new Finance_execl(), 'student.xlsx');
    }
}