@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Part B') }}</div>


            	<form method="POST" action="{{route('test2')}}">
            		@csrf

					<!--------------Question_51-------------->
					<div class="question">
						<p>1) They are going _____ in America next month.</p>
						<input required id="151" type="radio" value="a" name="question51">
						<label for="151">a) to be</label>
						<br>
						<input required id="152" type="radio" value="b" name="question51">
						<label for="152">b) will be</label>
						<br>
						<input required id="153" type="radio" value="c" name="question51">
						<label for="153">c) be</label>
						<br>
						<input required id="154" type="radio" value="d" name="question51">
						<label for="154">d) being</label>
						<br>
					</div>
					<!--------------Question_52-------------->
					<div class="question">
						<p>2) This is the cinema _____ we saw the film.</p>
						<input required id="155" type="radio" value="a" name="question52">
						<label for="155">a) when</label>
						<br>
						<input required id="156" type="radio" value="b" name="question52">
						<label for="156">b) which</label>
						<br>
						<input required id="157" type="radio" value="c" name="question52">
						<label for="157">c) that</label>
						<br>
						<input required id="158" type="radio" value="d" name="question52">
						<label for="158">d) where</label>
						<br>
					</div>
					<!--------------Question_53-------------->
					<div class="question">
						<p>3) Have you ever _____ in a jazz band?</p>
						<input required id="159" type="radio" value="a" name="question53">
						<label for="159">a) seen</label>
						<br>
						<input required id="160" type="radio" value="b" name="question53">
						<label for="160">b) played</label>
						<br>
						<input required id="161" type="radio" value="c" name="question53">
						<label for="161">c) listened</label>
						<br>
						<input required id="162" type="radio" value="d" name="question53">
						<label for="162">d) wanted</label>
						<br>
					</div>
					<!--------------Question_54-------------->
					<div class="question">
						<p>4) I’m _____ when I’m with you.</p>
						<input required id="163" type="radio" value="a" name="question54">
						<label for="163">a) happyer</label>
						<br>
						<input required id="164" type="radio" value="b" name="question54">
						<label for="164">b) happier than</label>
						<br>
						<input required id="165" type="radio" value="c" name="question54">
						<label for="165">c) happier</label>
						<br>
						<input required id="166" type="radio" value="d" name="question54">
						<label for="166">d) the happy</label>
						<br>
					</div>
					<!--------------Question_55-------------->
					<div class="question">
						<p>5) This is _____ than I thought.</p>
						<input required id="167" type="radio" value="a" name="question55">
						<label for="167">a) bad</label>
						<br>
						<input required id="168" type="radio" value="b" name="question55">
						<label for="168">b) badder</label>
						<br>
						<input required id="169" type="radio" value="c" name="question55">
						<label for="169">c) worse</label>
						<br>
						<input required id="170" type="radio" value="d" name="question55">
						<label for="170">d) worst</label>
						<br>
					</div>
					<!--------------Question_56-------------->
					<div class="question">
						<p>6) Can you tell me the way _____ ?</p>
						<input required id="171" type="radio" value="a" name="question56">
						<label for="171">a) to the bank</label>
						<br>
						<input required id="172" type="radio" value="b" name="question56">
						<label for="172">b) is the bank</label>
						<br>
						<input required id="173" type="radio" value="c" name="question56">
						<label for="173">c) where is bank</label>
						<br>
						<input required id="174" type="radio" value="d" name="question56">
						<label for="174">d) of the bank</label>
						<br>
					</div>
					<!--------------Question_57-------------->
					<div class="question">
						<p>7) Do you know what _____ ?</p>
						<input required id="175" type="radio" value="a" name="question57">
						<label for="175">a) time is it</label>
						<br>
						<input required id="176" type="radio" value="b" name="question57">
						<label for="176">b) time is</label>
						<br>
						<input required id="177" type="radio" value="c" name="question57">
						<label for="177">c) time is now</label>
						<br>
						<input required id="178" type="radio" value="d" name="question57">
						<label for="178">d) time it is</label>
						<br>
					</div>
					<!--------------Question_58-------------->
					<div class="question">
						<p>8) Were you _____ to open the door?</p>
						<input required id="179" type="radio" value="a" name="question58">
						<label for="179">a) could</label>
						<br>
						<input required id="180" type="radio" value="b" name="question58">
						<label for="180">b) can</label>
						<br>
						<input required id="181" type="radio" value="c" name="question58">
						<label for="181">c) able</label>
						<br>
						<input required id="182" type="radio" value="d" name="question58">
						<label for="182">d) possible</label>
						<br>
					</div>
					<!--------------Question_59-------------->
					<div class="question">
						<p>9) Everybody _____ wear a seat belt in the car.</p>
						<input required id="183" type="radio" value="a" name="question59">
						<label for="183">a) must</label>
						<br>
						<input required id="184" type="radio" value="b" name="question59">
						<label for="184">b) mustn’t</label>
						<br>
						<input required id="185" type="radio" value="c" name="question59">
						<label for="185">c) don’t have to</label>
						<br>
						<input required id="186" type="radio" value="d" name="question59">
						<label for="186">d) doesn’t have to</label>
						<br>
					</div>
					<!--------------Question_60-------------->
					<div class="question">
						<p>10) Tom has lived in this town _____ three years.</p>
						<input required id="187" type="radio" value="a" name="question60">
						<label for="187">a) since</label>
						<br>
						<input required id="188" type="radio" value="b" name="question60">
						<label for="188">b) from</label>
						<br>
						<input required id="189" type="radio" value="c" name="question60">
						<label for="189">c) after</label>
						<br>
						<input required id="190" type="radio" value="d" name="question60">
						<label for="190">d) for</label>
						<br>
					</div>
					<!--------------Question_61-------------->
					<div class="question">
						<p>11) We _____ work in that factory.</p>
						<input required id="191" type="radio" value="a" name="question61">
						<label for="191">a) use to</label>
						<br>
						<input required id="192" type="radio" value="b" name="question61">
						<label for="192">b) was</label>
						<br>
						<input required id="193" type="radio" value="c" name="question61">
						<label for="193">c) used to</label>
						<br>
						<input required id="194" type="radio" value="d" name="question61">
						<label for="194">d) then</label>
						<br>
					</div>
					<!--------------Question_62-------------->
					<div class="question">
						<p>12) I think it _____ be sunny tomorrow.</p>
						<input required id="195" type="radio" value="a" name="question62">
						<label for="195">a) will probably</label>
						<br>
						<input required id="196" type="radio" value="b" name="question62">
						<label for="196">b) probably</label>
						<br>
						<input required id="197" type="radio" value="c" name="question62">
						<label for="197">c) can</label>
						<br>
						<input required id="198" type="radio" value="d" name="question62">
						<label for="198">d) will to</label>
						<br>
					</div>
					<!--------------Question_63-------------->
					<div class="question">
						<p>13) He _____ like his brother.</p>
						<input required id="199" type="radio" value="a" name="question63">
						<label for="199">a) look</label>
						<br>
						<input required id="200" type="radio" value="b" name="question63">
						<label for="200">b) isn’t</label>
						<br>
						<input required id="201" type="radio" value="c" name="question63">
						<label for="201">c) isn’t look</label>
						<br>
						<input required id="202" type="radio" value="d" name="question63">
						<label for="202">d) can look</label>
						<br>
					</div>
					<!--------------Question_64-------------->
					<div class="question">
						<p>14) _____ does your boyfriend look like?</p>
						<input required id="203" type="radio" value="a" name="question64">
						<label for="203">a) How</label>
						<br>
						<input required id="204" type="radio" value="b" name="question64">
						<label for="204">b) What</label>
						<br>
						<input required id="205" type="radio" value="c" name="question64">
						<label for="205">c) Why</label>
						<br>
						<input required id="206" type="radio" value="d" name="question64">
						<label for="206">d) Which</label>
						<br>
					</div>
					<!--------------Question_65-------------->
					<div class="question">
						<p>15) I’ve got _____ many problems.</p>
						<input required id="207" type="radio" value="a" name="question65">
						<label for="207">a) too</label>
						<br>
						<input required id="208" type="radio" value="b" name="question65">
						<label for="208">b) a</label>
						<br>
						<input required id="209" type="radio" value="c" name="question65">
						<label for="209">c) enough</label>
						<br>
						<input required id="210" type="radio" value="d" name="question65">
						<label for="210">d) really</label>
						<br>
					</div>
					<input type="hidden" name="id_s" value="{{ $id }}">
					<!--------------Question_66-------------->
					<div class="question">
						<p>16) If we get up in time, _____ catch the train.</p>
						<input required id="211" type="radio" value="a" name="question66">
						<label for="211">a) we catch</label>
						<br>
						<input required id="212" type="radio" value="b" name="question66">
						<label for="212">b) we caught</label>
						<br>
						<input required id="213" type="radio" value="c" name="question66">
						<label for="213">c) we had caught</label>
						<br>
						<input required id="214" type="radio" value="d" name="question66">
						<label for="214">d) we’ll catch</label>
						<br>
					</div>
					<!--------------Question_67-------------->
					<div class="question">
						<p>17) They _____ to go to France for a year.</p>
						<input required id="215" type="radio" value="a" name="question67">
						<label for="215">a) decide</label>
						<br>
						<input required id="216" type="radio" value="b" name="question67">
						<label for="216">b) deciding</label>
						<br>
						<input required id="217" type="radio" value="c" name="question67">
						<label for="217">c) decided</label>
						<br>
						<input required id="218" type="radio" value="d" name="question67">
						<label for="218">d) to decide</label>
						<br>
					</div>
					<!--------------Question_68-------------->
					<div class="question">
						<p>18) I’m working _____ to pass my exam.</p>
						<input required id="219" type="radio" value="a" name="question68">
						<label for="219">a) hardly</label>
						<br>
						<input required id="220" type="radio" value="b" name="question68">
						<label for="220">b) much</label>
						<br>
						<input required id="221" type="radio" value="c" name="question68">
						<label for="221">c) hard</label>
						<br>
						<input required id="222" type="radio" value="d" name="question68">
						<label for="222">d) good</label>
						<br>
					</div>
					<!--------------Question_69-------------->
					<div class="question">
						<p>19) I’m writing _____ ask you to explain.</p>
						<input required id="223" type="radio" value="a" name="question69">
						<label for="223">a) for</label>
						<br>
						<input required id="224" type="radio" value="b" name="question69">
						<label for="224">b) in order to</label>
						<br>
						<input required id="225" type="radio" value="c" name="question69">
						<label for="225">c) because</label>
						<br>
						<input required id="226" type="radio" value="d" name="question69">
						<label for="226">d) because of</label>
						<br>
					</div>
					<!--------------Question_70-------------->
					<div class="question">
						<p>20) He said that most problems _____ by teenagers.</p>
						<input required id="227" type="radio" value="a" name="question70">
						<label for="227">a) cause</label>
						<br>
						<input required id="228" type="radio" value="b" name="question70">
						<label for="228">b) caused</label>
						<br>
						<input required id="229" type="radio" value="c" name="question70">
						<label for="229">c) were caused</label>
						<br>
						<input required id="230" type="radio" value="d" name="question70">
						<label for="230">d) were causing</label>
						<br>
					</div>
					<!--------------Question_71-------------->
					<div class="question">
						<p>21) What _____ to do at the weekend?</p>
						<input required id="231" type="radio" value="a" name="question71">
						<label for="231">a) have you like</label>
						<br>
						<input required id="232" type="radio" value="b" name="question71">
						<label for="232">b) are you liking</label>
						<br>
						<input required id="233" type="radio" value="c" name="question71">
						<label for="233">c) do you like</label>
						<br>
						<input required id="234" type="radio" value="d" name="question71">
						<label for="234">d) is you like</label>
						<br>
					</div>
					<!--------------Question_72-------------->
					<div class="question">
						<p>22) Football _____ in most countries.</p>
						<input required id="235" type="radio" value="a" name="question72">
						<label for="235">a) plays</label>
						<br>
						<input required id="236" type="radio" value="b" name="question72">
						<label for="236">b) players</label>
						<br>
						<input required id="237" type="radio" value="c" name="question72">
						<label for="237">c) is played</label>
						<br>
						<input required id="238" type="radio" value="d" name="question72">
						<label for="238">d) is playing</label>
						<br>
					</div>
					<!--------------Question_73-------------->
					<div class="question">
						<p>23) Who was _____ the door?</p>
						<input required id="239" type="radio" value="a" name="question73">
						<label for="239">a) at</label>
						<br>
						<input required id="240" type="radio" value="b" name="question73">
						<label for="240">b) on</label>
						<br>
						<input required id="241" type="radio" value="c" name="question73">
						<label for="241">c) in</label>
						<br>
						<input required id="242" type="radio" value="d" name="question73">
						<label for="242">d) of</label>
						<br>
					</div>
					<!--------------Question_74-------------->
					<div class="question">
						<p>24) We _____ lunch when you telephoned.</p>
						<input required id="243" type="radio" value="a" name="question74">
						<label for="243">a) was having</label>
						<br>
						<input required id="244" type="radio" value="b" name="question74">
						<label for="244">b) had</label>
						<br>
						<input required id="245" type="radio" value="c" name="question74">
						<label for="245">c) were having</label>
						<br>
						<input required id="246" type="radio" value="d" name="question74">
						<label for="246">d) are having</label>
						<br>
					</div>
					<!--------------Question_75-------------->
					<div class="question">
						<p>25) Your work is _____ better.</p>
						<input required id="247" type="radio" value="a" name="question75">
						<label for="247">a) being</label>
						<br>
						<input required id="248" type="radio" value="b" name="question75">
						<label for="248">b) doing</label>
						<br>
						<input required id="249" type="radio" value="c" name="question75">
						<label for="249">c) getting</label>
						<br>
						<input required id="250" type="radio" value="d" name="question75">
						<label for="250">d) falling</label>
						<br>
					</div>
					<!--------------Question_76-------------->
					<div class="question">
						<p>26) She could play the piano _____ she could walk.</p>
						<input required id="251" type="radio" value="a" name="question76">
						<label for="251">a) during</label>
						<br>
						<input required id="252" type="radio" value="b" name="question76">
						<label for="252">b) while</label>
						<br>
						<input required id="253" type="radio" value="c" name="question76">
						<label for="253">c) as well</label>
						<br>
						<input required id="254" type="radio" value="d" name="question76">
						<label for="254">d) before</label>
						<br>
					</div>
					<!--------------Question_77-------------->
					<div class="question">
						<p>27) The train was cancelled, so we _____ .</p>
						<input required id="255" type="radio" value="a" name="question77">
						<label for="255">a) couldn’t go</label>
						<br>
						<input required id="256" type="radio" value="b" name="question77">
						<label for="256">b) wasn’t go</label>
						<br>
						<input required id="257" type="radio" value="c" name="question77">
						<label for="257">c) didn’t went</label>
						<br>
						<input required id="258" type="radio" value="d" name="question77">
						<label for="258">d) mustn’t go</label>
						<br>
					</div>
					<!--------------Question_78-------------->
					<div class="question">
						<p>28) The problem was _____ solved.</p>
						<input required id="259" type="radio" value="a" name="question78">
						<label for="259">a) easy</label>
						<br>
						<input required id="260" type="radio" value="b" name="question78">
						<label for="260">b) easy to</label>
						<br>
						<input required id="261" type="radio" value="c" name="question78">
						<label for="261">c) an easy</label>
						<br>
						<input required id="262" type="radio" value="d" name="question78">
						<label for="262">d) easily</label>
						<br>
					</div>
					<!--------------Question_79-------------->
					<div class="question">
						<p>29) It was a difficult journey, but I _____ get home.</p>
						<input required id="263" type="radio" value="a" name="question79">
						<label for="263">a) could</label>
						<br>
						<input required id="264" type="radio" value="b" name="question79">
						<label for="264">b) managed to</label>
						<br>
						<input required id="265" type="radio" value="c" name="question79">
						<label for="265">c) at last</label>
						<br>
						<input required id="266" type="radio" value="d" name="question79">
						<label for="266">d) was</label>
						<br>
					</div>
					<!--------------Question_80-------------->
					<div class="question">
						<p>30) We had not _____ heard the news.</p>
						<input required id="267" type="radio" value="a" name="question80">
						<label for="267">a) already</label>
						<br>
						<input required id="268" type="radio" value="b" name="question80">
						<label for="268">b) always</label>
						<br>
						<input required id="269" type="radio" value="c" name="question80">
						<label for="269">c) yet</label>
						<br>
						<input required id="270" type="radio" value="d" name="question80">
						<label for="270">d) today</label>
						<br>
					</div>
					<!--------------Question_81-------------->
					<div class="question">
						<p>31) We arrived at the station, but the bus _____ earlier.</p>
						<input required id="271" type="radio" value="a" name="question81">
						<label for="271">a) has left</label>
						<br>
						<input required id="272" type="radio" value="b" name="question81">
						<label for="272">b) had leave</label>
						<br>
						<input required id="273" type="radio" value="c" name="question81">
						<label for="273">c) has leave</label>
						<br>
						<input required id="274" type="radio" value="d" name="question81">
						<label for="274">d) had left</label>
						<br>
					</div>
					<!--------------Question_82-------------->
					<div class="question">
						<p>32) We can _____ walk or go by car.</p>
						<input required id="275" type="radio" value="a" name="question82">
						<label for="275">a) both</label>
						<br>
						<input required id="276" type="radio" value="b" name="question82">
						<label for="276">b) rather</label>
						<br>
						<input required id="277" type="radio" value="c" name="question82">
						<label for="277">c) either</label>
						<br>
						<input required id="278" type="radio" value="d" name="question82">
						<label for="278">d) neither</label>
						<br>
					</div>
					<!--------------Question_83-------------->
					<div class="question">
						<p>33) If I _____ enough money, I’d buy a new car.</p>
						<input required id="279" type="radio" value="a" name="question83">
						<label for="279">a) had</label>
						<br>
						<input required id="280" type="radio" value="b" name="question83">
						<label for="280">b) would</label>
						<br>
						<input required id="281" type="radio" value="c" name="question83">
						<label for="281">c) did</label>
						<br>
						<input required id="282" type="radio" value="d" name="question83">
						<label for="282">d) shall</label>
						<br>
					</div>
					<!--------------Question_84-------------->
					<div class="question">
						<p>34) It _____ correctly.</p>
						<input required id="283" type="radio" value="a" name="question84">
						<label for="283">a) hasn’t done</label>
						<br>
						<input required id="284" type="radio" value="b" name="question84">
						<label for="284">b) hasn’t been done</label>
						<br>
						<input required id="285" type="radio" value="c" name="question84">
						<label for="285">c) hasn’t been do</label>
						<br>
						<input required id="286" type="radio" value="d" name="question84">
						<label for="286">d) not been done</label>
						<br>
					</div>
					<!--------------Question_85-------------->
					<div class="question">
						<p>35) The accident wouldn’t have happened, if you had been more _____ .</p>
						<input required id="287" type="radio" value="a" name="question85">
						<label for="287">a) careful</label>
						<br>
						<input required id="288" type="radio" value="b" name="question85">
						<label for="288">b) carefully</label>
						<br>
						<input required id="289" type="radio" value="c" name="question85">
						<label for="289">c) careless</label>
						<br>
						<input required id="290" type="radio" value="d" name="question85">
						<label for="290">d) caring</label>
						<br>
					</div>
					<!--------------Question_86-------------->
					<div class="question">
						<p>36) It _____ be possible some time in the future.</p>
						<input required id="291" type="radio" value="a" name="question86">
						<label for="291">a) can</label>
						<br>
						<input required id="292" type="radio" value="b" name="question86">
						<label for="292">b) hope</label>
						<br>
						<input required id="293" type="radio" value="c" name="question86">
						<label for="293">c) may</label>
						<br>
						<input required id="294" type="radio" value="d" name="question86">
						<label for="294">d) is</label>
						<br>
					</div>
					<!--------------Question_87-------------->
					<div class="question">
						<p>37) Schools then _____ having more children in the class.</p>
						<input required id="295" type="radio" value="a" name="question87">
						<label for="295">a) was used to</label>
						<br>
						<input required id="296" type="radio" value="b" name="question87">
						<label for="296">b) were used to</label>
						<br>
						<input required id="297" type="radio" value="c" name="question87">
						<label for="297">c) was use to</label>
						<br>
						<input required id="298" type="radio" value="d" name="question87">
						<label for="298">d) were use to</label>
						<br>
					</div>
					<!--------------Question_88-------------->
					<div class="question">
						<p>38) We _____ to go to work at six in the morning.</p>
						<input required id="299" type="radio" value="a" name="question88">
						<label for="299">a) must</label>
						<br>
						<input required id="300" type="radio" value="b" name="question88">
						<label for="300">b) would</label>
						<br>
						<input required id="301" type="radio" value="c" name="question88">
						<label for="301">c) had</label>
						<br>
						<input required id="302" type="radio" value="d" name="question88">
						<label for="302">d) did</label>
						<br>
					</div>
					<!--------------Question_89-------------->
					<div class="question">
						<p>39) They _____ an old photograph of the place.</p>
						<input required id="303" type="radio" value="a" name="question89">
						<label for="303">a) came up</label>
						<br>
						<input required id="304" type="radio" value="b" name="question89">
						<label for="304">b) came across</label>
						<br>
						<input required id="305" type="radio" value="c" name="question89">
						<label for="305">c) came into</label>
						<br>
						<input required id="306" type="radio" value="d" name="question89">
						<label for="306">d) came after</label>
						<br>
					</div>
					<!--------------Question_90-------------->
					<div class="question">
						<p>40) I _____ I had been able to meet her.</p>
						<input required id="307" type="radio" value="a" name="question90">
						<label for="307">a) hope</label>
						<br>
						<input required id="308" type="radio" value="b" name="question90">
						<label for="308">b) want</label>
						<br>
						<input required id="309" type="radio" value="c" name="question90">
						<label for="309">c) think</label>
						<br>
						<input required id="310" type="radio" value="d" name="question90">
						<label for="310">d) wish</label>
						<br>
					</div>
					<!--------------Question_91-------------->
					<div class="question">
						<p>41) We’ll have taken our exams _____ this time next month.</p>
						<input required id="311" type="radio" value="a" name="question91">
						<label for="311">a) by</label>
						<br>
						<input required id="312" type="radio" value="b" name="question91">
						<label for="312">b) on</label>
						<br>
						<input required id="313" type="radio" value="c" name="question91">
						<label for="313">c) during</label>
						<br>
						<input required id="314" type="radio" value="d" name="question91">
						<label for="314">d) for</label>
						<br>
					</div>
					<!--------------Question_92-------------->
					<div class="question">
						<p>42) I will do badly in my work, _____ try harder.</p>
						<input required id="315" type="radio" value="a" name="question92">
						<label for="315">a) if I’m not</label>
						<br>
						<input required id="316" type="radio" value="b" name="question92">
						<label for="316">b) if I wasn’t</label>
						<br>
						<input required id="317" type="radio" value="c" name="question92">
						<label for="317">c) if I haven’t</label>
						<br>
						<input required id="318" type="radio" value="d" name="question92">
						<label for="318">d) if I don’t</label>
						<br>
					</div>
					<!--------------Question_93-------------->
					<div class="question">
						<p>43) I _____ wasted my time when I was at university.</p>
						<input required id="319" type="radio" value="a" name="question93">
						<label for="319">a) regret</label>
						<br>
						<input required id="320" type="radio" value="b" name="question93">
						<label for="320">b) shouldn’t</label>
						<br>
						<input required id="321" type="radio" value="c" name="question93">
						<label for="321">c) ought not to</label>
						<br>
						<input required id="322" type="radio" value="d" name="question93">
						<label for="322">d) shouldn’t have</label>
						<br>
					</div>
					<!--------------Question_94-------------->
					<div class="question">
						<p>44) This is going to be my chance to _____ any difficulties.</p>
						<input required id="323" type="radio" value="a" name="question94">
						<label for="323">a) repair</label>
						<br>
						<input required id="324" type="radio" value="b" name="question94">
						<label for="324">b) sort out</label>
						<br>
						<input required id="325" type="radio" value="c" name="question94">
						<label for="325">c) solve</label>
						<br>
						<input required id="326" type="radio" value="d" name="question94">
						<label for="326">d) improve</label>
						<br>
					</div>
					<!--------------Question_95-------------->
					<div class="question">
						<p>45) It was difficult at first, but I soon got _____ it.</p>
						<input required id="327" type="radio" value="a" name="question95">
						<label for="327">a) got used to</label>
						<br>
						<input required id="328" type="radio" value="b" name="question95">
						<label for="328">b) get used to</label>
						<br>
						<input required id="329" type="radio" value="c" name="question95">
						<label for="329">c) changed to</label>
						<br>
						<input required id="330" type="radio" value="d" name="question95">
						<label for="330">d) used to</label>
						<br>
					</div>
					<!--------------Question_96-------------->
					<div class="question">
						<p>46) How did you manage to cook _____ a good meal?</p>
						<input required id="331" type="radio" value="a" name="question96">
						<label for="331">a) so</label>
						<br>
						<input required id="332" type="radio" value="b" name="question96">
						<label for="332">b) that</label>
						<br>
						<input required id="333" type="radio" value="c" name="question96">
						<label for="333">c) absolutely</label>
						<br>
						<input required id="334" type="radio" value="d" name="question96">
						<label for="334">d) such</label>
						<br>
					</div>
					<!--------------Question_97-------------->
					<div class="question">
						<p>47) The solution had been found, _____ we hadn’t realised it.</p>
						<input required id="335" type="radio" value="a" name="question97">
						<label for="335">a) however</label>
						<br>
						<input required id="336" type="radio" value="b" name="question97">
						<label for="336">b) therefore</label>
						<br>
						<input required id="337" type="radio" value="c" name="question97">
						<label for="337">c) although</label>
						<br>
						<input required id="338" type="radio" value="d" name="question97">
						<label for="338">d) even</label>
						<br>
					</div>
					<!--------------Question_98-------------->
					<div class="question">
						<p>48) She _____ I had been doing for all that time.</p>
						<input required id="339" type="radio" value="a" name="question98">
						<label for="339">a) asked to me</label>
						<br>
						<input required id="340" type="radio" value="b" name="question98">
						<label for="340">b) asked for me</label>
						<br>
						<input required id="341" type="radio" value="c" name="question98">
						<label for="341">c) asked with me</label>
						<br>
						<input required id="342" type="radio" value="d" name="question98">
						<label for="342">d) asked me</label>
						<br>
					</div>
					<!--------------Question_99-------------->
					<div class="question">
						<p>49) They _____ heard us coming, we were making a lot of noise.</p>
						<input required id="343" type="radio" value="a" name="question99">
						<label for="343">a) must have</label>
						<br>
						<input required id="344" type="radio" value="b" name="question99">
						<label for="344">b) must</label>
						<br>
						<input required id="345" type="radio" value="c" name="question99">
						<label for="345">c) might</label>
						<br>
						<input required id="346" type="radio" value="d" name="question99">
						<label for="346">d) could</label>
						<br>
					</div>
					<!--------------Question_100-------------->
					<div class="question">
						<p>50) He _____ to help me with the decorating.</p>
						<input required id="347" type="radio" value="a" name="question100">
						<label for="347">a) suggested</label>
						<br>
						<input required id="348" type="radio" value="b" name="question100">
						<label for="348">b) offered</label>
						<br>
						<input required id="349" type="radio" value="c" name="question100">
						<label for="349">c) invited</label>
						<br>
						<input required id="350" type="radio" value="d" name="question100">
						<label for="350">d) told</label>
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