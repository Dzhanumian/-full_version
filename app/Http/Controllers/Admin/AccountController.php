<?php

namespace App\Http\Controllers\Admin;

use App\Account;
use App\Student;
use App\Event_log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_owner');
    }

    public function edit($id)
    {
        $Account = Account::find($id);
        return view('admin.account.edit', compact('Account'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'balans' => ['required', 'numeric']
        ]);

        $account = Account::find($id);
        $dateTime = Carbon::now('Europe/Kiev');

        $account->update([
            'account' => $request->input('balans'),
            'updated_at' => $dateTime,
        ]);

        $stud = Student::find($id);
        $name = $stud->surname.' '.$stud->name;
        $log = new Event_log();
        $log->log($name, $id, 'обновил баланс');

        echo '<script>window.close()</script>';
        //return redirect('/dashboard/students');
    }

}
