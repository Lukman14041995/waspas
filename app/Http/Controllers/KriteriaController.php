<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;


class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::orderBy('id', 'asc')->paginate(5);
        return view('kriteria.indexKriteria', compact('kriteria'))->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create(){
        return view('kriteria.createKriteria');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'bobot_kriteria' => 'required',
            'jenis_kriteria' => 'required|in:cost,benefit',
        ]);
        Kriteria::create($request->all());

        return redirect()->route('data-kriteria.index')->with('success', 'Data kriteria berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $kriteria = Kriteria::find($id);
        return view('kriteria.editKriteria', compact('kriteria'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'bobot_kriteria' => 'required',
            'jenis_kriteria' => 'required|in:cost,benefit',
        ]);
        $kriteria = Kriteria::where('id', $id)->first();
        $kriteria->nama_kriteria = $request->get('nama_kriteria');
        $kriteria->bobot_kriteria = $request->get('bobot_kriteria');
        $kriteria->jenis_kriteria = $request->get('jenis_kriteria');

        $kriteria->save();
        return redirect()->route('data-kriteria.index')->with('success', 'Data kriteria berhasil diubah.');
    }

    public function destroy($id)
    {
       Kriteria::find($id)->delete();
       return redirect()->route('data-kriteria.index')->with('success', 'Data kriteria berhasil dihapus.');
    }
}
