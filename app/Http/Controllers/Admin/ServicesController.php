<?php

namespace App\Http\Controllers\Admin;

use App\Models\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    // Menampilkan semua layanan
    public function index()
    {
        $services = Services::all();
        return view('admin.services.index', compact('services'));
    }

    // Menampilkan form untuk menambah layanan
    public function create()
    {
        return view('admin.services.create');
    }

    // Menyimpan layanan baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:1',
            'duration' => 'required|numeric|min:1',
        ]);

        $service = new Services();
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->duration = $request->duration;

        $service->save();

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit layanan
    public function edit(Services $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    // Memperbarui layanan
    public function update(Request $request, Services $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $service->name = $request->name;
        $service->description = $request->description;

        $service->save();

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui');
    }

    // Menghapus layanan
    public function destroy(Services $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus');
    }
}
