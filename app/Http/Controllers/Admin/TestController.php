<?php

namespace App\Http\Controllers\Admin;

use App\Test;
use App\Student;
use App\Event_log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TestController extends Controller
{	

    public function index($id)
    {	$test1 = Test::all()->where('student_id', $id)->where('test_id', '1')->first();
   		$test2 = Test::all()->where('student_id', $id)->where('test_id', '2')->first();
		
		if ($test1 == null) {
			$test_1 = '#A9A9A9';
			$url_1 = '/test/'.$id.'/1';
		}else{
			$test_1 = '#32CD32';
			$url_1 = null;
		}

		if ($test2 == null) {
			$test_2 = '#A9A9A9';
			$url_2 = '/test/'.$id.'/2';
		}else{
			$test_2 = '#32CD32';
			$url_2 = null;
		}

        $Test1 = Test::all()->where('student_id', $id)->where('test_id', 1)->first();
        $Test2 = Test::all()->where('student_id', $id)->where('test_id', 2)->first();

    	return view('test.index', compact('test_1', 'test_2', 'url_1', 'url_2','Test1','Test2'));
    }


    public function test_first($id)
    {

    	$stud = Student::all()->where('id', $id)->first();

    	if (isset($stud) == null) {
    		return redirect()->back(); 
    	}else{

    		$tust1 = Test::all()->where('student_id', $id)->where('test_id', 1)->first();

    		if (isset($tust1) == null){
    			return view('test.first_test', compact('id'));
    		}else{
    			return redirect()->back();
    		}
    	}
    }


    public function test_second($id)
    {

        $stud = Student::all()->where('id', $id)->first();

        if (isset($stud) == null) {
            return redirect()->back(); 
        }else{

            $tust1 = Test::all()->where('student_id', $id)->where('test_id', 2)->first();

            if (isset($tust1) == null){
                return view('test.second_test', compact('id'));
            }else{
                return redirect()->back();
            }
        }
    }


    public function store_1(Request $request)
    {   
        $this->validate($request, [
            'question1'  => ['required', 'string', 'max:260'],
            'question2'  => ['required', 'string', 'max:255'],
            'question3'  => ['required', 'string', 'max:255'],
            'question4'  => ['required', 'string', 'max:230'],
            'question5'  => ['required', 'string', 'max:255'],
            'question6'  => ['required', 'string', 'max:255'],
            'question7'  => ['required', 'string', 'max:255'],
            'question8'  => ['required', 'string', 'max:255'],
            'question9'  => ['required', 'string', 'max:255'],
            'question10' => ['required', 'string', 'max:255'],

            'question11' => ['required', 'string', 'max:255'],
            'question12' => ['required', 'string', 'max:255'],
            'question13' => ['required', 'string', 'max:255'],
            'question14' => ['required', 'string', 'max:233'],
            'question15' => ['required', 'string', 'max:255'],
            'question16' => ['required', 'string', 'max:244'],
            'question17' => ['required', 'string', 'max:255'],
            'question18' => ['required', 'string', 'max:255'],
            'question19' => ['required', 'string', 'max:255'],
            'question20' => ['required', 'string', 'max:255'],

            'question21' => ['required', 'string', 'max:255'],
            'question22' => ['required', 'string', 'max:255'],
            'question23' => ['required', 'string', 'max:255'],
            'question24' => ['required', 'string', 'max:255'],
            'question25' => ['required', 'string', 'max:255'],
            'question26' => ['required', 'string', 'max:255'],
            'question27' => ['required', 'string', 'max:255'],
            'question28' => ['required', 'string', 'max:255'],
            'question29' => ['required', 'string', 'max:255'],
            'question30' => ['required', 'string', 'max:255'],

            'question31' => ['required', 'string', 'max:255'],
            'question32' => ['required', 'string', 'max:255'],
            'question33' => ['required', 'string', 'max:255'],
            'question34' => ['required', 'string', 'max:277'],
            'question35' => ['required', 'string', 'max:251'],
            'question36' => ['required', 'string', 'max:255'],
            'question37' => ['required', 'string', 'max:255'],
            'question38' => ['required', 'string', 'max:255'],
            'question39' => ['required', 'string', 'max:255'],
            'question40' => ['required', 'string', 'max:255'],

            'question41' => ['required', 'string', 'max:230'],
            'question42' => ['required', 'string', 'max:255'],
            'question43' => ['required', 'string', 'max:252'],
            'question44' => ['required', 'string', 'max:255'],
            'question45' => ['required', 'string', 'max:255'],
            'question46' => ['required', 'string', 'max:255'],
            'question47' => ['required', 'string', 'max:249'],
            'question48' => ['required', 'string', 'max:255'],
            'question49' => ['required', 'string', 'max:255'],
            'question50' => ['required', 'string', 'max:255']
        ]);

        $keys = [
            '1' => 'c', '2' => 'b', '3' => 'c', '4' => 'b', '5' => 'c',
            '6' => 'c', '7' => 'a', '8' => 'a', '9' => 'b', '10' => 'c',
            
            '11' => 'b', '12' => 'c', '13' => 'a', '14' => 'a', '15' => 'b',
            '16' => 'c', '17' => 'c', '18' => 'a', '19' => 'b', '20' => 'a',

            '21' => 'c', '22' => 'c', '23' => 'a', '24' => 'c', '25' => 'a',
            '26' => 'b', '27' => 'c', '28' => 'c', '29' => 'c', '30' => 'a',

            '31' => 'b', '32' => 'b', '33' => 'c', '34' => 'a', '35' => 'c',
            '36' => 'b', '37' => 'b', '38' => 'c', '39' => 'c', '40' => 'a',

            '41' => 'c', '42' => 'c', '43' => 'a', '44' => 'c', '45' => 'c',
            '46' => 'a', '47' => 'c', '48' => 'c', '49' => 'b', '50' => 'c'
        ];

        $correct_answers = [];
        $answers =[];
        for ($i=1; $i < 51; $i++) {
            $key = $request->input("question".$i);
            if ($key === $keys[$i]){
                $correct_answers[] = $i;
                $answers[] = [$i => 1];
            }
            if ($key != $keys[$i]){
                $answers[] = [$i => 0];
            }
        }
        $evaluation = count($correct_answers);

        $id = $request->input("id_s");

        $Test = new Test();
        $Test->add($id, '1', $evaluation);


        $log = new Event_log();
        $Stud = Student::find($request->input('id_s'));
        $log->test($Stud->surname.' '.$Stud->name, $request->input('id_s'), "Прошёл тест № 1 на: $evaluation балов");

        return redirect('/test/'.$request->input("id_s"));
    }

    public function store_2(Request $request)
    {   
        $this->validate($request, [
            'question51'  => ['required', 'string', 'max:260'],
            'question52'  => ['required', 'string', 'max:255'],
            'question53'  => ['required', 'string', 'max:255'],
            'question54'  => ['required', 'string', 'max:230'],
            'question55'  => ['required', 'string', 'max:255'],
            'question56'  => ['required', 'string', 'max:255'],
            'question57'  => ['required', 'string', 'max:255'],
            'question58'  => ['required', 'string', 'max:255'],
            'question59'  => ['required', 'string', 'max:255'],
            'question60' => ['required', 'string', 'max:255'],

            'question61' => ['required', 'string', 'max:255'],
            'question62' => ['required', 'string', 'max:255'],
            'question63' => ['required', 'string', 'max:255'],
            'question64' => ['required', 'string', 'max:233'],
            'question65' => ['required', 'string', 'max:255'],
            'question66' => ['required', 'string', 'max:244'],
            'question67' => ['required', 'string', 'max:255'],
            'question68' => ['required', 'string', 'max:255'],
            'question69' => ['required', 'string', 'max:255'],
            'question70' => ['required', 'string', 'max:255'],

            'question71' => ['required', 'string', 'max:255'],
            'question72' => ['required', 'string', 'max:255'],
            'question73' => ['required', 'string', 'max:255'],
            'question74' => ['required', 'string', 'max:255'],
            'question75' => ['required', 'string', 'max:255'],
            'question76' => ['required', 'string', 'max:255'],
            'question77' => ['required', 'string', 'max:255'],
            'question78' => ['required', 'string', 'max:255'],
            'question79' => ['required', 'string', 'max:255'],
            'question80' => ['required', 'string', 'max:255'],

            'question81' => ['required', 'string', 'max:255'],
            'question82' => ['required', 'string', 'max:255'],
            'question83' => ['required', 'string', 'max:255'],
            'question84' => ['required', 'string', 'max:277'],
            'question85' => ['required', 'string', 'max:251'],
            'question86' => ['required', 'string', 'max:255'],
            'question87' => ['required', 'string', 'max:255'],
            'question88' => ['required', 'string', 'max:255'],
            'question89' => ['required', 'string', 'max:255'],
            'question90' => ['required', 'string', 'max:255'],

            'question91' => ['required', 'string', 'max:230'],
            'question92' => ['required', 'string', 'max:255'],
            'question93' => ['required', 'string', 'max:252'],
            'question94' => ['required', 'string', 'max:255'],
            'question95' => ['required', 'string', 'max:255'],
            'question96' => ['required', 'string', 'max:255'],
            'question97' => ['required', 'string', 'max:249'],
            'question98' => ['required', 'string', 'max:255'],
            'question99' => ['required', 'string', 'max:255'],
            'question100' => ['required', 'string', 'max:255']
        ]);

        $keys = [
            '51' => 'a', '52' => 'd', '53' => 'b', '54' => 'c', '55' => 'c',
            '56' => 'a', '57' => 'd', '58' => 'c', '59' => 'a', '60' => 'd',
            
            '61' => 'c', '62' => 'a', '63' => 'b', '64' => 'b', '65' => 'a',
            '66' => 'd', '67' => 'c', '68' => 'c', '69' => 'b', '70' => 'c',

            '71' => 'c', '72' => 'c', '73' => 'a', '74' => 'c', '75' => 'c',
            '76' => 'd', '77' => 'a', '78' => 'd', '79' => 'b', '80' => 'c',

            '81' => 'd', '82' => 'c', '83' => 'a', '84' => 'b', '85' => 'a',
            '86' => 'c', '87' => 'b', '88' => 'c', '89' => 'b', '90' => 'd',

            '91' => 'a', '92' => 'd', '93' => 'd', '94' => 'b', '95' => 'a',
            '96' => 'd', '97' => 'c', '98' => 'd', '99' => 'a', '100' => 'b'
        ];

        $correct_answers = [];
        $answers =[];
        for ($i=51; $i < 101; $i++) {
            $key = $request->input("question".$i);
            if ($key === $keys[$i]){
                $correct_answers[] = $i;
                $answers[] = [$i => 1];
            }
            if ($key != $keys[$i]){
                $answers[] = [$i => 0];
            }
        }
        $evaluation = count($correct_answers);

        $id = $request->input("id_s");

        $Test = new Test();
        $Test->add($id, '2', $evaluation);


        $log = new Event_log();
        $Stud = Student::find($request->input('id_s'));
        $log->test($Stud->surname.' '.$Stud->name, $request->input('id_s'), "Прошёл тест № 2 на: $evaluation балов");

        return redirect('/test/'.$request->input("id_s"));
    }
}

