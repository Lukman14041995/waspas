@extends('master')

@section('title', 'Index')

@section('main-content')
<div class="p-4 border border-purple mt-14 dark:border-none shadow-md rounded-lg bg-gray-100 dark:bg-secondary">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="pull-left px-6 py-2">
            <div class="text-primary dark:text-purple m-4 font-semibold text-2xl tracking-wide">Tabel Normalisasi</div>
        </div>
        <br>
        @if(!empty($normalisasiTable))
        <div class="relative overflow-x-auto shadow-md rounded-lg md:mx-20">
        <table class="w-full text-sm">
            <thead class="text-xs text-primary dark:text-purple uppercase bg-purple dark:bg-table-head">
                <tr>
                    <th scope="col" class="px-6 py-3">Alternatif</th>
                        @foreach($kriteriaNames as $kriteriaId => $kriteriaName)
                    <th scope="col" class="px-6 py-3">{{ $kriteriaName }}</th>
                        @endforeach
                </tr>
                </thead>
                <tbody class="text-xs md:text-base">
                    @foreach($normalisasiTable as $alternatifId => $kriteriaValues)
                    <tr class="bg-gray-100 dark:bg-primary border-b border-primary dark:border-purple last:border-0 text-primary dark:text-purple">
                        <th scope="row" class="text-center py-4 font-medium whitespace-nowrap dark:text-white">{{ \App\Models\Alternatif::find($alternatifId)->nama_alternatif }}</th>
                            @foreach($kriteriaNames as $kriteriaId => $kriteriaName)
                        <th scope="row" class="text-center py-4 font-medium whitespace-nowrap dark:text-white">{{ $kriteriaValues[$kriteriaId] ?? '' }}</th>
                            @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p>Tidak ada data Decision Matrix yang tersimpan.</p>
        @endif
    </div>
</div>
@endsection
