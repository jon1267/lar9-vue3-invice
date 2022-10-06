<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Counter;
use App\Models\Customer;

class InvoiceController extends Controller
{
    public function invoices()
    {
        $invoices = Invoice::with('customer')->orderBy('id','DESC')->get();

        return response()->json(['invoices' => $invoices], 200);
    }

    public function searchInvoice(Request $request)
    {
        $search = trim($request->get('s')); //$request->s ?
        if ($search) {
            $invoices = Invoice::with('customer')
                ->where('id', 'LIKE', "%$search%") //->orWhere('number', 'LIKE', "%$search%")
                ->get();

            return response()->json(['invoices' => $invoices], 200);
        }

        return $this->invoices();
    }

    public function createInvoice(Request $request)
    {
        $counter = Counter::where('key', 'invoice')->first();
        $random  = Counter::where('key', 'invoice')->first();

        $invoice = Invoice::orderBy('id', 'DESC')->first();
        if ($invoice) {
            $invoiceId = $invoice->id + 1;
            $counters  = $counter->value + $invoiceId;
        } else {
            $counters  = $counter->value;
        }

        $formData = [
            'number' => $counter->prefix.$counters,
            'customer_id' => null,
            'customer' => null,
            'date' => date('Y-m-d'),
            'due_date' => null,
            'reference' => null,
            'discount' => 0,
            'term_and_conditions' => 'Default Terms ant Conditions',
            'items' => [
                [
                    'product_id' => null,
                    'product' => null,
                    'unit_price' => 0,
                    'quantity' => 1
                ]
            ]
        ];
        return response()->json($formData);
    }

}
