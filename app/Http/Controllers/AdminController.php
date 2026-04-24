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
        return redirect()->route('plugins.index')->with('success', 'Plugin creado exitosamente.');
    }

    public function editPlugin($id)
    {
        $plugin = Plugin::findOrFail($id);
        return view('admin.plugins.edit', compact('plugin'));
    }

    public function updatePlugin(Request $request, $id)
    {
        $plugin = Plugin::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:plugins,slug,' . $plugin->id,
            'type' => 'required|in:free,premium',
        ]);

        $plugin->update($request->all());
        return redirect()->route('plugins.index')->with('success', 'Plugin actualizado exitosamente.');
    }

    public function licenses()
    {
        $licenses = License::with('plugin')->latest()->get();
        return view('admin.licenses.index', compact('licenses'));
    }

    public function createLicense()
    {
        $plugins = Plugin::where('type', 'premium')->get();
        return view('admin.licenses.create', compact('plugins'));
    }

    public function storeLicense(Request $request)
    {
        $request->validate([
            'plugin_id' => 'required|exists:plugins,id',
        ]);

        $custom_key = 'GB-' . strtoupper(\Illuminate\Support\Str::random(4)) . '-' . strtoupper(\Illuminate\Support\Str::random(4)) . '-' . strtoupper(\Illuminate\Support\Str::random(4));

        License::create([
            'plugin_id' => $request->plugin_id,
            'domain' => null,
            'license_key' => $custom_key,
            'status' => 'unused',
        ]);

        return redirect()->route('licenses.index')->with('success', 'Llave Premium Manual generada correctamente: ' . $custom_key);
    }

    public function revokeLicense($id)
    {
        $license = License::findOrFail($id);
        $license->update(['status' => 'inactive']);
        return redirect()->back()->with('success', 'License revoked successfully.');
    }
}
