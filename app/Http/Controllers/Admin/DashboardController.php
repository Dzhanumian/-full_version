<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('teacher');
    }
	
    public function index()
    {	
    	$quotes = [
    		'0' => 'Кого боги хотят покарать, того они делают педагогом. Луций Анней Сенека (младший)',
    		'1' => 'От врачей и учителей требуют чуда, а если чудо свершится, никто не удивляется. Мария фон Эбнер-Эшенбах',
    		'2' => 'Учитель должен обладать максимальным авторитетом и минимальной властью. Томас Сас',
    		'3' => 'Те, у которых мы учимся, правильно называются нашими учителями, но не всякий, кто учит нас, заслуживает это имя. Иоганн Вольфганг Гёте',
    		'4' => 'Кто постигает новое, лелея старое, тот может быть учителем. Конфуций',
    		'5' => 'Соберите всех великих учителей вместе в одной комнате, и они будут согласны во всём друг с другом. Соберите вместе их учеников, и они во всём будут спорить друг с другом. Брюс Ли',
    		'6' => 'Для того чтобы обучить другого, требуется больше ума, чем для того чтобы научиться самому. Мишель де Монтень',
    		'7' => 'Учитель - человек, который может делать трудные вещи легкими. Ральф Эмерсон',
    		'8' => 'Задавая домашнее задание, учителя метят в учеников, а попадают в родителей. Жорж Сименон',
    		'9' => 'Существует только два типа учителей: те, кто учит слишком многому, и те, кто не учит вообще. Сэмюэл Батлер',
    		'10' => 'Мы не выносим людей с теми же недостатками, что и у нас. Оскар Уайльд',
    		'11' => 'Учитель, могущий наделить своих воспитанников способностью находить радость в труде, должен быть увенчан лаврами. Хаббард Э.',
    		'12' => 'Учитель должен быть артист, художник, горячо влюблённый в своё дело. Антон Павлович Чехов',
    		'13' => 'Учитель, если он честен, всегда должен быть внимательным учеником. Максим Горький',
    		'14' => 'Обучать — значит вдвойне учиться. Детям нужны не поучения, а примеры. Жозеф Жубер',
    		'15' => 'Что переварили учителя, тем питаются ученики. Карл Краус',
    		'16' => 'Если вы владеете знанием, дайте другим зажечь от него свои светильники. Томас Фуллер',
    		'17' => 'Быстрее и лучше всего учишься, когда учишь других. Роза Люксембург',
    		'18' => 'Самая большая радость для учителя, когда похвалят его ученика. Шарлотта Бронте',
    		'19' => 'Кто в учениках не бывал, тот учителем не будет. Боэций Дакийский',
    		'20' => 'Тот учитель хорош, чьи слова не расходятся с делом. Катон Старший',
    		'21' => 'Учитель — человек с юмором. Представьте учителя без юмора и поймёте, что долго он не протянет, а если и протянет, то, к сожалению, ноги. Александр Рыжиков',
    		'22' => 'Учитель, который не начинает с того, чтобы пробудить у ученика желание учиться, куёт холодное железо. Хорас Манн',
    		'23' => 'Учитель должен обращаться не столько к памяти учащихся, сколько к их разуму, добиваться понимания, а не одного запоминания. Фёдор Иванович Янкович де Мариево',
    		'24' => 'Роль педагога состоит в том, чтобы открывать двери, а не в том, чтобы проталкивать в них ученика. Артур Шнабель',
    		'25' => 'Из уроков некоторых педагогов мы извлекаем лишь умение сидеть прямо. Владислав Катажиньский',
    		'26' => 'Ничто так прочно не запоминают ученики, как ошибки своих учителей. Антон Лигов',
    		'26' => 'Не ноша тянет вас вниз, а то, как вы ее несете. Лу Хольц',
    		'27' => 'Нет ничего невозможного. Само слово говорит: (Я возможно!) (Impossible — I`m possible). Одри Хепбёрнэ',
    		'28' => 'Успех — это способность терпеть поражение за поражением без потери энтузиазма. Уинстон Черчилль',
    		'30' => 'Не позволяйте дню вчерашнему отнять слишком много у дня сегодняшнего. Уилл Роджерс',
    		'31' => 'Когда человеку семнадцать, он знает все. Если ему двадцать семь и он по-прежнему знает все - значит, ему все еще семнадцать. Рэй Брэдбери',
    		'32' => 'We do not remember days, we remember moments.',
    		'33' => 'Never say never',
    		'34' => 'World belongs to the patient..',
    		'35' => 'Everyone sees the world in one`s own way.',
    		'36' => 'Everyone is the creator of one`s own fate.',
    		'37' => 'Every solution breeds new problems.',
    		'38' => 'A day without laughter is a day wasted.',
    		'39' => 'I can resist anything except temptation.',
    		'40' => 'Everyone is the creator of one`s own fate.',
    		'41' => 'Live without regrets.',
    		'42' => 'Follow your heart.',
    		'43' => 'My life - my rules',
    		'44' => 'Be yourself',
    		'45' => 'Lost time is never found again.',
    		'46' => 'God never makes errors.',
    		'47' => 'Respect the past, create the future!',
    		'48' => 'Success doesn`t come to you…you go to it.',
    		'49' => 'Life is beautiful.',
    		'50' => 'Not to know is bad, not to wish to know is worth.',
    		'51' => 'Tolerance is more powerful than force.',
    		'53' => 'Success is the child of audacity. Benjamin Disraeli',
    		'54' => 'You miss 100% of the shots you don’t take. Wayne Gretzky',
    		'55' => 'It is not the strongest of the species that survives, nor the most intelligent, but the one most responsive to change. Charles Darwin',
    		'56' => 'Fall seven times and stand up eight. Japanese Proverb',
    		'57' => 'There are no shortcuts to any place worth going. Helen Keller',
    		'58' => 'Happiness lies in good health and a bad memory. Ingrid Bergman',
    		'59' => 'If you look at what you have in life, you’ll always have more. If you look at what you don’t have in life, you’ll never have enough. Oprah Winfrey',
    		'60' => 'The limits of my language are the limits of my world. Ludwig Wittgenstein',
    		'61' => 'Learning is a treasure that will follow its owner everywhere. Chinese Proverb',
    		'61' => 'You can never understand one language until you understand at least two. Geoffrey Willans',
    		'62' => 'You can never understand one language until you understand at least two. Geoffrey Willans',
    		'63' => 'To have another language is to possess a second soul. Charlemagne',
    		'64' => 'To have another language is to possess a second soul. Charlemagne',
    		'65' => 'Language is the blood of the soul into which thoughts run and out of which they grow',
    		'66' => 'Knowledge is power. Sir Francis Bacon',
    		'67' => 'Learning is a gift. Even when pain is your teacher. Maya Watson',
    		'68' => 'Never make fun of someone who speaks broken English. It means they know another language». H. Jackson Brown, Jr.',
    		'69' => 'Live as if you were to die tomorrow. Learn as if you were to live forever. Mahatma Gandhi',
    		'70' => 'Live as if you were to die tomorrow. Learn as if you were to live forever. Mahatma Gandhi',
    		'71' => 'Have no fear of perfection; you’ll never reach it. Salvador Dali',
    		'72' => 'If a book about failures doesn’t sell, is it a success?. Jerry Seinfeld',
    	];
    	$rand = array_rand($quotes, 1);
    	$quote = $quotes[$rand];
        return view('admin.DashBoard', compact('quote'));
    }
}
