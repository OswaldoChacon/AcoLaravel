@extends('oficina.oficina')

@section('content')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.1/xlsx.full.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/file-saver@2.0.2/dist/FileSaver.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
<style>
 table{
     text-align: justify;
 }
</style>
<div class="card">
    <div class="card-body">



        <div class="table-responvive">
            <button type="button" class="btn-sm btn-primary" id="btn">Descargar horario</button>
            <table class="table" id="mytable">
                <thead>
                    <tr>
                        <?php
                        echo ('<th>Fecha</th>');
                        for ($z = 0; $z < $salonesTable; $z++) {
                            echo ('<th>Clave</th>');
                            for ($y = 0; $y < $maestrosTable; $y++) {
                                echo ('<th>Maestro</th>');
                            }
                            echo ('<th></th>');
                        }
                        ?>
                    </tr>
                </thead>
                <?php foreach ($resultado as $key => $event) {
                    echo ('<tr>');
                    echo ('<td>' . $key . '</td>');
                    foreach ($event as $titles) {
                        foreach ($titles as $item) {
                            echo ('<td>' . $item . '</td>');
                        }
                        echo ('<td></td>');
                    }
                    // foreach ($value as $cell) {
                    //     echo ('<td>' . $cell . '</td>');
                    // }
                    echo ('</tr>');
                } ?>
            </table>
        </div>
        <!-- <table class="table">                       
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table> -->

    </div>
</div>


<script>
    // $("table").tableHTMLExport({
    //     type: 'pjdf',
    //     filename: 'sample.pdf',
    //     orientation:'p'

    //     // ignoreColumns: '.ignore',
    //     // ignoreRows: '.ignore'
    // });
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
</script>
@endsection