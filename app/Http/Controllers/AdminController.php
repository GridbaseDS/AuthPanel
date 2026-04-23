<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Plugin;
use App\Models\License;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_plugins' => Plugin::count(),
            'total_licenses' => License::count(),
            'active_licenses' => License::where('status', 'active')->count(),
            'inactive_licenses' => License::where('status', 'inactive')->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }

    public function plugins()
    {
        $plugins = Plugin::withCount('licenses')->get();
        return view('admin.plugins.index', compact('plugins'));
    }

    public function createPlugin()
    {
        return view('admin.plugins.create');
    }

    public function storePlugin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:plugins,slug',
            'type' => 'required|in:free,premium',
        ]);

        Plugin::create($request->all());
        return redirect()->route('plugins.index')->with('success', 'Plugin created successfully.');
    }

    public function licenses()
    {
        $licenses = License::with('plugin')->latest()->get();
        return view('admin.licenses.index', compact('licenses'));
    }

    public function revokeLicense($id)
    {
        $license = License::findOrFail($id);
        $license->update(['status' => 'inactive']);
        return redirect()->back()->with('success', 'License revoked successfully.');
    }
}
