<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gateway;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AcnooGatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gateways = Gateway::all();
        $currencies = Currency::latest()->get();

        return view('admin.settings.gateways.index', compact('gateways', 'currencies'));
    }

    public function update(Request $request, string $id)
    {
        Gateway::findOrFail($id)->update($request->except('image') + [
            'image' => $request->hasFile('image') ? $this->upload($request, 'image') : NULL
        ]);

        return response()->json('Gateway updated successfully');
    }
}
