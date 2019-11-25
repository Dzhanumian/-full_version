<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Lesson;
use App\Finance;
use App\Account;
use App\Student;
use App\Event_log;
use App\Group_students;
use App\Lesson_students;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FinanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_owner');
    }

    public function index()
    {
        return view('admin.finance.index', 
        [
          'finance' => Finance::orderBy('created_at', 'asc')->paginate(1000)
        ]);
    }

    public function create() //используется как index для конкретного пользователя
    {   
        return view('admin.finance.create', 
        [
          'student' => Student::where('status', 'Активный')->orderBy('created_at', 'asc')->paginate(100)
        ]);
    }

    public function show($id) //Используется как create
    {   

        $student = Student::find($id);  
        $group_s = Group_students::all()->where('student_id', $id)->where('status_s', 'учится');


        $arr_group = [];

        $next_month = date("Y-m-01", strtotime("+1 month"));    
        $lesson_next_month = Finance::all()
            ->where('month', $next_month)
            ->where('student_id', $id);


        $this_month = date('Y-m-01');   
        $lesson = Finance::all()
            ->where('month', $this_month)
            ->where('student_id', $id);


        foreach ($group_s as $key) {
            $group = Group::find($key->group_id);
            $arr_group[] = $group->id;
            $arr_group[] = $group->group_name;
            $arr_group[] = $group->rate;

            $this_mont = $lesson->where('group_id', $group->id)->count();
            $next_month1 = $lesson_next_month->where('group_id', $group->id)->count();

            if ($this_mont !=0) {
                $this_m = "#ADFF2F";
            }
            else{
                $this_m = "#FFD700";
            }
            if ($next_month1 !=0) {
                $next_m = "#ADFF2F";
            }
            else{
                $next_m = "#FFD700";
            }
            $next_m;

            $arr_group[] = $this_m;
            $arr_group[] = $next_m;
        }
        
        $arr_with = count($arr_group);
        $arr_with = $arr_with / 5;
        array_unshift($arr_group, $arr_with);

        return view('admin.finance.show', compact('id', 'arr_group'));
    }

    public function invoice($stud_id, $group_id){

        $dateTime = Carbon::now('Europe/Kiev');

        $last_accounts = Finance::where('student_id', $stud_id)->orderBy('id', 'desc')->take(5)->get();
        $Group = Group::find($group_id);
        $Student = Student::find($stud_id);
        $Account = Account::find($stud_id);


        $group_tarif = $Group->rate;
        $balans = $Account->account;

        $to_day = substr($dateTime, 0, 10);

        if ($Group->type == 'Индивидуальная') {

            // $recommended = $group_tarif - $balans;
            // return view('admin.finance.receipt', compact('last_accounts', 'Group', 'Student', 'Account', 'recommended'));


            $last_account = Finance::where('student_id', $stud_id)
                                    ->where('group_id', $group_id)
                                    ->orderBy('id', 'desc')
                                    ->take(1)
                                    ->get(); // последняя оплата для этой группы

            foreach ($last_account as $k) {
                $k->quantity;
                $month = $k->month;
                $type_check = $k->type;
            }
            $controll = isset($month);
            if ($controll == false || $type_check == 'Подарок') {
                
                return view('admin.finance.finance_type2_2', compact( 
                    'Group', 
                    'Student', 
                    'Account',
                    'last_accounts'
                ));
            }else
            {
                $month = strtotime($month);

                $from = date("Y-m-01", $month); 
                $var = date('Y-m', $month);     
                $last_day = date("t", $month);  
                $before = $var.'-'.$last_day;   

                $lessons = Lesson::all()
                    ->where('lesson_date', '>=', $from)
                    ->where('lesson_date', '<=', $before)
                    ->where('group_id', $group_id);   
                
                $paid_lesson = $lessons
                    ->where('type', '!=', 'Тестирование')
                    ->where('type', '!=', 'Пробное занятие')
                    ->where('type', '!=', 'Отработка');

                $visited_les = $paid_lesson->where('status', 'Проведён')->count();// прис на опл уроках
                $all_les = $lessons->count(); // всего уроков 
                $all_pai = $paid_lesson->count(); // оплачеваемых уроков

                // ещё не состоявщихся опл уроков
                $not_yet = $lessons
                    ->where('lesson_date', '>=', $to_day)
                    ->where('type', '!=', 'Тестирование')
                    ->where('type', '!=', 'Пробное занятие')
                    ->where('type', '!=', 'Отработка')
                    ->where('status', '!=', 'Проведён')->count();
                    

                foreach ($last_account as $k) {
                    $invoice = $k->invoice;
                    $quantity = $k->quantity;
                    $tarif = $k->tarif;
                }

                // $no_visit = $all_pai - $visited_les;
                // $res = $quantity - $all_pai + $no_visit;
                // $res = $res * $tarif;

                $res = (-1 *( $all_pai -($all_pai - $visited_les)- $quantity))* $tarif;

                return view('admin.finance.finance_type2', compact(
                    'last_accounts', 
                    'Group', 
                    'Student', 
                    'Account',
                    'visited_les',
                    'last_account',
                    'all_les',
                    'all_pai',
                    'res',
                    'tarif',
                    'not_yet'
                ));
            }
        }else{ //->count();

            $recommended = $group_tarif - $balans;
            return view('admin.finance.receipt', compact('last_accounts', 
                'Group', 
                'Student', 
                'Account', 
                'recommended'
            ));
        }
    }

    public function store(Request $request)
    {   
        //return redirect()->back()->with('failure', ["Группу $delSub->group_name нельзя удалить"]);

        $dateTime = Carbon::now('Europe/Kiev');
        $stud_id = $request->input('stud_id');
        $Account = Account::find($stud_id);
        $group = Group::find($request->input('group_id'));
        $date = strtotime($request->input('account_date'));
        $account_date = date('Y-m-01', $date);

        $stud = Student::find($request->input('stud_id'));
        $initials = $stud->surname.' '.$stud->name; 
        $Finance = new Finance();
        $log = new Event_log();

        $Finance_check = Finance::all()
                        ->where('student_id', $request->input('stud_id'))
                        ->where('group_id', $request->input('group_id'))
                        ->where('month', $account_date);

        if(count($Finance_check) != 0){
            return redirect()->back()->with('failure', ["Уже есть оплата за этот месяц для этой группы"]);
        }   

        if ($request->input('type_rec') == 'type1') {

            $account = Account::find($request->input('stud_id'));

            $group_tarif = $request->input('tarif');
            $balans = $Account->account;
            $new_balans = $balans + $request->input('account');
            $resalte = $new_balans - $group_tarif;


            if ($request->input('payment_type') == 'В долг'){

                $Finance->add(
                    $request->input('stud_id'), 
                    $request->input('group_id'),
                    $group->group_name,
                    $request->input('account'), 
                    $request->input('comment'),
                    $account_date,
                    null,
                    $request->input('tarif'),
                    $balans,
                    $initials,
                    $request->input('payment_type'),
                    0
                );
                $log->log($request->input('stud_name'), $request->input('stud_id'), 'выставил счёт в долг');
                return redirect('dashboard/finance/'.$request->input('stud_id'));
            }


            if ($request->input('payment_type') == 'Подарок'){

                $Finance->add(
                    $request->input('stud_id'), 
                    $request->input('group_id'),
                    $group->group_name,
                    $request->input('account'), 
                    $request->input('comment'),
                    $account_date,
                    null,
                    $request->input('tarif'),
                    $resalte,
                    $initials,
                    $request->input('payment_type'),
                    2
                );
                $log->log($request->input('stud_name'), $request->input('stud_id'), 'выставил подарочный счёт');
                return redirect('dashboard/finance/'.$request->input('stud_id'));
            }


            $Finance->add(
                $request->input('stud_id'), 
                $request->input('group_id'),
                $group->group_name,
                $request->input('account'), 
                $request->input('comment'),
                $account_date,
                null,
                $request->input('tarif'),
                $resalte,
                $initials,
                $request->input('payment_type'),
                2
            );

            $stud_gr = Account::find($request->input('stud_id'));
            $stud_gr->update([

                'account' => $resalte, 
                'updated_at' => $dateTime, 
            ]); 

            $log->log($request->input('stud_name'), $request->input('stud_id'), 'выставил счёт');

            return redirect('dashboard/finance/'.$request->input('stud_id'));   
        }


        if ($request->input('type_rec') == 'type2') {
            ////////////////////////// balans
            $old_balans = $Account->account;
            $saldo = $request->input('balance');
            $new_balans = $old_balans + $saldo;
            /////////////////////////payment
            $account = $request->input('account');
            $how_many = $request->input('how_many');
            $tarif = $request->input('tarif');
            ////////////////////////new_balance
            $res = ($account - ($how_many * $tarif)) + $new_balans;

            if ($request->input('payment_type') == 'В долг'){

                $Finance->add(
                    $request->input('stud_id'), 
                    $request->input('group_id'),
                    $group->group_name,
                    $request->input('account'), 
                    $request->input('comment'),
                    $account_date,
                    $request->input('how_many'),
                    $request->input('tarif'),
                    $old_balans,
                    $initials,
                    $request->input('payment_type'),
                    0
                );
                $log->log($request->input('stud_name'), $request->input('stud_id'), 'выставил счёт в долг');
                return redirect('dashboard/finance/'.$request->input('stud_id'));
            }

            if ($request->input('payment_type') == 'Подарок'){

                $Finance->add(
                    $request->input('stud_id'), 
                    $request->input('group_id'),
                    $group->group_name,
                    $request->input('account'), 
                    $request->input('comment'),
                    $account_date,
                    $request->input('how_many'),
                    $request->input('tarif'),
                    $res,
                    $initials,
                    $request->input('payment_type'),
                    2
                );
                $log->log($request->input('stud_name'), $request->input('stud_id'), 'выставил подарочный счёт');
                return redirect('dashboard/finance/'.$request->input('stud_id'));
            }            

            $Finance->add(
                $request->input('stud_id'), 
                $request->input('group_id'),
                $group->group_name,
                $request->input('account'), 
                $request->input('comment'),
                $account_date,
                $request->input('how_many'),
                $request->input('tarif'),
                $res,
                $initials,
                $request->input('payment_type'),
                2
            );  

            $stud_gr = Account::find($request->input('stud_id'));
            $stud_gr->update([

                'account' => $res, 
                'updated_at' => $dateTime, 
            ]); 
        
           $log->log($request->input('stud_name'), $request->input('stud_id'), 'выставил счёт');
        }
        //bd status = 0 дол, 1 выплаченый долг ,2 оплата
        return redirect('dashboard/finance/'.$request->input('stud_id'));
    }

    public function edit($id)
    {
        $finance = Finance::find($id);
        $id_gr = $finance->group_id;
        $group = Group::find($id_gr);

        $group_type = $group->type; 

        if($group_type == 'Индивидуальная'){
            return view('admin.finance.edit', compact('finance'));
        }else{
            return view('admin.finance.edit_st', compact('finance'));
        }
    }

    public function update(Request $request, $id)
    {   
        $dateTime = Carbon::now('Europe/Kiev');

        $finance = Finance::find($id);

        $finance->update([
            'month' => $request->input('account_date'),
            'invoice' => $request->input('account'), 
            'quantity' => $request->input('how_many'), 
            'tarif' => $request->input('tarif'),
            'type' => $request->input('payment_type'),
            'comment' => $request->input('comment'),
            'updated_at' => $dateTime
        ]);

        $log = new Event_log();
        $log->log('Чек №'.$id, $id, 'обновил');
        
        echo '<script>window.close()</script>';
        //return redirect('/dashboard/finance');
    }

    public function destroy($id)
    {
        $delSub = Finance::find($id);

        $log = new Event_log();
        $log->log('Чек №'.$id, $id, 'удалил');

        Finance::find($id)->delete();

        return redirect()->back();
    }

    public function debt_pay($id)
    {   
        $debt = Finance::find($id);
        $stud_id = $debt->student_id;
        $group_id = $debt->group_id;

        $dateTime = Carbon::now('Europe/Kiev');

        $last_accounts = Finance::where('student_id', $stud_id)->orderBy('id', 'desc')->take(5)->get();
        $Group = Group::find($group_id);
        $Student = Student::find($stud_id);
        $Account = Account::find($stud_id);


        $group_tarif = $Group->rate;
        $balans = $Account->account;

        $to_day = substr($dateTime, 0, 10);
        $ind_1 = 0;
        $ind_2 = 0;
        $stand = 0;

        if ($Group->type == 'Индивидуальная') {

            // $recommended = $group_tarif - $balans;
            // return view('admin.finance.receipt', compact('last_accounts', 'Group', 'Student', 'Account', 'recommended'));


            $last_account = Finance::where('student_id', $stud_id)
                                    ->where('group_id', $group_id)
                                    ->where('status', '!=', 0)
                                    ->orderBy('id', 'desc')
                                    ->take(1)
                                    ->get(); // последняя оплата для этой группы

            foreach ($last_account as $k) {
                $k->quantity;
                $month = $k->month;
                $type_check = $k->type;
            }
            $controll = isset($month);
            if ($controll == false || $type_check == 'Подарок') {
                
                $ind_1 = 1;
                return view('admin.finance.debt_pay', compact( 
                    'Group', 
                    'Student', 
                    'Account',
                    'last_accounts',
                    'debt',
                    'ind_1',
                    'ind_2',
                    'stand'

                ));
            }else
            {
                $month = strtotime($month);

                $from = date("Y-m-01", $month); 
                $var = date('Y-m', $month);     
                $last_day = date("t", $month);  
                $before = $var.'-'.$last_day;   

                $lessons = Lesson::all()
                    ->where('lesson_date', '>=', $from)
                    ->where('lesson_date', '<=', $before)
                    ->where('group_id', $group_id);   
                
                $paid_lesson = $lessons
                    ->where('type', '!=', 'Тестирование')
                    ->where('type', '!=', 'Пробное занятие')
                    ->where('type', '!=', 'Отработка');

                $visited_les = $paid_lesson->where('status', 'Проведён')->count();// прис на опл уроках
                $all_les = $lessons->count(); // всего уроков 
                $all_pai = $paid_lesson->count(); // оплачеваемых уроков

                // ещё не состоявщихся опл уроков
                $not_yet = $lessons
                    ->where('lesson_date', '>=', $to_day)
                    ->where('type', '!=', 'Тестирование')
                    ->where('type', '!=', 'Пробное занятие')
                    ->where('type', '!=', 'Отработка')
                    ->where('status', '!=', 'Проведён')->count();
                    

                foreach ($last_account as $k) {
                    $invoice = $k->invoice;
                    $quantity = $k->quantity;
                    $tarif = $k->tarif;
                }

                // $no_visit = $all_pai - $visited_les;
                // $res = $quantity - $all_pai + $no_visit;
                // $res = $res * $tarif;

                $res = (-1 *( $all_pai -($all_pai - $visited_les)- $quantity))* $tarif;
                $ind_2 = 1;
                return view('admin.finance.debt_pay', compact(
                    'last_accounts', 
                    'Group', 
                    'Student', 
                    'Account',
                    'visited_les',
                    'last_account',
                    'all_les',
                    'all_pai',
                    'res',
                    'tarif',
                    'not_yet',
                    'debt',
                    'ind_1',
                    'ind_2',
                    'stand'
                ));
            }
        }else{ //->count();
            
            $stand = 1;
            $recommended = $group_tarif - $balans;
            return view('admin.finance.debt_pay', compact(
                'last_accounts', 
                'Group', 
                'Student', 
                'Account', 
                'recommended',
                'debt',
                'ind_1',
                'ind_2',
                'stand'
            ));
        }

        // echo '<script>window.close()</script>';
    }

    public function debt_store(Request $request)
    {   
        $Group = Group::find($request->id);
        if($Group->type == 'Индивидуальная') 
        {
            ////////////////////////// balans
            $Account = Account::find($request->input('stud_id'));
            $old_balans = $Account->account;
            $saldo = $request->input('balance');
            $new_balans = $old_balans + $saldo;
            /////////////////////////payment
            $account = $request->input('account');
            $how_many = $request->input('how_many');
            $tarif = $request->input('tarif');
            ////////////////////////new_balance
            $res = ($account - ($how_many * $tarif)) + $new_balans;


            $finance = Finance::find($request->id);
            $dateTime = Carbon::now('Europe/Kiev');

            $finance->update([
                'invoice' => $request->input('account'), 
                'quantity' => $request->input('how_many'), 
                'tarif' => $request->input('tarif'),
                'comment' => $request->input('comment'),
                'balance' => $res,
                'status' => 1,
                'updated_at' => $dateTime
            ]);

            $stud_gr = Account::find($request->input('stud_id'));
            $stud_gr->update([
                'account' => $res, 
                'updated_at' => $dateTime, 
            ]);

            $stud = Student::find($request->input('stud_id'));
            $stud->update([
                'payouts' => null, 
            ]);

            $log = new Event_log();
            $log->log('Счёт №'.$request->id, $request->id, 'закрыл долг');
            echo '<script>window.close()</script>';
        }else{
            $finance = Finance::find($request->id);
            $dateTime = Carbon::now('Europe/Kiev');

            $Account = Account::find($request->input('stud_id'));

            $group_tarif = $request->input('tarif');
            $balans = $Account->account;
            $new_balans = $balans + $request->input('account');
            $resalte = $new_balans - $group_tarif;


            $finance->update([
                'invoice' => $request->input('account'), 
                'quantity' => $request->input('how_many'), 
                'tarif' => $request->input('tarif'),
                'comment' => $request->input('comment'),
                'status' => 1,
                'updated_at' => $dateTime
            ]);


            $stud = Student::find($request->input('stud_id'));
            $stud->update([
                'payouts' => null, 
            ]);


            $log = new Event_log();
            $log->log('Счёт №'.$request->id, $request->id, 'закрыл долг');

            echo '<script>window.close()</script>';
        }
        //dd($request);
    }
}
