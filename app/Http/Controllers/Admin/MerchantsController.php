<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MerchantsController extends Controller
{
    // ✅ Index / List
    public function index()
    {
        $merchants = Merchant::with('user')->get();
        return view('admin.merchants.index', compact('merchants'));
    }

    // ✅ Show create form
    public function create()
    {
        return view('admin.merchants.create');
    }

    // ✅ Store merchant and create user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:merchants,email|unique:users,email',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:500',
            'store_name' => 'nullable|string|max:255',
            'trade_license' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
            'verified' => 'boolean',
            'wallet_balance' => 'nullable|numeric|min:0',
            'bank_info' => 'nullable|string|max:500',
            'nid_number' => 'nullable|string|max:50',
            'nid_front' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nid_back' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Handle file uploads
        $logoName = $request->file('logo') ? time().'_logo.'.$request->logo->extension() : null;
        $nidFrontName = $request->file('nid_front') ? time().'_nid_front.'.$request->nid_front->extension() : null;
        $nidBackName = $request->file('nid_back') ? time().'_nid_back.'.$request->nid_back->extension() : null;

        if ($request->hasFile('logo')) $request->logo->move(public_path('uploads/merchants'), $logoName);
        if ($request->hasFile('nid_front')) $request->nid_front->move(public_path('uploads/merchants'), $nidFrontName);
        if ($request->hasFile('nid_back')) $request->nid_back->move(public_path('uploads/merchants'), $nidBackName);

        // Create user first
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'merchant',
        ]);

        // Create merchant with user_id
        $merchant = Merchant::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'store_name' => $request->store_name,
            'trade_license' => $request->trade_license,
            'status' => $request->status,
            'verified' => $request->verified ?? false,
            'wallet_balance' => $request->wallet_balance ?? 0,
            'bank_info' => $request->bank_info,
            'nid_number' => $request->nid_number,
            'nid_front' => $nidFrontName,
            'nid_back' => $nidBackName,
            'logo' => $logoName,
        ]);

        return redirect()->route('admin.merchant.list')->with('success', 'Merchant and user created successfully.');
    }

    // ✅ Show edit form
    public function edit($id)
    {
        $merchant = Merchant::with('user')->findOrFail($id);
        return view('admin.merchants.edit', compact('merchant'));
    }

    // ✅ Update merchant and user
    public function update(Request $request, $id)
    {
        $merchant = Merchant::with('user')->findOrFail($id);
        $user = $merchant->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:merchants,email,$id|unique:users,email,".($user?->id ?? '0'),
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:500',
            'store_name' => 'nullable|string|max:255',
            'trade_license' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
            'verified' => 'boolean',
            'wallet_balance' => 'nullable|numeric|min:0',
            'bank_info' => 'nullable|string|max:500',
            'nid_number' => 'nullable|string|max:50',
            'nid_front' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nid_back' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            'status' => $request->status,
            'verified' => $request->verified ?? false,
            'wallet_balance' => $request->wallet_balance ?? 0,
            'bank_info' => $request->bank_info,
            'nid_number' => $request->nid_number,
            'nid_front' => $nidFrontName,
            'nid_back' => $nidBackName,
            'logo' => $logoName,
        ]);

        // Update user
        if($user) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        return redirect()->route('admin.merchant.list')->with('success', 'Merchant and user updated successfully.');
    }

    // ✅ Delete merchant and user
    public function destroy($id)
    {
        $merchant = Merchant::with('user')->findOrFail($id);
        $user = $merchant->user;

        // Delete files
        foreach (['logo','nid_front','nid_back'] as $file) {
            if($merchant->$file && file_exists(public_path('uploads/merchants/'.$merchant->$file))) {
                unlink(public_path('uploads/merchants/'.$merchant->$file));
            }
        }

        if($user) $user->delete();
        $merchant->delete();

        return redirect()->route('admin.merchant.list')->with('success', 'Merchant and user deleted successfully.');
    }
}
