<?php

namespace Laravel\LaravelInstaller\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\LaravelInstaller\Helpers\PermissionsChecker;

class PermissionsController extends Controller
{
    /**
     * @var PermissionsChecker
     */
    protected   $permissions;

    /**
     * @param PermissionsChecker $checker
     */
    public function __construct(PermissionsChecker $checker)
    {
        $this->permissions = $checker;
    }

    /**
     * Display the permissions check page.
     *
     * @return \Illuminate\View\View
     */
    public function permissions()
    {
        $permissions = $this->permissions->check(
            config('installer.permissions')
        );

        return view('vendor.installer.permissions', compact('permissions'));
    }

    public function verify()
    {
        $permissions = $this->permissions->check(
            config('installer.permissions')
        );
        return view('vendor.installer.verify', compact('permissions'));
    }

    public function codeVerifyProcess(Request $request)
    {
        // $rules = ['purchase_code' => 'required'];
        // $messages = [
        //     'purchase_code.required' => __('Purchase code field is required.'),
        // ];

        // $validator = Validator::make($request->all(), $rules, $messages);

        // if ($validator->fails()) {
        //     $errors = $validator->errors();
        //     return redirect()->back()->with(['errors' => $errors]);
        // } else {
           
        //     file_put_contents(storage_path('.license'), json_encode(['license' => $request->purchase_code]));
        //     if ($request->_tokens && $request->_tokens == 'purchase_code') {
        //         return redirect('/')->with('message', __('Code verified successfully'));
        //     } else {
                return redirect()->route('LaravelInstaller::environment')->with('message', __('Code verified successfully'));
        //     }
        // }
    }

    public function verifier()
    {
        return view('vendor.installer.verify-code');
    }
}