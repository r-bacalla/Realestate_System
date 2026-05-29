<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Lease;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('lease.property')
            ->latest()
            ->paginate(50);

        return view('admin.payments.index', compact('payments'));
    }

    public function create(Lease $lease)
    {
        return view('admin.payments.create', compact('lease'));

        $lease->payments()->create([
        ...$data,
        'status' => 'paid',
    ]);

    return redirect()
        ->route('leases.show', $lease)
        ->with('success', 'Payment recorded successfully');
    }

    public function receipt(Payment $payment)
    {
        $payment->load('lease.property', 'lease.tenant');

        return view('admin.payments.receipt', compact('payment'));
    }

    public function store(Request $request, Lease $lease)
{
    $validated = $request->validate([
        'amount' => 'required|numeric|min:1',
        'payment_date' => 'required|date',
        'method' => 'required|string',
        'notes' => 'nullable|string',
    ]);

    $lease->payments()->create([
        'amount' => $validated['amount'],
        'payment_date' => $validated['payment_date'],
        'method' => $validated['method'],
        'notes' => $validated['notes'] ?? null,
        'status' => 'paid',
    ]);

    return redirect()
        ->route('leases.show', $lease->id)
        ->with('success', '✅ Payment Successful!');
}
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return back()->with('success', 'Payment deleted');
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

            fputcsv($handle, [
                'ID','Lease','Property','Amount','Method','Status','Payment Date','Notes','Created At'
            ]);

            foreach ($payments as $p) {
                fputcsv($handle, [
                    $p->id,
                    $p->lease?->lease_number,
                    $p->lease?->property?->name,
                    $p->amount,
                    $p->method,
                    $p->status,
                    optional($p->payment_date)?->toDateString(),
                    strip_tags($p->notes),
                    $p->created_at->toDateTimeString(),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
} 
