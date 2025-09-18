<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionsExport implements FromView
{
    protected $month;
    protected $status;

    public function __construct($month = null, $status = null)
    {
        $this->month = $month;
        $this->status = $status;
    }

    public function view(): View
    {
        $query = Transaction::with(['user','supplier']);

        if ($this->month) {
            $query->whereMonth('date', $this->month);
        }
        if ($this->status) {
            $query->where('status', $this->status);
        }

        // filter tambahan untuk Manager (hanya approve/reject)
        if (auth()->user()->role === 'Manager') {
            $query->whereIn('status', ['approved','rejected']);
        }

        return view('exports.transactions', [
            'transactions' => $query->get()
        ]);
    }
}
