<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seo;

class SeoController extends Controller
{
    public function Seo()
    {
        $seo = Seo::first();
        return view('admin.seo.seo', compact('seo'));
    }

    public function UpdateSeo(Request $request, $id)
    {
        $seo = Seo::findOrFail($id)->update([
            'meta_title' => $request->meta_title,
            'meta_author' => $request->meta_author,
            'meta_tag' => $request->meta_tag,
            'meta_description' => $request->meta_description,
            'google_analytics' => $request->google_analytics,
            'bing_analytics' => $request->bing_analytics,
        ]);

        $notification = array(
            'message' => 'Seo Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
