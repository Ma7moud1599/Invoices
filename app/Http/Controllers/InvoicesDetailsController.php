<?php

namespace App\Http\Controllers;

use App\Models\invoices_details;
use App\Models\invoices;
use App\Models\invoice_attachments;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Http\Request;

class InvoicesDetailsController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(invoices_details $invoices_details)
    {
        //
    }

    public function edit($id)
    {
        $invoices = invoices::where('id', $id)->first();
        $details  = invoices_Details::where('id_Invoice', $id)->get();
        $attachments  = invoice_attachments::where('invoice_id', $id)->get();

        return view('invoices.details_invoice', compact('invoices', 'details', 'attachments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoices = invoice_attachments::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);
        session()->flash('delete');
        return back();
    }

    public function get_file($invoice_number, $file_name)

    {
        // $contents = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        // return response()->download($contents);
        return response()->download(public_path('Attachments/' . $invoice_number . '/' . $file_name));
    }



    public function open_file($invoice_number, $file_name)

    {
        // $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->file(public_path('Attachments/' . $invoice_number . '/' . $file_name));
    }
}
