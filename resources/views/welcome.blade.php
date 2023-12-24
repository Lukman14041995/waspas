@extends('master')

@section('title', 'Index')

@section('main-content')
<div class="text-primary dark:text-purple mt-20 font-semibold text-2xl tracking-wide">Dashboard</div>
<div class="p-4 rounded-lg mt-6 bg-gray-100 border border-purple dark:border-none shadow-md dark:bg-secondary">
    <div class="text-primary dark:text-purple m-4 font-semibold text-lg md:text-2xl tracking-wide">Selamat Datang</div>
</div>
<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
    <div>
        <div class="w-full max-w-sm bg-gray-100 dark:bg-purple border border-purple rounded-lg shadow-lg mt-10">
            <div class="px-5 pb-5 mt-4">
                <h3 class="text-xl font-bold mb-4 text-center md:text-left">Kriteria</h3>
                <p class="text-xs md:text-sm font-medium text-primary text-center md:text-left"></p>
                <div class="flex items-center justify-center md:justify-between mt-4">
                    <div class="md:inline block"></div>
                    <a href="{{ route('data-kriteria.index') }}" class="text-primary bg-dark-purple hover:bg-violet-600 hover:font-semibold focus:ring-1 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs md:text-sm px-3 md:px-5 py-1.5 md:py-2.5 text-center">Lihat Data</a>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="w-full max-w-sm bg-gray-100 dark:bg-purple border border-purple rounded-lg shadow-lg mt-10">
            <div class="px-5 pb-5 mt-4">
                <h3 class="text-xl font-bold mb-4 text-center md:text-left">Alternatif</h3>
                <p class="text-xs md:text-sm font-medium text-primary text-center md:text-left"></p>
                <div class="flex items-center justify-center md:justify-between mt-4">
                    <div class="md:inline block"></div>
                    <a href="{{ route('data-alternatif.index') }}" class="text-primary bg-dark-purple hover:bg-violet-600 hover:font-semibold focus:ring-1 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs md:text-sm px-3 md:px-5 py-1.5 md:py-2.5 text-center">Lihat Data</a>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="w-full max-w-sm bg-gray-100 dark:bg-purple border border-purple rounded-lg shadow-lg mt-10">
            <div class="px-5 pb-5 mt-4">
                <h3 class="text-xl font-bold mb-4 text-center md:text-left">Buat Matriks</h3>
                <p class="text-xs md:text-sm font-medium text-primary text-center md:text-left"></p>
                <div class="flex items-center justify-center md:justify-between mt-4">
                    <div class="md:inline block"></div>
                    <a href="{{ route('decision-matrix.create') }}" class="text-primary bg-dark-purple hover:bg-violet-600 hover:font-semibold focus:ring-1 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs md:text-sm px-3 md:px-5 py-1.5 md:py-2.5 text-center">Lihat Data</a>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="w-full max-w-sm bg-gray-100 dark:bg-purple border border-purple rounded-lg shadow-lg mt-10">
            <div class="px-5 pb-5 mt-4">
                <h3 class="text-xl font-bold mb-4 text-center md:text-left">Matriks Keputusan</h3>
                <p class="text-xs md:text-sm font-medium text-primary text-center md:text-left"></p>
                <div class="flex items-center justify-center md:justify-between mt-4">
                    <div class="md:inline block"></div>
                    <a href="{{ route('decision-matrix.index') }}" class="text-primary bg-dark-purple hover:bg-violet-600 hover:font-semibold focus:ring-1 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs md:text-sm px-3 md:px-5 py-1.5 md:py-2.5 text-center">Lihat Data</a>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="w-full max-w-sm bg-gray-100 dark:bg-purple border border-purple rounded-lg shadow-lg mt-10">
            <div class="px-5 pb-5 mt-4">
                <h3 class="text-xl font-bold mb-4 text-center md:text-left">Tabel Normalisasi</h3>
                <p class="text-xs md:text-sm font-medium text-primary text-center md:text-left"></p>
                <div class="flex items-center justify-center md:justify-between mt-4">
                    <div class="md:inline block"></div>
                    <a href="{{ route('normalisasi.index') }}" class="text-primary bg-dark-purple hover:bg-violet-600 hover:font-semibold focus:ring-1 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs md:text-sm px-3 md:px-5 py-1.5 md:py-2.5 text-center">Lihat Data</a>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="w-full max-w-sm bg-gray-100 dark:bg-purple border border-purple rounded-lg shadow-lg mt-10">
            <div class="px-5 pb-5 mt-4">
                <h3 class="text-xl font-bold mb-4 text-center md:text-left">Score dan Ranking</h3>
                <p class="text-xs md:text-sm font-medium text-primary text-center md:text-left"></p>
                <div class="flex items-center justify-center md:justify-between mt-4">
                    <div class="md:inline block"></div>
                    <a href="{{ route('score.index') }}" class="text-primary bg-dark-purple hover:bg-violet-600 hover:font-semibold focus:ring-1 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs md:text-sm px-3 md:px-5 py-1.5 md:py-2.5 text-center">Lihat Data</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection