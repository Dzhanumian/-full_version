<?php

namespace App\Http\Controllers\Auth;

use App\Rate;
use App\User;
use App\Event_log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin_owner');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected $allslots=array('admin', 'teacher', 'owner');
    protected $allslotss=array('admin', 'teacher');
    
    protected function validator(array $data)
    {   
        if (Auth::user()->role == 'owner') {
            return Validator::make($data, [
                'surname' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'patronymic'=> ['max:255'],
                'level_and_language'=> ['required', 'string', 'max:500'],
                'phone_number'=> ['required', 'numeric'],
                'email' => ['required', 'string', 'email', 'max:500', 'unique:users'],
                'password' => ['required', 'string', 'min:10', 'confirmed'],
                'role' => 'required|in:' . implode(',', $this->allslots),
                'teaches' => ['required', 'string', 'max:10'],
                'comment' => ['max:1000'],
                'date_of_birth' => ['date', 'size:10'],
                'employment_date' => ['date', 'size:10'],
            ]);
        }
        if (Auth::user()->role == 'admin') {
            return Validator::make($data, [
                'surname' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'patronymic'=> ['max:255'],
                'level_and_language'=> ['required', 'string', 'max:500'],
                'phone_number'=> ['required', 'numeric'],
                'email' => ['required', 'string', 'email', 'max:500', 'unique:users'],
                'password' => ['required', 'string', 'min:10', 'confirmed'],
                'role' => 'required|in:' . implode(',', $this->allslotss),
                'teaches' => ['required', 'string', 'max:10'],
                'comment' => ['max:1000'],
                'date_of_birth' => ['date', 'size:10'],
                'employment_date' => ['date', 'size:10'],
            ]);
        }else{ redirect()->back(); }
        
    }

    //date
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   

        $lastUserId = \DB::table('users')->max('id');

        $log = new Event_log();
        $log->log($data['name'], $lastUserId + 1, 'создал');
        $lastUserId = $lastUserId + 1;

        $Rate = new Rate();
        $Rate->add($lastUserId,'0','0','0','0','0');

        return User::create([
            'id' => $lastUserId,
            'surname' => $data['surname'],
            'name' => $data['name'],
            'patronymic' => $data['patronymic'],
            'level_and_language'=> $data['level_and_language'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'teaches' => $data['teaches'],
            'comment' => $data['comment'],
            'phone_number' => $data['phone_number'],
            'date_of_birth' => $data['date_of_birth'],
            'employment_date' => $data['employment_date']
        ]);
    }
}
