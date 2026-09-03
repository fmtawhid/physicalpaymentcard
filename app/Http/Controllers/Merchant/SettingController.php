<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    // Show edit form
    public function index()
    {
        $user = Auth::user();
        $merchant = $user->merchant; // relation ব্যবহার

        return view('merchant.setting.edit_info', compact('user', 'merchant'));
    }

    // Update info
    public function update(Request $request)
    {
        $user = Auth::user();
        $merchant = $user->merchant;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,".$user->id,
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:500',
            'store_name' => 'nullable|string|max:255',
            'trade_license' => 'nullable|string|max:255',
            'wallet_balance' => 'nullable|numeric|min:0',
            'bank_info' => 'nullable|string|max:500',
            'nid_number' => 'nullable|string|max:50',
            'nid_front' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nid_back' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
            'verified' => 'boolean',
        ]);

        // Handle file uploads
        $logoName = $merchant->logo;
        $nidFrontName = $merchant->nid_front;
        $nidBackName = $merchant->nid_back;

        if ($request->hasFile('logo')) {
            if($logoName && file_exists(public_path('uploads/merchants/'.$logoName))) unlink(public_path('uploads/merchants/'.$logoName));
            $logoName = time().'_logo.'.$request->logo->extension();
            $request->logo->move(public_path('uploads/merchants'), $logoName);
        }

        if ($request->hasFile('nid_front')) {
            if($nidFrontName && file_exists(public_path('uploads/merchants/'.$nidFrontName))) unlink(public_path('uploads/merchants/'.$nidFrontName));
            $nidFrontName = time().'_nid_front.'.$request->nid_front->extension();
            $request->nid_front->move(public_path('uploads/merchants'), $nidFrontName);
        }

        if ($request->hasFile('nid_back')) {
            if($nidBackName && file_exists(public_path('uploads/merchants/'.$nidBackName))) unlink(public_path('uploads/merchants/'.$nidBackName));
            $nidBackName = time().'_nid_back.'.$request->nid_back->extension();
            $request->nid_back->move(public_path('uploads/merchants'), $nidBackName);
        }

        // Update merchant
        $merchant->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'store_name' => $request->store_name,
            'trade_license' => $request->trade_license,
            'wallet_balance' => $request->wallet_balance ?? 0,
            'bank_info' => $request->bank_info,
            'nid_number' => $request->nid_number,
            'nid_front' => $nidFrontName,
            'nid_back' => $nidBackName,
            'logo' => $logoName,
            'status' => $request->status,
            'verified' => $request->verified ?? false,
        ]);

        // Update user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('merchant.settings.edit')->with('success', 'Your merchant profile has been updated successfully.');
    }
}
