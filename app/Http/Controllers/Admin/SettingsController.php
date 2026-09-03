<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::current();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_email' => 'nullable|email|max:255',
            'support_phone' => 'nullable|string|max:50',
            'whatsapp_number' => 'nullable|string|max:50',
            'bkash_number' => 'nullable|string|max:50',
            'nagad_number' => 'nullable|string|max:50',
            'rocket_number' => 'nullable|string|max:50',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:100',
            'bank_branch' => 'nullable|string|max:255',
            'payment_instructions' => 'nullable|string|max:3000',
            'order_processing_time' => 'nullable|string|max:100',
            'support_text' => 'nullable|string|max:2000',
            'privacy_policy' => 'nullable|string|max:10000',
            'terms_of_service' => 'nullable|string|max:10000',
            'refund_policy' => 'nullable|string|max:10000',
        ]);

        SiteSetting::current()->update($data);

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully.');
    }
}
