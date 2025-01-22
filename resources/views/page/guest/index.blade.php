@extends('app') <!-- Layout utama -->

@section('content') <!-- Mulai seksi konten -->

    <!-- Header -->
    @include('page.guest.partials.header')

    <!-- Hero Section -->
    <div class="h-72 flex items-center justify-center bg-cover relative" style="background-image: url('{{ asset('img/wisata/header3.jpg') }}'); 
           background-position: center;">
        <!-- Overlay gelap -->
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="text-white p-4 text-center bg-opacity-10 rounded-md relative">
            <h2 class="text-2xl md:text-3xl font-bold mb-2">Sistem Pendukung Keputusan Pemilihan Wisata Klungkung</h2>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Call to Action -->
        <div class="text-center mb-8">
            <p class="text-gray-700 text-sm md:text-lg">
                Masih bingung cari tempat liburan di Klungkung Bali? Klik fitur rekomendasi!
            </p>
            <button id="fitur-rekomendasi" class="mt-4 px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
               <a href="/select-criteria-page"> Fitur Rekomendasi</a>
            </button>
        </div>

        <!-- Card Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Card Alternatif 1 -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400">Gambar kosong</span>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-bold mb-2">Alternatif 1</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>
                    <a href="#" class="text-blue-500 hover:underline">Baca Selengkapnya</a>
                </div>
            </div>

            <!-- Card Alternatif 2 -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400">Gambar kosong</span>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-bold mb-2">Alternatif 2</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>
                    <a href="#" class="text-blue-500 hover:underline">Baca Selengkapnya</a>
                </div>
            </div>

            <!-- Card Alternatif 3 -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400">Gambar kosong</span>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-bold mb-2">Alternatif 3</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>
                    <a href="#" class="text-blue-500 hover:underline">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('page.guest.partials.footer')

@endsection <!-- Tutup seksi konten -->
