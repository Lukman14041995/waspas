<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Anggota;
use App\Models\ChildKriteria;
use App\Models\ValueKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        // Log::info('Data alternatif berhasil dimuat'); // Pesan log ditambahkan di sini
        return view('alternatif.indexAlternatif', compact('alternatif', 'newCode'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function getdata()
    {
        $newCode = $this->generateUniqueCode();

        $alternatif = Alternatif::all();
        // dd($alternatif);
        // Log::info('Data alternatif berhasil dimuat'); // Pesan log ditambahkan di sini
        return view('alternatif.getKelompok', compact('alternatif', 'newCode'));
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
        // dd($request->all());
        $request->validate([
            'nama_alternatif' => 'required',
            'total_luas_tanah' => 'required|numeric',
            'nama_anggota.*' => 'required',
            'luas_tanah.*' => 'required|numeric',
        ]);

        $no_sk = $request->no_sk;
        $kode_alternatif = $request->kode_kelompok;
        $nama_alternatif = $request->nama_alternatif;
        $total_luas_tanah = $request->total_luas_tanah;
        $nama_anggota = $request->nama_anggota;
        $luas_tanah = $request->luas_tanah;
        $kode_kriteria = $request->kode_kriteria;
        $karakter = $request->karakter_kriteria;
        $id_opsi = $request->id_opsi;
        $value_Kriteria = $request->value_kriteria;

        // Simpan data anggota
        if ($kode_kriteria == '') {
            $anggotaData = [];
            foreach ($nama_anggota as $key => $nama) {
                $anggotaData[] = [
                    'kode_alternatif' => $kode_alternatif,
                    'no_sk' => $no_sk,
                    'nama_anggota' => $nama,
                    'luas_tanah' => $luas_tanah[$key],
                ];
            }

            Anggota::insert($anggotaData);

            // Simpan atau perbarui data alternatif
            Alternatif::updateOrCreate(
                ['kode_alternatif' => $kode_alternatif],
                [
                    'no_sk' => $no_sk,
                    'nama_alternatif' => $nama_alternatif,
                    'luas_tanah' => $total_luas_tanah,
                ]
            );
        } else {
            $anggotaData = [];
            foreach ($nama_anggota as $key => $nama) {
                $anggotaData[] = [
                    'kode_alternatif' => $kode_alternatif,
                    'no_sk' => $no_sk,
                    'nama_anggota' => $nama,
                    'luas_tanah' => $luas_tanah[$key],
                ];
            }

            Anggota::insert($anggotaData);

            // Simpan atau perbarui data alternatif
            Alternatif::updateOrCreate(
                [
                    'kode_alternatif' => $kode_alternatif,
                    'no_sk' => $no_sk,
                    'nama_alternatif' => $nama_alternatif,
                    'luas_tanah' => $total_luas_tanah,
                ],
                [
                    'no_sk' => $no_sk,
                    'nama_alternatif' => $nama_alternatif,
                    'luas_tanah' => $total_luas_tanah,
                ]
            );

            // Simpan data kriteria berdasarkan karakter
            // dd($karakter);
            foreach ($karakter as $kar => $valuekarakter) {
                if ($valuekarakter == 1) {
                    $value_Kriteria = [];

                    foreach ($kode_kriteria as $key => $kode) {
                        $jawaban = isset($value_Kriteria[$key]['jawaban']) ? $value_Kriteria[$key]['jawaban'] : '';

                        // Memeriksa apakah data sudah ada sebelumnya
                        $existingData = ValueKriteria::where([
                            'kode_alternatif' => $kode_alternatif,
                            'kode_kriteria' => $kode,
                        ])->first();

                        if (!$existingData) {
                            $value_Kriteria[] = [
                                'jawaban' => empty($jawaban) ? "Belum diisi" : $jawaban,
                                'skor' => empty($jawaban) ? "0" : "10",
                                'kode_kriteria' => $kode,
                                'kode_alternatif' => $kode_alternatif,
                            ];
                        }
                    }

                    ValueKriteria::insert($value_Kriteria);
                } elseif ($valuekarakter == 2) {
                    $id_opsiData = [];

                    foreach ($id_opsi as $key => $value) {
                        // Memeriksa apakah data sudah ada sebelumnya
                        $existingData = ValueKriteria::where([
                            'kode_alternatif' => $kode_alternatif,
                            'kode_kriteria' => $kode_kriteria[$key],
                            'jawaban' => $value,
                        ])->first();

                        if (!$existingData) {
                            $skors = ChildKriteria::where('id', $value)->first();
                            $id_opsiData[] = [
                                'jawaban' => $value,
                                'skor' => $skors->skor,
                                'kode_kriteria' => $kode_kriteria[$key],
                                'kode_alternatif' => $kode_alternatif,
                            ];
                        }
                    }

                    ValueKriteria::insert($id_opsiData);
                }
            }
        }

        // dd($karakter);





        return redirect()->route('getdata')->with('success', 'Alternatif Berhasil Ditambahkan');
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
        return redirect()->route('getdata')
            ->with('success', 'Data Alternatif Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        // dd($request->all());
        $alternatif = Alternatif::find($id);

        if ($alternatif) {
            $alternatif->delete();
            return redirect()->route('getdata')->with('success', 'Data Alternatif Berhasil Dihapus');
        } else {
            return redirect()->route('getdata')->with('error', 'Data Alternatif Tidak Ditemukan');
        }
    }
}
