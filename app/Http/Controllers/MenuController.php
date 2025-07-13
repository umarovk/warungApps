<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::ordered()->get();
        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        $kategoriList = Menu::getKategoriList();
        return view('menus.create', compact('kategoriList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:makanan,minuman',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $gambarPath = null;
        
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $gambarPath = $file->storeAs('public/menu-images', $fileName);
            $gambarPath = str_replace('public/', '', $gambarPath);
        }

        Menu::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'gambar' => $gambarPath,
            'status' => true,
            'urutan' => $request->urutan ?? Menu::max('urutan') + 1
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $kategoriList = Menu::getKategoriList();
        return view('menus.edit', compact('menu', 'kategoriList'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|in:makanan,minuman',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $gambarPath = $menu->gambar; // Keep existing image if no new one uploaded
        
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($menu->gambar && Storage::disk('public')->exists($menu->gambar)) {
                Storage::disk('public')->delete($menu->gambar);
            }
            
            // Upload new image
            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $gambarPath = $file->storeAs('public/menu-images', $fileName);
            $gambarPath = str_replace('public/', '', $gambarPath);
        }

        $menu->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'gambar' => $gambarPath,
            'status' => $request->has('status'),
            'urutan' => $request->urutan ?? $menu->urutan
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        
        // Delete image if exists
        if ($menu->gambar && Storage::disk('public')->exists($menu->gambar)) {
            Storage::disk('public')->delete($menu->gambar);
        }
        
        $menu->delete();
        
        return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus!');
    }
} 