<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//interface
use App\Http\Services\Finance\FinanceInterface;

/*

	На сайте необходимо реализовать два типа оплаты: стандартная и индивидуальная. Исходя из этого, я решил разделить логику на 3 сервиса:
	- FinanceServices, что реализует общие функции, такие как: отображение списка платежей,  списка активных студентов и груп, в которых состоит студент. 
	- StandardPaymentServices, что реализует создание и обновление стандартных платежей. 
	- IndividualPaymentServices, что реализует создание и обновление индивидуальных платежей платежей (данная часть ещё не реализована) Планируется реализация в рамках данного контроллера, используя два интерфейса, которые будут связаны с реализацией: 
	- Интерфейс FinanceInterface связан с FinanceServices в сервис провайдере FinanceServiceProvider.
	- Интерфейс PaymentInterface связан с StandardPaymentServices и IndividualPaymentServices в сервис провайдере FinancePaymenServiceProvider. 
	В зависимости от типа оплаты должна использоваться соответствующая реализация. Для этого, думаю использовать контекстную привязку (https://laravel.com/docs/6.x/container#contextual-binding) в провайдере FinancePaymenServiceProvider или использовать патерн делегирования.

*/

class FinanceController extends Controller
{	
	private $finance;

    public function __construct(FinanceInterface $finance)
    {
        $this->finance = $finance;
    }

    /*
		функция getAllInvoice берёт список всех палатежей
		и передаёт их во вью.
	*/
    public function showAllInvoice()
    {	
    	$allInvoice = $this->finance->allInvoice();

    	return view('finance.allInvoice', compact('allInvoice'));  
    }

    /*
		функция showPayerStudents отвечает за вывод всех студентов, с статусом "Активный"
    */
    public function showPayerStudents()
    {	
    	$allPayerStudents = $this->finance->getPayerStudents();

    	return view('finance.allPayerStudents', compact('allPayerStudents')); 
    }

    /*
		функция showStudentPaidGroup отвечает за отображение групп, в которых состоит студент,  а так же за своевременную оплату
		Не полностью реализовал
	*/
    public function showStudentPaidGroup($student_id)
    {	
    	$StudentPaidGroup = $this->finance->studentPaidGroup($student_id);

    	return $StudentPaidGroup;
    }
}
