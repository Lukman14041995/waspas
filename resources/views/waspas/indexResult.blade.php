@extends('master')

@section('title', 'Index')

@section('main-content')
<div class="p-4 border border-purple mt-14 dark:border-none shadow-md rounded-lg bg-gray-100 dark:bg-secondary">
    <div class="container">
        <div class="pull-left px-6 py-2">
            <div class="text-primary dark:text-purple m-4 font-semibold text-2xl tracking-wide">Score dan Ranking</div>
        </div>
        @if(!empty($waspasScores))
        <div class="relative overflow-x-auto shadow-md rounded-lg md:mx-20">
            <table class="w-full text-sm">
                <thead class="text-xs text-primary dark:text-purple uppercase bg-purple dark:bg-table-head">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Ranking
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Alternatif
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Score
                        </th>
                    </tr>
                </thead>
                <tbody class="text-xs md:text-base">
                    @foreach($ranking as $rank => $idAlternatif)
                    <tr class="bg-gray-100 dark:bg-primary border-b border-primary dark:border-purple last:border-0 text-primary dark:text-purple">
                        <td class="text-center py-4">{{$rank + 1}}</th>
                        <td class="text-center py-4">{{$alternatifNames[$idAlternatif]}}</th>
                        <td class="text-center py-4">{{$waspasScores[$idAlternatif]}}</th>
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
