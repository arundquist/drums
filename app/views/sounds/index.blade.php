<!DOCTYPE html>
<html>
    <head>
        <title>Rundquist Research crowdsourcing</title>

 
    </head>
    <body>
        <table border ='1'>
      @foreach($allsounds AS $sound)
      <tr><td>{{$sound->freqeuncies}}</td>
            <td>{{$sound->amplitudes}}</td>
            <td>{{$sound->score}}</td>
       </tr>
      
      @endforeach
      </table>
      {{$allsounds->links()}}
    </body>
</html>