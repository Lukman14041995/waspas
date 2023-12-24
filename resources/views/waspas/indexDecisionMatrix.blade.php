@extends('master')

@section('title', 'Index')

@section('main-content')
<div class="p-4 border border-purple mt-14 dark:border-none shadow-md rounded-lg bg-gray-100 dark:bg-secondary">
    <div class="row">
        <div class="flex justify-between">
            <div class="px-6 py-2">
                <div class="text-primary dark:text-purple m-4 font-semibold text-2xl tracking-wide">Decision matrix</div>
            </div>
        </div>
        @if(!empty($matrixTable))
        <div class="relative overflow-x-auto shadow-md rounded-lg md:mx-20">
            <table class="w-full text-sm">
                <thead class="text-xs text-primary dark:text-purple uppercase bg-purple dark:bg-table-head">
                    <tr>
                        <th scope="col" class="px-6 py-3">Alternatif</th>
                        @foreach($kriteriaNames as $kriteriaId => $kriteriaName)
                        <th  scope="col" class="px-6 py-3">{{ $kriteriaName }}</th>
                        @endforeach
                        <th  scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-xs md:text-base">
                    @foreach($matrixTable as $alternatifId => $kriteriaValues)
                    <tr class="bg-gray-100 dark:bg-primary border-b border-primary dark:border-purple last:border-0 text-primary dark:text-purple">
                        <td scope="row" class="text-center py-4 font-medium whitespace-nowrap dark:text-white">{{ \App\Models\Alternatif::find($alternatifId)->nama_alternatif }}</td>
                            @foreach($kriteriaNames as $kriteriaId => $kriteriaName)
                            {{-- @dd($kriteriaValues[$kriteriaId]) --}}
                        <td scope="row" class="text-center py-4 font-medium whitespace-nowrap dark:text-white">{{ $kriteriaValues[$kriteriaId] ?? '' }}</td>
                            @endforeach
                        <td class="flex items-center justify-center">
                            <div class="">
                                <button data-modal-target="delete-modal-{{$alternatifId}}" data-modal-toggle="delete-modal-{{$alternatifId}}" class="bg-red-500 hover:bg-red-600 text-primary font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Hapus
                                </button>
                                <div id="delete-modal-{{$alternatifId}}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="delete-modal-{{$alternatifId}}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-6 text-center space-x-10">
                                                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Anda yakin ingin menghapus alternatif ini?</h3>
                                                <form action="{{ route('decision-matrix.destroy', $alternatifId) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="flex justify-center">
                                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                            Ya
                                                        </button>
                                                        <button data-modal-hide="delete-modal-{{$alternatifId}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600 mx-2">Tidak</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <button data-modal-target="edit-modal-{{$alternatifId}}" data-modal-toggle="edit-modal-{{$alternatifId}}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                    Edit
                                </button>
                                  <div id="edit-modal-{{$alternatifId}}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Edit Kriteria
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-modal-{{$alternatifId}}">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                             <form class="p-4 md:p-5" method="post" action="{{ route('decision-matrix.update', $alternatifId) }}">
                                                @csrf
                                                @method('PUT')
                                                
                                                <div class="relative overflow-x-auto shadow-md rounded-lg">
                                                    <table class="w-full text-sm">
                                                        <thead class="text-xs text-primary dark:text-purple uppercase bg-purple dark:bg-table-head">
                                                            <tr>
                                                                <td scope="row" class="text-center py-4 font-medium whitespace-nowrap dark:text-white">Kriteria</th>
                                                                <th scope="col" class="px-6 py-3">Nilai</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {{--    ($kriteria->toArray()) --}}
                                                            @foreach ($kriteria as $kriteriaItem)
                                                            <tr class="bg-gray-100 dark:bg-primary border-b border-primary dark:border-purple last:border-0 text-primary dark:text-purple">
                                                                <td scope="row" class="text-center py-4 font-medium whitespace-nowrap dark:text-white">
                                                                        {{ $kriteriaItem->nama_kriteria }}
                                                                    </td>
                                                                    <td scope="row" class="text-center py-4 font-medium whitespace-nowrap dark:text-white">
                                                                        {{-- <input type="number" name="value[{{ $kriteriaItem->id }}]" value="value[{{ $kriteriaItem->id }}][]" class="bg-gray-50 w-20 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"> --}}
                                                                        <input type="number" name="value[{{ $kriteriaItem->id }}]" value="{{ $kriteriaItem->decision_matrix[$kriteriaItem->id]->value }}" class="bg-gray-50 w-20 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">

                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                    
                                                <button type="submit" class="mt-4 text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                                    Update
                                                </button> 
                                            </form>
                                        </div>
                                    </div>
                                </div>  
                                {{-- <a href="{{ route('decision-matrix.edit', $alternatifId) }}" class="text-[#41403D] hover:text-[#47384B]">Edit</a> --}}
                            </div>
                                                        
                            {{-- <a href="{{ route('decision-matrix.edit', $alternatifId) }}" class="text-[#41403D] hover:text-[#47384B]">Edit</a>
                                <form method="post" action="{{ route('decision-matrix.destroy', $alternatifId) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[#41403D] " onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                                </form> --}}
                            </td>
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
