<?php

class SoundsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /sounds
	 *
	 * @return Response
	 */
	public function index()
	{
		$allsounds=Sound::paginate(20);
		return View::make('sounds/index',
			['allsounds'=>$allsounds]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /sounds/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$n=5;
        $freqs=[];
        $amps=[];
        for ($i=1; $i<=$n; $i++) {
            $freqs[]=mt_rand(100,1000);
            $amps[]=mt_rand(200,1000)/1000;
        };
        
        
        $text='context = new AudioContext;';
        foreach ($freqs as $key => $value) {
            # code...
            $text.="oscillator$key = context.createOscillator();
            gainNode$key = context.createGain();
            oscillator$key.frequency.value = $value;
            //oscillator$key.connect(context.destination);
            
            currentTime = context.currentTime;
            oscillator$key.connect(gainNode$key); // Connect sound source 2 to gain node 2
            gainNode$key.connect(context.destination); // Connect gain node 2 to output
            gainNode$key.gain.value = $amps[$key];
            oscillator$key.start(currentTime);
            oscillator$key.stop(currentTime + 1);

";
        };
        $freqstring="{";
        $freqstring.=implode($freqs, ", ");
        $freqstring.="}";
        $ampstring="{";
        $ampstring.=implode($amps, ", ");
        $ampstring.="}";
        
        return View::make('sounds/create',
        ['text'=>$text,
        'freqs'=>$freqstring,
        'amps'=>$ampstring]);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /sounds
	 *
	 * @return Response
	 */
	public function store()
	{
		$s = Input::get('score');
		if ($s>=0 && $s<=5)
		{
			$freqs = Input::get('freqs');
			$amps = Input::get('amps');
			$score=new Sound;
			$score->frequencies=$freqs;
			$score->amplitudes=$amps;
			$score->score=$s;
			$score->save();
		};
        return Redirect::action('SoundsController@create');
	}

	/**
	 * Display the specified resource.
	 * GET /sounds/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$sound=Sound::findOrFail($id);
		$freqs=$sound->frequencies;
		$freqs=substr($freqs, 1, -1);
		$freqs=explode(', ',$freqs);
		$amps=$sound->amplitudes;
		$amps=substr($amps, 1, -1);
		$amps=explode(', ',$amps);
		$key=1;
		$text='context = new AudioContext;';
        foreach ($freqs as $key => $value) {
            # code...
            $text.="oscillator$key = context.createOscillator();
            gainNode$key = context.createGain();
            oscillator$key.frequency.value = $value;
            //oscillator$key.connect(context.destination);
            
            currentTime = context.currentTime;
            oscillator$key.connect(gainNode$key); // Connect sound source 2 to gain node 2
            gainNode$key.connect(context.destination); // Connect gain node 2 to output
            gainNode$key.gain.value = $amps[$key];
            oscillator$key.start(currentTime);
            oscillator$key.stop(currentTime + 1);

";
		};
		return View::make('sounds/show',
			['text'=>$text,
			'sound'=>$sound]);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /sounds/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /sounds/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /sounds/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	
	public function mathematica()
    {
        $all=Sound::all();
        $textlist=[];
        foreach ($all AS $value) {
            $text="{";
            $text.=$value->frequencies;
            $text.=", ";
            $text.=$value->amplitudes;
            $text.="}->";
            $text.=$value->score;
            $textlist[]=$text;
        };
        $full="{";
        $full.=implode($textlist,", ");
        $full.="}";
        return $full;
    }

}