@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Part A') }}</div>


            	<form method="POST" action="{{route('test1')}}">
            		@csrf

					
					<!--------------Question_1-------------->
					<div class="question">
					    <p>1) _____ name is Robert.</p>
						<input required id="1" type="radio" value="a" name="question1">
						<label for="1">a) Me</label>
						<br>
						<input required id="2" type="radio" value="b" name="question1">
						<label for="2">b) I</label>
						<br>
						<input required id="3" type="radio" value="c" name="question1">
						<label for="3">c) My</label>
						<br>
					</div>
					<!--------------Question_2-------------->
					<div class="question">
						<p>2) They _____ from Spain.</p>
						<input required id="4" type="radio" value="a" name="question2">
						<label for="4">a) is</label>
						<br>
						<input required id="5" type="radio" value="b" name="question2">
						<label for="5">b) are</label>
						<br>
						<input required id="6" type="radio" value="c" name="question2">
						<label for="6">c) do</label>
						<br>
					</div>
					<!--------------Question_3-------------->
					<div class="question">
						<p>3) _____ are you from?.</p>
						<input required id="7" type="radio" value="a" name="question3">
						<label for="7">a) What</label>
						<br>
						<input required id="8" type="radio" value="b" name="question3">
						<label for="8">b) Who</label>
						<br>
						<input required id="9" type="radio" value="c" name="question3">
						<label for="9">c) Where</label>
						<br>
					</div>
					<!--------------Question_4-------------->
					<div class="question">
						<p>4) What do you do? I’m _____ student.</p>
						<input required id="10" type="radio" value="a" name="question4">
						<label for="10">a) the</label>
						<br>
						<input required id="11" type="radio" value="b" name="question4">
						<label for="11">b) a</label>
						<br>
						<input required id="12" type="radio" value="c" name="question4">
						<label for="12">c) the</label>
						<br>
					</div>
					<!--------------Question_5-------------->
					<div class="question">
						<p>5) Peter _____ at seven o’clock.</p>
						<input required id="13" type="radio" value="a" name="question5">
						<label for="13">a) goes up</label>
						<br>
						<input required id="14" type="radio" value="b" name="question5">
						<label for="14">b) gets</label>
						<br>
						<input required id="15" type="radio" value="c" name="question5">
						<label for="15">c) gets up</label>
						<br>
					</div>
					<!--------------Question_6-------------->
					<div class="question">
						<p>6) _____ you like this DVD?</p>
						<input required id="16" type="radio" value="a" name="question6">
						<label for="16">a) Are</label>
						<br>
						<input required id="17" type="radio" value="b" name="question6">
						<label for="17">b) Have</label>
						<br>
						<input required id="18" type="radio" value="c" name="question6">
						<label for="18">c) Do</label>
						<br>
					</div>
					<!--------------Question_7-------------->
					<div class="question">
						<p>7) We _____ live in a flat.</p>
						<input required id="19" type="radio" value="a" name="question7">
						<label for="19">a) don’t</label>
						<br>
						<input required id="20" type="radio" value="b" name="question7">
						<label for="20">b) hasn’t</label>
						<br>
						<input required id="21" type="radio" value="c" name="question7">
						<label for="21">c) doesn’t</label>
						<br>
					</div>
					<!--------------Question_8-------------->
					<div class="question">
						<p>8) Wednesday, Thursday, Friday, _____.</p>
						<input required id="22" type="radio" value="a" name="question8">
						<label for="22">a) Saturday</label>
						<br>
						<input required id="23" type="radio" value="b" name="question8">
						<label for="23">b) Tuesday</label>
						<br>
						<input required id="24" type="radio" value="c" name="question8">
						<label for="24">c) Monday</label>
						<br>
					</div>
					<!--------------Question_9-------------->
					<div class="question">
						<p>9) _____ he play tennis?</p>
						<input required id="25" type="radio" value="a" name="question9">
						<label for="25">a) Where</label>
						<br>
						<input required id="26" type="radio" value="b" name="question9">
						<label for="26">b) Does</label>
						<br>
						<input required id="27" type="radio" value="c" name="question9">
						<label for="27">c) Do</label>
						<br>
					</div>
					<!--------------Question_10-------------->
					<div class="question">
						<p>10) Have you _____ a car?</p>
						<input required id="28" type="radio" value="a" name="question10">
						<label for="28">a) any</label>
						<br>
						<input required id="29" type="radio" value="b" name="question10">
						<label for="29">b) have</label>
						<br>
						<input required id="30" type="radio" value="c" name="question10">
						<label for="30">c) got</label>
						<br>
					</div>

					<!--------------Question_11-------------->
					<div class="question">
						<p>11) We don’t have _____ butter.</p>
						<input required id="31" type="radio" value="a" name="question11">
						<label for="31">a) a</label>
						<br>
						<input required id="32" type="radio" value="b" name="question11">
						<label for="32">b) any</label>
						<br>
						<input required id="33" type="radio" value="c" name="question11">
						<label for="33">c) got</label>
						<br>
					</div>
					<!--------------Question_12-------------->
					<div class="question">
						<p>12) _____ some money here.</p>
						<input required id="34" type="radio" value="a" name="question12">
						<label for="34">a) There’re</label>
						<br>
						<input required id="35" type="radio" value="b" name="question12">
						<label for="35">b) There</label>
						<br>
						<input required id="36" type="radio" value="c" name="question12">
						<label for="36">c) There’s</label>
						<br>
					</div>
					<!--------------Question_13-------------->
					<div class="question">
						<p>13) We _____ got a garage.</p>
						<input required id="37" type="radio" value="a" name="question13">
						<label for="37">a) haven’t</label>
						<br>
						<input required id="38" type="radio" value="b" name="question13">
						<label for="38">b) hasn’t</label>
						<br>
						<input required id="39" type="radio" value="c" name="question13">
						<label for="39">c) don’t</label>
						<br>
					</div>
					<!--------------Question_14-------------->
					<div class="question">
						<p>14) Those shoes are very _____ .</p>
						<input required id="40" type="radio" value="a" name="question14">
						<label for="40">a) expensive</label>
						<br>
						<input required id="41" type="radio" value="b" name="question14">
						<label for="41">b) a lot</label>
						<br>
						<input required id="42" type="radio" value="c" name="question14">
						<label for="42">c) cost</label>
						<br>
					</div>
					<!--------------Question_15-------------->
					<div class="question">
						<p>15) Have you got a pen? Yes, I _____ .</p>
						<input required id="43" type="radio" value="a" name="question15">
						<label for="43">a) am</label>
						<br>
						<input required id="44" type="radio" value="b" name="question15">
						<label for="44">b) have</label>
						<br>
						<input required id="45" type="radio" value="c" name="question15">
						<label for="45">c) got</label>
						<br>
					</div>
					<!--------------Question_16-------------->
					<div class="question">
						<p>16) It is a busy, _____ city.</p>
						<input required id="46" type="radio" value="a" name="question16">
						<label for="46">a) traffic</label>
						<br>
						<input required id="47" type="radio" value="b" name="question16">
						<label for="47">b) quite</label>
						<br>
						<input required id="48" type="radio" value="c" name="question16">
						<label for="48">c) noisy</label>
						<br>
					</div>
					<!--------------Question_17-------------->
					<div class="question">
						<p>17) They _____ at home yesterday.</p>
						<input required id="49" type="radio" value="a" name="question17">
						<label for="49">a) was</label>
						<br>
						<input required id="50" type="radio" value="b" name="question17">
						<label for="50">b) are</label>
						<br>
						<input required id="51" type="radio" value="c" name="question17">
						<label for="51">c) were</label>
						<br>
					</div>
					<!--------------Question_18-------------->
					<div class="question">
						<p>18) I _____ there for a long time.</p>
						<input required id="52" type="radio" value="a" name="question18">
						<label for="52">a) lived</label>
						<br>
						<input required id="53" type="radio" value="b" name="question18">
						<label for="53">b) living</label>
						<br>
						<input required id="54" type="radio" value="c" name="question18">
						<label for="54">c) live</label>
						<br>
					</div>
					<!--------------Question_19-------------->
					<div class="question">
						<p>19) He didn’t _____ glasses.</p>
						<input required id="55" type="radio" value="a" name="question19">
						<label for="55">a) put</label>
						<br>
						<input required id="56" type="radio" value="b" name="question19">
						<label for="56">b) wear</label>
						<br>
						<input required id="57" type="radio" value="c" name="question19">
						<label for="57">c) take</label>
						<br>
					</div>
					<!--------------Question_20-------------->
					<div class="question">
						<p>20) The restaurant was _____ busy.</p>
						<input required id="58" type="radio" value="a" name="question20">
						<label for="58">a) very</label>
						<br>
						<input required id="59" type="radio" value="b" name="question20">
						<label for="59">b) a lot</label>
						<br>
						<input required id="60" type="radio" value="c" name="question20">
						<label for="60">c) many</label>
						<br>
					</div>
					<!--------------Question_21-------------->
					<div class="question">
						<p>21) Do you like the red _____ ?</p>
						<input required id="61" type="radio" value="a" name="question21">
						<label for="61">a) it</label>
						<br>
						<input required id="62" type="radio" value="b" name="question21">
						<label for="62">b) that</label>
						<br>
						<input required id="63" type="radio" value="c" name="question21">
						<label for="63">c) one</label>
						<br>
					</div>
					<!--------------Question_22-------------->
					<div class="question">
						<p>22) He _____ to Brazil on business.</p>
						<input required id="64" type="radio" value="a" name="question22">
						<label for="64">a) go</label>
						<br>
						<input required id="65" type="radio" value="b" name="question22">
						<label for="65">b) goed</label>
						<br>
						<input required id="66" type="radio" value="c" name="question22">
						<label for="66">c) went</label>
						<br>
					</div>
					<input type="hidden" name="id_s" value="{{ $id }}">
					<!--------------Question_23-------------->
					<div class="question">
						<p>23) Yesterday was the _____ of April.</p>
						<input required id="67" type="radio" value="a" name="question23">
						<label for="67">a) third</label>
						<br>
						<input required id="68" type="radio" value="b" name="question23">
						<label for="68">b) three</label>
						<br>
						<input required id="69" type="radio" value="c" name="question23">
						<label for="69">c) day three</label>
						<br>
					</div>
					<!--------------Question_24-------------->
					<div class="question">
						<p>24) She’s got _____ hair.</p>
						<input required id="70" type="radio" value="a" name="question24">
						<label for="70">a) dark, long</label>
						<br>
						<input required id="71" type="radio" value="b" name="question24">
						<label for="71">b) long and dark</label>
						<br>
						<input required id="72" type="radio" value="c" name="question24">
						<label for="72">c) dark, long</label>
						<br>
					</div>
					<!--------------Question_25-------------->
					<div class="question">
						<p>25) I _____ play football at the weekend.</p>
						<input required id="73" type="radio" value="a" name="question25">
						<label for="73">a) usually</label>
						<br>
						<input required id="74" type="radio" value="b" name="question25">
						<label for="74">b) use</label>
						<br>
						<input required id="75" type="radio" value="c" name="question25">
						<label for="75">c) usual</label>
						<br>
					</div>
					<!--------------Question_26-------------->
					<div class="question">
						<p>26) I _____ in an armchair at the moment.</p>
						<input required id="76" type="radio" value="a" name="question26">
						<label for="76">a) sitting</label>
						<br>
						<input required id="77" type="radio" value="b" name="question26">
						<label for="77">b) 'm sitting</label>
						<br>
						<input required id="78" type="radio" value="c" name="question26">
						<label for="78">c) sit</label>
						<br>
					</div>
					<!--------------Question_27-------------->
					<div class="question">
						<p>27) My brother is older _____ me.</p>
						<input required id="79" type="radio" value="a" name="question27">
						<label for="79">a) then</label>
						<br>
						<input required id="80" type="radio" value="b" name="question27">
						<label for="80">b) that</label>
						<br>
						<input required id="81" type="radio" value="c" name="question27">
						<label for="81">c) than</label>
						<br>
					</div>
					<!--------------Question_28-------------->
					<div class="question">
						<p>28) Their car is _____ biggest on the road.</p>
						<input required id="82" type="radio" value="a" name="question28">
						<label for="82">a) than</label>
						<br>
						<input required id="83" type="radio" value="b" name="question28">
						<label for="83">b) this</label>
						<br>
						<input required id="84" type="radio" value="c" name="question28">
						<label for="84">c) the</label>
						<br>
					</div>
					<!--------------Question_29-------------->
					<div class="question">
						<p>29) It’s the _____ interesting of his films.</p>
						<input required id="85" type="radio" value="a" name="question29">
						<label for="85">a) more</label>
						<br>
						<input required id="86" type="radio" value="b" name="question29">
						<label for="86">b) much</label>
						<br>
						<input required id="87" type="radio" value="c" name="question29">
						<label for="87">c) most</label>
						<br>
					</div>
					<!--------------Question_30-------------->
					<div class="question">
						<p>30) The phone’s ringing: _____ answer it.</p>
						<input required id="88" type="radio" value="a" name="question30">
						<label for="88">a) I’ll</label>
						<br>
						<input required id="89" type="radio" value="b" name="question30">
						<label for="89">b) I</label>
						<br>
						<input required id="90" type="radio" value="c" name="question30">
						<label for="90">c) will</label>
						<br>
					</div>
					<!--------------Question_31-------------->
					<div class="question">
						<p>31) Do you _____ classical or rock music?</p>
						<input required id="91" type="radio" value="a" name="question31">
						<label for="91">a) rather</label>
						<br>
						<input required id="92" type="radio" value="b" name="question31">
						<label for="92">b) prefer</label>
						<br>
						<input required id="93" type="radio" value="c" name="question31">
						<label for="93">c) more</label>
						<br>
					</div>
					<!--------------Question_32-------------->
					<div class="question">
						<p>32) He has _____ breakfast.</p>
						<input required id="94" type="radio" value="a" name="question32">
						<label for="94">a) ate</label>
						<br>
						<input required id="95" type="radio" value="b" name="question32">
						<label for="95">b) eaten</label>
						<br>
						<input required id="96" type="radio" value="c" name="question32">
						<label for="96">c) eat</label>
						<br>
					</div>
					<!--------------Question_33-------------->
					<div class="question">
						<p>33) The _____ have seen it before.</p>
						<input required id="97" type="radio" value="a" name="question33">
						<label for="97">a) childs</label>
						<br>
						<input required id="98" type="radio" value="b" name="question33">
						<label for="98">b) child</label>
						<br>
						<input required id="99" type="radio" value="c" name="question33">
						<label for="99">c) children</label>
						<br>
					</div>
					<!--------------Question_34-------------->
					<div class="question">
						<p>34) I’ve never met an actor _____ .</p>
						<input required id="100" type="radio" value="a" name="question34">
						<label for="100">a) before</label>
						<br>
						<input required id="101" type="radio" value="b" name="question34">
						<label for="101">b) already</label>
						<br>
						<input required id="102" type="radio" value="c" name="question34">
						<label for="102">c) after</label>
						<br>
					</div>
					<!--------------Question_35-------------->
					<div class="question">
						<p>35) _____ is very good exercise.</p>
						<input required id="103" type="radio" value="a" name="question35">
						<label for="103">a) Swim</label>
						<br>
						<input required id="104" type="radio" value="b" name="question35">
						<label for="104">b) To swim</label>
						<br>
						<input required id="105" type="radio" value="c" name="question35">
						<label for="105">c) Swimming</label>
						<br>
					</div>
					<!--------------Question_36-------------->
					<div class="question">
						<p>36) Have you _____ been on a winter sports holiday?</p>
						<input required id="106" type="radio" value="a" name="question36">
						<label for="106">a) always</label>
						<br>
						<input required id="107" type="radio" value="b" name="question36">
						<label for="107">b) ever</label>
						<br>
						<input required id="108" type="radio" value="c" name="question36">
						<label for="108">c) soon</label>
						<br>
					</div>
					<!--------------Question_37-------------->
					<div class="question">
						<p>37) I can’t _____ another language.</p>
						<input required id="109" type="radio" value="a" name="question37">
						<label for="109">a) speaking</label>
						<br>
						<input required id="110" type="radio" value="b" name="question37">
						<label for="110">b) speak</label>
						<br>
						<input required id="111" type="radio" value="c" name="question37">
						<label for="111">c) to speak</label>
						<br>
					</div>
					<!--------------Question_38-------------->
					<div class="question">
						<p>38) They _____ pay for the tickets.</p>
						<input required id="112" type="radio" value="a" name="question38">
						<label for="112">a) haven’t to</label>
						<br>
						<input required id="113" type="radio" value="b" name="question38">
						<label for="113">b) don’t have</label>
						<br>
						<input required id="114" type="radio" value="c" name="question38">
						<label for="114">c) don’t have to</label>
						<br>
					</div>
					<!--------------Question_39-------------->
					<div class="question">
						<p>39) _____ old is their car?</p>
						<input required id="115" type="radio" value="a" name="question39">
						<label for="115">a) What</label>
						<br>
						<input required id="116" type="radio" value="b" name="question39">
						<label for="116">b) When</label>
						<br>
						<input required id="117" type="radio" value="c" name="question39">
						<label for="117">c) How</label>
						<br>
					</div>
					<!--------------Question_40-------------->
					<div class="question">
						<p>40) Are you _____ for one or two weeks?</p>
						<input required id="118" type="radio" value="a" name="question40">
						<label for="118">a) staying</label>
						<br>
						<input required id="119" type="radio" value="b" name="question40">
						<label for="119">b) stayed</label>
						<br>
						<input required id="120" type="radio" value="c" name="question40">
						<label for="120">c) stay</label>
						<br>
					</div>
					<!--------------Question_41-------------->
					<div class="question">
						<p>41) Stephen _____ to visit his parents.</p>
						<input required id="121" type="radio" value="a" name="question41">
						<label for="121">a) will</label>
						<br>
						<input required id="122" type="radio" value="b" name="question41">
						<label for="122">b) going</label>
						<br>
						<input required id="123" type="radio" value="c" name="question41">
						<label for="123">c) is going</label>
						<br>
					</div>
					<!--------------Question_42-------------->
					<div class="question">
						<p>42) I don’t _____ getting up early.</p>
						<input required id="124" type="radio" value="a" name="question42">
						<label for="124">a) not like</label>
						<br>
						<input required id="125" type="radio" value="b" name="question42">
						<label for="125">b) want</label>
						<br>
						<input required id="126" type="radio" value="c" name="question42">
						<label for="126">c) enjoy</label>
						<br>
					</div>
					<!--------------Question_43-------------->
					<div class="question">
						<p>43) We _____ like to see the mountains.</p>
						<input required id="127" type="radio" value="a" name="question43">
						<label for="127">a) would</label>
						<br>
						<input required id="128" type="radio" value="c" name="question43">
						<label for="128">b) will</label>
						<br>
						<input required id="129" type="radio" value="b" name="question43">
						<label for="129">c) are</label>
						<br>
					</div>
					<!--------------Question_44-------------->
					<div class="question">
						<p>44) They _____ ever check their emails.</p>
						<input required id="130" type="radio" value="a" name="question44">
						<label for="130">a) hard</label>
						<br>
						<input required id="131" type="radio" value="b" name="question44">
						<label for="131">b) harder</label>
						<br>
						<input required id="132" type="radio" value="c" name="question44">
						<label for="132">c) hardly</label>
						<br>
					</div>
					<!--------------Question_45-------------->
					<div class="question">
						<p>45) They won’t come, _____ they?</p>
						<input required id="133" type="radio" value="a" name="question45">
						<label for="133">a) won’t</label>
						<br>
						<input required id="134" type="radio" value="b" name="question45">
						<label for="134">b) come</label>
						<br>
						<input required id="135" type="radio" value="c" name="question45">
						<label for="135">c) will</label>
						<br>
					</div>
					<!--------------Question_46-------------->
					<div class="question">
						<p>46) He _____ know how to spell it.</p>
						<input required id="136" type="radio" value="a" name="question46">
						<label for="136">a) doesn’t</label>
						<br>
						<input required id="137" type="radio" value="b" name="question46">
						<label for="137">b) hasn’t</label>
						<br>
						<input required id="138" type="radio" value="c" name="question46">
						<label for="138">c) don’t</label>
						<br>
					</div>
					<!--------------Question_47-------------->
					<div class="question">
						<p>47) Carla _____ to the radio all morning.</p>
						<input required id="139" type="radio" value="a" name="question47">
						<label for="139">a) listening</label>
						<br>
						<input required id="140" type="radio" value="b" name="question47">
						<label for="140">b) heard</label>
						<br>
						<input required id="141" type="radio" value="b" name="question47">
						<label for="141">c) listened</label>
						<br>
					</div>
					<!--------------Question_48-------------->
					<div class="question">
						<p>48) They _____ come to the cinema with us.</p>
						<input required id="142" type="radio" value="a" name="question48">
						<label for="142">a) doesn’t</label>
						<br>
						<input required id="143" type="radio" value="b" name="question48">
						<label for="143">b) not</label>
						<br>
						<input required id="144" type="radio" value="c" name="question48">
						<label for="144">c) didn’t</label>
						<br>
					</div>
					<!--------------Question_49-------------->
					<div class="question">
						<p>49) I like this song. _____ do I.</p>
						<input required id="145" type="radio" value="a" name="question49">
						<label for="145">a) Either</label>
						<br>
						<input required id="146" type="radio" value="b" name="question49">
						<label for="146">b) So</label>
						<br>
						<input required id="147" type="radio" value="c" name="question49">
						<label for="147">c) Neither</label>
						<br>
					</div>
					<!--------------Question_50-------------->
					<div class="question">
						<p>50) We _____ them at eight o’clock.</p>
						<input required id="148" type="radio" value="a" name="question50">
						<label for="148">a) meet</label>
						<br>
						<input required id="149" type="radio" value="b" name="question50">
						<label for="149">b) 're meet</label>
						<br>
						<input required id="150" type="radio" value="c" name="question50">
						<label for="150">c) 're meeting</label>
						<br>
					</div>


					<div class="form-group row">
			            <div class="col-md-6 offset-md-4">
			              <button type="submit" class="btn btn-primary">
			                {{ __('Подтвердить') }}
			              </button>
			            </div>
		         	</div>

				</form>

                
            </div>
        </div>
    </div>
</div>

@endsection
<style>
	.question{
		font-size: 18px;
		padding: 10px 20px;
	};	

	.radio{
		width: 80px;
		height: 80px;
	};

</style>