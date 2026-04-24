<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Plugin;
use App\Models\License;
use Illuminate\Support\Str;

class LicenseController extends Controller
{
    public function autoRegister(Request $request)
    {
        $request->validate([
            'domain' => 'required|string',
            'plugin_slug' => 'required|string',
        ]);

        $plugin = Plugin::where('slug', $request->plugin_slug)->first();

        if (!$plugin) {
            return response()->json(['success' => false, 'message' => 'Plugin not found', 'code' => 'plugin_not_found'], 404);
        }

        // Premium plugins cannot be auto-registered — they require a manual key
        if ($plugin->type === 'premium') {
            return response()->json([
                'success' => false,
                'message' => 'Este es un plugin Premium. Requiere una llave de licencia para activarse.',
                'code' => 'premium_requires_key'
            ], 403);
        }

        // Generate a new license key
        $licenseKey = (string) Str::uuid();

        // Check if there is already a license for this domain and plugin
        $license = License::where('plugin_id', $plugin->id)
            ->where('domain', $request->domain)
            ->first();

        if ($license) {
            // Re-activate existing license
            $license->update([
                'status' => 'active',
                'license_key' => $licenseKey // Generate a new one anyway
            ]);
        } else {
            $license = License::create([
                'plugin_id' => $plugin->id,
                'domain' => $request->domain,
                'license_key' => $licenseKey,
                'status' => 'active',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'license_key' => $license->license_key,
                'status' => $license->status,
                'plugin' => $plugin->name,
                'type' => $plugin->type,
            ]
        ]);
    }

    public function activate(Request $request)
    {
        // This is for manual activation using a key
        $request->validate([
            'domain' => 'required|string',
            'plugin_slug' => 'required|string',
            'license_key' => 'required|string',
        ]);

        $license = License::where('license_key', $request->license_key)
            ->whereHas('plugin', function($q) use ($request) {
                $q->where('slug', $request->plugin_slug);
            })->first();

        if (!$license) {
            return response()->json(['success' => false, 'message' => 'Clave de licencia inválida para este plugin.', 'code' => 'invalid_key'], 404);
        }

        if ($license->status === 'active' && $license->domain !== $request->domain) {
            return response()->json(['success' => false, 'message' => 'Esta licencia ya está vinculada a otro dominio.', 'code' => 'key_in_use'], 403);
        }

        if ($license->status !== 'active' || $license->domain !== $request->domain) {
            $license->update([
                'domain' => $request->domain,
                'status' => 'active',
                'email' => $request->email ?? $license->email,
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'status' => 'active',
                'license_key' => $license->license_key
            ]
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'license_key' => 'required|string',
            'plugin_slug' => 'required|string',
            'domain' => 'required|string', // To ensure it is for this domain
        ]);

        $license = License::where('license_key', $request->license_key)
            ->where('domain', $request->domain)
            ->where('status', 'active')
            ->whereHas('plugin', function($q) use ($request) {
                $q->where('slug', $request->plugin_slug);
            })->first();

        if ($license) {
            return response()->json([
                'success' => true,
                'data' => ['status' => 'active']
            ]);
        }

        return response()->json(['success' => false, 'message' => 'License inactive or invalid'], 404);
    }

    public function deactivate(Request $request)
    {
        $request->validate([
            'license_key' => 'required|string',
        ]);

        $license = License::where('license_key', $request->license_key)->first();
        if ($license) {
            $license->update(['status' => 'inactive']);
        }

        return response()->json(['success' => true]);
    }

    public function renderUi(Request $request)
    {
        $request->validate([
            'plugin_slug' => 'required|string',
            'domain' => 'nullable|string',
            'license_key' => 'nullable|string',
        ]);

        $plugin = Plugin::where('slug', $request->plugin_slug)->first();

        if (!$plugin) {
            $html = view('api.ui.error')->render();
            return response()->json(['success' => false, 'html' => $html]);
        }

        // Check if there's an active license for this domain
        $license = null;
        if ($request->license_key && $request->domain) {
            $license = License::where('license_key', $request->license_key)
                ->where('domain', $request->domain)
                ->where('plugin_id', $plugin->id)
                ->where('status', 'active')
                ->first();
        }

        if ($license) {
            // Render Active layout
            $masked_key = str_repeat('*', max(0, strlen($license->license_key) - 4)) . substr($license->license_key, -4);
            $html = view('api.ui.active', compact('masked_key'))->render();
            return response()->json(['success' => true, 'status' => 'active', 'html' => $html]);
        }

        // Render Inactive layout based on plugin type
        if ($plugin->type === 'premium') {
            $html = view('api.ui.premium')->render();
        } else {
            $html = view('api.ui.free')->render();
        }

        return response()->json(['success' => true, 'status' => 'inactive', 'html' => $html]);
    }
}
