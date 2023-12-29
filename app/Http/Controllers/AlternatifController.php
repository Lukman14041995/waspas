<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Anggota;
use Illuminate\Http\Request;
use DB;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newCode = $this->generateUniqueCode();
        $alternatif = Alternatif::orderBy('id', 'asc')->paginate(5);
        return view('alternatif.indexAlternatif', compact('alternatif', 'newCode'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    private function generateUniqueCode()
    {
        $latestCode = DB::table('table_alternatif')
            ->orderBy('kode_alternatif', 'desc')
            ->value('kode_alternatif');

        if (!$latestCode) {
            return 'KEL-0001';
        }

        $codeNumber = (int)substr($latestCode, -4);
        $newCodeNumber = $codeNumber + 1;
        $newCode = 'KEL-' . str_pad($newCodeNumber, 4, '0', STR_PAD_LEFT);

        return $newCode;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('alternatif.createAlternatif');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_sk' => 'required',
            'nama_alternatif' => 'required',
            'total_luas_tanah' => 'required|numeric',
            'nama_anggota.*' => 'required',
            'luas_tanah.*' => 'required|numeric',
        ]);

        $no_sk = $request->no_sk;
        $nama_alternatif = $request->nama_alternatif;
        $total_luas_tanah = $request->total_luas_tanah;
        $nama_anggota = $request->nama_anggota;
        $luas_tanah = $request->luas_tanah;

        // Simpan data anggota
        $anggotaData = [];
        foreach ($nama_anggota as $key => $nama) {
            $anggotaData[] = [
                'kode_alternatif' => $no_sk,
                'nama_anggota' => $nama,
                'luas_tanah' => $luas_tanah[$key],
            ];
        }

        Anggota::insert($anggotaData);

        // Simpan atau perbarui data alternatif
        Alternatif::updateOrCreate(
            ['kode_alternatif' => $no_sk],
            [
                'nama_alternatif' => $nama_alternatif,
                'luas_tanah' => $total_luas_tanah,
            ]
        );


        return redirect()->route('data-alternatif.index')->with('success', 'Alternatif Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Alternatif $alternatif)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $alternatif = Alternatif::find($id);
        return view('alternatif.editAlternatif', compact('alternatif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_alternatif' => 'required',
        ]);

        $alternatif = Alternatif::where('id', $id)->first();
        $alternatif->nama_alternatif = $request->get('nama_alternatif');

        $alternatif->save();
        return redirect()->route('data-alternatif.index')
            ->with('success', 'Data Alternatif Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Alternatif::find($id)->delete();
        return redirect()->route('data-alternatif.index')->with('success', 'Data Alternatif Berhasil Dihapus');
    }
}
