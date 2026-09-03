<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;

class LegalPagesController extends Controller
{
    public function privacy()
    {
        return view('legal.privacy', ['content' => SiteSetting::current()->privacy_policy]);
    }

    public function terms()
    {
        return view('legal.terms', ['content' => SiteSetting::current()->terms_of_service]);
    }

    public function refund()
    {
        return view('legal.refund', ['content' => SiteSetting::current()->refund_policy]);
    }
}
