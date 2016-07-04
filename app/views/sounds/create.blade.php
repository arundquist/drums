<!DOCTYPE html>
<html>
    <head>
        <title>Rundquist Research crowdsourcing</title>

 
    </head>
    <body>
       <script>
           {{$text}}
           
    </script>
    {{ Form::open(array('action' => 'SoundsController@store')) }}
    
    <input type="text" name="score" autofocus>
    <input type='hidden' name='freqs' value='{{$freqs}}'>
    <input type='hidden' name='amps' value='{{$amps}}'>
    <input type="submit">
{{ Form::close() }}

<p>
    Thanks for participating in this crowdsourcing for the Rundquist Research Group at Hamline
    University! When this page loads you should hear a sound that is the combination of 5
    random frequencies with random amplitudes. We're trying to train a neural network on 
    what "sounds good" so that we can determine some drumhead shapes that will sound melodic. 
</p>

<p>
    Please score the sound you hear on a scale from 0 (noise) to 5 (pure tone) using the text 
    entry box above. When you hit submit (or just press enter) your score will be stored in our 
    database and the page will reload, playing yet another sound for you to judge. 
    </p>
    
    </body>
</html>