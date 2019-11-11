<?php
namespace App\Http\Controllers;

namespace App\Http\Controllers\Horario;

// use Illuminate\Support\Facades\View;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;



class ExcelController implements FromView
{
    public function view(): View
    {
        return view('exports.invoices', [
            'invoices' => Invoice::all()
        ]);
    }
}