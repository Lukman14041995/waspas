<?php

namespace App\Http\Controllers;

use App\Models\ChildKriteria;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class KriteriaController extends Controller
{
    public function index()
    {
        $newCode = $this->generateUniqueCode();
        $kriteria = Kriteria::orderBy('id', 'asc')->paginate(5);
        $child = ChildKriteria::get();
        return view('kriteria.indexKriteria', compact('kriteria', 'newCode', 'child'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    private function generateUniqueCode()
    {
        $latestCode = DB::table('kriteria')
            ->orderBy('kode_kriteria', 'desc')
            ->value('kode_kriteria');

        if (!$latestCode) {
            return 'KRI-0001';
        }

        $codeNumber = (int)substr($latestCode, -4);
        $newCodeNumber = $codeNumber + 1;
        $newCode = 'KRI-' . str_pad($newCodeNumber, 4, '0', STR_PAD_LEFT);

        return $newCode;
    }


    public function create()
    {
        return view('kriteria.createKriteria');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'bobot_kriteria' => 'required',
            'jenis_kriteria' => 'required|in:cost,benefit',
            'karakter_kriteria' => 'required|in:1,2'

        ]);

        $kode_kriteria = $request->kode_kriteria;
        $nama_kriteria = $request->nama_kriteria;
        $bobot_kriteria = $request->bobot_kriteria;
        $jenis_kriteria = $request->jenis_kriteria;
        $karakter_kriteria = $request->karakter_kriteria;
        $jawaban = $request->jawaban;
        $skor = $request->skor;
        // dd($nama_kriteria);
        // Simpan data child kriteria
        if ($karakter_kriteria == 2) {
            $childKriteriaData = [];
            foreach ($jawaban as $key => $jwb) {
                $childKriteriaData[] = [
                    'kode_kriteria' => $kode_kriteria,
                    'jawaban' => $jwb,
                    'skor' => $skor[$key],
                ];
            }

            ChildKriteria::insert($childKriteriaData);
            Kriteria::updateOrInsert(
                ['kode_kriteria' => $kode_kriteria],
                [
                    'nama_kriteria' => $nama_kriteria,
                    'bobot_kriteria' => $bobot_kriteria,
                    'jenis_kriteria' => $jenis_kriteria,
                    'karakter_kriteria' => $karakter_kriteria,
                ]
            );
        } else {
            Kriteria::updateOrInsert(
                ['kode_kriteria' => $kode_kriteria],
                [
                    'nama_kriteria' => $nama_kriteria,
                    'bobot_kriteria' => $bobot_kriteria,
                    'jenis_kriteria' => $jenis_kriteria,
                    'karakter_kriteria' => $karakter_kriteria,
                ]
            );
        }


        // Simpan atau update data kriteria


        return redirect()->route('data-kriteria.index')->with('success', 'Data kriteria berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $kriteria = Kriteria::find($id);
        $child = ChildKriteria::where('kode_kriteria', $kriteria->kode_kriteria)->get();
        return view('kriteria.editKriteria', compact('kriteria', 'child'));
    }
    public function hapus(Request $request, $id)
    {
        $childKriteria = ChildKriteria::find($id);

        if (!$childKriteria) {
            return back()->with('error', 'Data tidak ditemukan.');
        }

        $childKriteria->delete();

        // Setelah penghapusan, kembalikan respons JSON
        return back();
    }
    public function opsi(Request $request)
    {
        $kode = $request->kode_kriteria;
        $childKriteria = ChildKriteria::where('kode_kriteria', $request->kode_kriteria)->get();
        // dd($childKriteria);
        return view('kriteria.OpsiKriteria', compact('childKriteria', 'kode'));
    }
    public function Inputopsi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_kriteria' => 'required',

        ]);

        $kode = $request->kode_kriteria;

        $jawaban = $request->jawaban;
        $skor = $request->skor;
        // dd($nama_kriteria);
        // Simpan data child kriteria

        $childKriteriaData = [];
        foreach ($jawaban as $key => $jwb) {
            $childKriteriaData[] = [
                'kode_kriteria' => $kode,
                'jawaban' => $jwb,
                'skor' => $skor[$key],
            ];
        }

        ChildKriteria::insert($childKriteriaData);
        $childKriteria = ChildKriteria::where('kode_kriteria', $kode)->get();
        return view('kriteria.OpsiKriteria', compact('childKriteria', 'kode'));
    }
    public function updateopsi(Request $request)
    {
        // dd($request->all());
        $request->validate([

            'jawaban' => 'required',
            'skor' => 'required',
        ]);
        $kode = $request->kode_kriteria;
        $opsi = ChildKriteria::where('id', $request->id)->update(['jawaban' => $request->jawaban, 'skor' => $request->skor]);
        $child = ChildKriteria::where('id', $request->id)->first();
        $childKriteria = ChildKriteria::where('kode_kriteria', $kode)->get();
        return view('kriteria.OpsiKriteria', compact('childKriteria', 'kode'));
    }
    public function deleteopsi(Request $request)
    {
        // dd($request->all());
        $kode = $request->kode_kriteria;

        $opsi = ChildKriteria::where('id', $request->id)->delete();
        $child = ChildKriteria::where('id', $request->id)->first();
        // dd($child);
        $childKriteria = ChildKriteria::where('kode_kriteria', $kode)->get();
        return view('kriteria.OpsiKriteria', compact('childKriteria', 'kode'));
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
