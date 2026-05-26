<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Lease;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PaymentController extends Controller
{
    public function store(Request $request, Lease $lease)
    {
        $data = $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'method' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $lease->payments()->create($data);

        return back()->with('success', 'Payment recorded successfully');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return back()->with('success', 'Payment deleted');
    }

    public function index()
    {
        $payments = Payment::with('lease.property')->latest()->paginate(50);
        return view('admin.payments.index', compact('payments'));
    }

    public function export()
    {
        $payments = Payment::with('lease.property')->latest()->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="payments.csv"',
        ];

        $callback = function () use ($payments) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID','Lease','Property','Amount','Method','Status','Payment Date','Notes','Created At']);

            foreach ($payments as $p) {
                fputcsv($handle, [
                    $p->id,
                    $p->lease?->lease_number,
                    $p->lease?->property?->name,
                    $p->amount,
                    $p->method,
                    $p->status,
                    $p->payment_date?->toDateString(),
                    strip_tags($p->notes),
                    $p->created_at->toDateTimeString(),
                ]);
            }

            fclose($handle);
        };

        return Response::stream($callback, 200, $headers);
    }
}