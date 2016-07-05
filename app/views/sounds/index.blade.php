<!DOCTYPE html>
<html>
    <head>
        <title>Rundquist Research crowdsourcing</title>

 
    </head>
    <body>
        <table border ='1'>
      @foreach($allsounds AS $sound)
      <tr><td>{{$sound->frequencies}}</td>
            <td>{{$sound->amplitudes}}</td>
            <td>{{link_to_action('SoundsController@show', $sound->score,[$sound->id])}}</td>
       </tr>
      
      @endforeach
      </table>
      {{$allsounds->links()}}
    </body>
</html>