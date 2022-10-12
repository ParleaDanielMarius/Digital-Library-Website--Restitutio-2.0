<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangController extends Controller
{

    // Home View
    public function home()
    {
        // Query for latest active items
        $latestItems = Item::query()
            ->with(['authors:slug,fullname', 'collections:slug,title'])
            ->where('status', Item::STATUS_ACTIVE)->latest()->limit(12)
            ->get();

        // Query for latest active manuscripts
        $latestManuscripts = Item::query()
            ->with(['authors:slug,fullname', 'collections:slug,title'])
            ->where('status', Item::STATUS_ACTIVE)
            ->where('type', Item::type_Manuscript)
            ->latest()->limit(12)
            ->get();
        // Query for latest active periodics
        $latestPeriodics = Item::query()
            ->with(['authors:slug,fullname', 'collections:slug,title'])
            ->where('status', Item::STATUS_ACTIVE)
            ->where('type', Item::type_Periodic)
            ->latest()->limit(12)
            ->get();

        return view('home', [
            'latestItems' => $latestItems,
            'latestPeriodics' => $latestPeriodics,
            'latestManuscripts' => $latestManuscripts,
            // This should be changed to something else instead of the latest
            'featuredCollections' => Collection::query()->latest()->select('slug', 'title', 'cover_path')->limit(3)->get(),
        ]);
    }

    // Change locale (Language)
    public function change(Request $request)
    {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);

        return redirect()->back();
    }
}
