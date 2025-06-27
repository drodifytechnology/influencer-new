<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HasUploader;
use App\Models\Option;
use App\Http\Controllers\Controller;

class AcnooHelpSupportController extends Controller
{
    use HasUploader;

    public function index()
    {
        $help_support = Option::where('key', 'help-supports')->first();
        return response()->json([
            'message' => 'Help Support fetched successfully',
            'data' => $help_support
        ]);
    }
}
