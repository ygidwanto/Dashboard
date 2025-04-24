<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\Pelanggan;

class DashboardController extends Controller
{
    public function index(Request $request){
        // Query dasar
        $query = Dokumen::with('pelanggan');
        
        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        // Filter tanggal awal
        if ($request->has('tanggal_awal') && $request->tanggal_awal != '') {
            $query->whereDate('tanggal', '>=', $request->tanggal_awal);
        }
        
        // Filter tanggal akhir
        if ($request->has('tanggal_akhir') && $request->tanggal_akhir != '') {
            $query->whereDate('tanggal', '<=', $request->tanggal_akhir);
        }
        
        // Filter pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('dokumen', 'like', '%'.$search.'%')
                  ->orWhere('nr', 'like', '%'.$search.'%')
                  ->orWhereHas('pelanggan', function($q) use ($search) {
                      $q->where('nama', 'like', '%'.$search.'%')
                        ->orWhere('no_pelanggan', 'like', '%'.$search.'%');
                  });
            });
        }
        
        // Pagination
        $dokumens = $query->orderBy('tanggal', 'desc')->paginate(10);
        
        // Data pelanggan untuk dropdown
        $pelanggans = Pelanggan::all();
        
        return view('dashboard', compact('dokumens', 'pelanggans'));
    }

    public function store(Request $request){
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'status' => 'required|in:confirmed,shipped',
            'dokumen' => 'required|string',
            'nr' => 'required|string',
            'tanggal' => 'required|date',
            'realisasi' => 'required|date',
            'tanggal_awal' => 'required|date',
        ]);

        Dokumen::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id){
        $request->validate([
            'status' => 'required|in:confirmed,shipped',
            'dokumen' => 'required|string',
            'nr' => 'required|string',
            'tanggal' => 'required|date',
            'realisasi' => 'required|date',
            'tanggal_awal' => 'required|date',
            'pelanggan_id' => 'required|exists:pelanggans,id',
        ]);

        $dokumen = Dokumen::findOrFail($id);
        $dokumen->update($request->only([
            'status', 'dokumen', 'nr', 'tanggal', 'realisasi', 'tanggal_awal', 'pelanggan_id'
        ]));

        return redirect()->back()->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy($id){
        // Cari dokumen berdasarkan ID
        $dokumen = Dokumen::findOrFail($id);
        
        // Hapus dokumen
        $dokumen->delete();
        
        // Redirect dengan pesan sukses
        return redirect()->route('dashboard')
            ->with('success', 'Dokumen berhasil dihapus');
    }

}
