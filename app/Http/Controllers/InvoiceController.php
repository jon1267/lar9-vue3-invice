<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Counter;
use App\Models\InvoiceItem;

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

    public function createInvoice()
    {
        $counter = Counter::where('key', 'invoice')->first();
        //$random  = Counter::where('key', 'invoice')->first();

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

    public function saveInvoice(Request $request)
    {

        $invoiceItems = $request->invoice_items;

        $invoiceData['sub_total'] = $request->subtotal;
        $invoiceData['total'] = $request->total;
        $invoiceData['customer_id'] = $request->customer_id;
        $invoiceData['number'] = $request->number;
        $invoiceData['date'] = $request->date;
        $invoiceData['due_date'] = $request->due_date;
        $invoiceData['discount'] = $request->discount;
        $invoiceData['reference'] = $request->reference;
        $invoiceData['terms_and_conditions'] = $request->terms_and_conditions;

        $invoice = Invoice::create($invoiceData);

        foreach (json_decode($invoiceItems) as $item) {
            $itemData['product_id'] = $item->id;
            $itemData['invoice_id'] = $invoice->id;
            $itemData['quantity'] = $item->quantity;
            $itemData['unit_price'] = $item->unit_price;

            InvoiceItem::create($itemData);
        }

        return response()->json($invoice, 201); // ???

    }

    public function showInvoice($id)
    {
        $invoice = Invoice::with(['customer', 'invoice_items.product'])->findOrFail($id);

        return response()->json(['invoice' => $invoice], 200);
    }

    public function editInvoice($id)
    {
        $invoice = Invoice::with(['customer', 'invoice_items.product'])->findOrFail($id);

        return response()->json(['invoice' => $invoice], 200);
    }

    public function deleteInvoiceItems($id)
    {
        $invoiceItem = InvoiceItem::findOrFail($id);
        $invoiceItem->delete();
    }

    public function updateInvoice(Request $request, $id)
    {
        $invoice = Invoice::where('id', $id)->first();

        $invoiceData['sub_total'] = $request->subtotal;
        $invoiceData['total'] = $request->total;
        $invoiceData['customer_id'] = $request->customer_id;
        $invoiceData['number'] = $request->number;
        $invoiceData['date'] = $request->date;
        $invoiceData['due_date'] = $request->due_date;
        $invoiceData['discount'] = $request->discount;
        $invoiceData['reference'] = $request->reference;
        $invoiceData['terms_and_conditions'] = $request->terms_and_conditions;

        $invoice->update($invoiceData);

        $invoiceItem = $request->invoice_items;

        $invoice->invoice_items()->delete();

        foreach (json_decode($invoiceItem) as $item) {

            $itemData['product_id'] = $item->product_id;
            $itemData['invoice_id'] = $invoice->id;
            $itemData['quantity'] = $item->quantity;
            $itemData['unit_price'] = $item->unit_price;

            InvoiceItem::create($itemData);
        }

        return response()->json($invoice, 201); // ?
    }

    public function deleteInvoice($id)
    {
        $invoice = Invoice::findOrFail($id); //return response()->json($invoice, 200);
        $invoice->invoice_items()->delete();
        $invoice->delete();
    }

}
