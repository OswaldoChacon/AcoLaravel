@extends('oficina.oficina')

@section('content')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.1/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/file-saver@2.0.2/dist/FileSaver.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
<style>
    table {
        text-align: justify;
    }
</style>
<div class="card">
    <div class="card-body">
        <!-- <a href="{{ route('donwloadPDF') }}" class="btn btn-sm btn-primary"> -->
        <button class="btn btn-primary" id="btn">Descargar en Excel</button>
        <button class="btn btn-primary" onclick="demoFromHTML()">PDF</button>
        <!-- </a> -->
        <div id="mytable">
            <table class=" table">
                <tr>llsls</tr>
                @foreach($resultado as $date => $dates)
                <tr>
                    <td colspan="10" style="background:red;  text-align:center">{{$date}}</td>
                </tr>
                @foreach($dates as $hour => $hours)
                <tr>
                    <td>{{$hour}}</td>
                    @foreach($hours as $event => $events)
                    @if($events == null)
                    @for($z = 0; $z < $maestrosTable+1; $z++) <td>
                        </td>
                        @endfor
                        @endif
                        @foreach($events as $item)
                        <td>{{$item}}</td>
                        @endforeach
                        @endforeach
                </tr>
                @endforeach
                @endforeach
                @php
                dd($resulado);
                @endphp

            </table>
        </div>

    </div>
</div>


<script>
    var wb = XLSX.utils.table_to_book(document.getElementById('mytable'), {
        sheet: "horarios"
    });
    var wbout = XLSX.write(wb, {
        bookType: 'xlsx',
        bookSST: true,
        type: 'binary'
    });

    function s2ab(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
        return buf;
    }
    $("#btn").click(function() {
        saveAs(new Blob([s2ab(wbout)], {
            type: "application/octet-stream"
        }), 'horarios.xlsx');
    });

    function demoFromHTML() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        source = $('#mytable')[0];

        // we support special element handlers. Register them with jQuery-style
        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
        // There is no support for any other type of selectors
        // (class, of compound) at this time.
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function(element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },
            function(dispose) {
                // dispose: object with X, Y of the last line add to the PDF
                //          this allow the insertion of new lines after html
                pdf.save('Test.pdf');
            }, margins);
    }
</script>
@endsection
