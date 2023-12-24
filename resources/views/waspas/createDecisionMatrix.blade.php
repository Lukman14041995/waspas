@extends('master')

@section('title', 'Index')

@section('main-content')
<div class="p-4 border border-purple mt-14 dark:border-none shadow-md rounded-lg bg-gray-100 dark:bg-secondary">
    <div class="flex gap-6 flex-wrap">
        @foreach ($alternatif as $item)
        @if (!$item->isUsed())
        <form method="post" action="{{ route('decision-matrix.store') }}" id="myForm" enctype="multipart/form-data" class="max-w-sm mx-auto">
            @csrf
            <div class="flex items-center justify-center">
                <div class="bg-white shadow dark:bg-gray-700 p-6 rounded-xl">
                    <h5 class="mb-2 text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Input Nilai Decision Matrix untuk Alternatif {{ $item->nama_alternatif }}</h5>
                    <div class="card-body">
                        <form class="max-w-sm mx-auto">
                            <div class="mb-2">
                                <label for="alternatif" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Alternatif : </label>
                                <input type="text" id="alternatif" value="{{ $item->nama_alternatif }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
                            </div>
                            @foreach ($kriteria as $kriteriaItem)
                                <div class="mb-2">
                                    <label for="value_{{ $kriteriaItem->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $kriteriaItem->nama_kriteria }} : </label>
                                    <input type="text" id="value_{{ $kriteriaItem->id }}" name="value_{{ $item->id }}_{{ $kriteriaItem->id }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
                                </div>
                            @endforeach
                            <br>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
                
        </form>
        @endif
            @endforeach
        {{-- <div class="bg-white shadow dark:bg-gray-700 p-6 rounded-xl"> --}}
            {{-- <form method="post" action="{{ route('decision-matrix.store') }}" id="myForm" enctype="multipart/form-data" class="max-w-sm mx-auto">
                <h5 class="mb-2 text-2xl tracking-tight text-gray-900 dark:text-white">Input Nilai Decision Matrix untuk Alternatif {{ $item->nama_alternatif }}</h5>
                <div class="mb-5">
                    <label for="alternatif" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                    <input type="email" id="alternatif" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="name@flowbite.com" required>
                </div>
                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                    <input type="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
                </div>
                <div class="mb-5">
                    <label for="repeat-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repeat password</label>
                    <input type="password" id="repeat-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register new account</button>
            </form> --}}
        {{-- </div> --}}
        
    </div>
</div>
@endsection
