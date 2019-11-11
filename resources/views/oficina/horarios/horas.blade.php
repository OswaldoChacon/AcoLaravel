<style>
    /* td,
    th {
        border: 1px solid #000;
        padding: 8px;
    }
    tr:nth-child(even){background-color: #f2f2f2;} */
    table, th, td {
  border: 1px solid black;
}
</style>
<a href="{{ route('donwloadPDF') }}" class="btn btn-sm btn-primary">
    Descargar PDF
</a>
<table class="table">
    @foreach($resultado as $date => $dates)
    <tr>
        <td colspan="11" style="background:red;  text-align:center">{{$date}}</td>
    </tr>
    @foreach($dates as $hour => $hours)
    <tr colspan="2">
        <td colspan="2">{{$hour}}</td>
        @foreach($hours as $event => $events)
        @if($events == null)
        @for($z = 0; $z < $maestrosTable+1; $z++) 
        <td></td>
        @endfor
        @endif
        @foreach($events as $item)
        <td>{{$item}}</td>
        @endforeach
        @endforeach
    </tr>
    @endforeach
    @endforeach
</table>