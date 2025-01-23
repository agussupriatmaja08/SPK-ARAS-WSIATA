@extends('app')

@section('content')

@include('page.guest.partials.header')

<div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-[500px] mx-auto mt-10 border border-gray-300">
    <div class="flex items-center mb-6 space-x-2">
        <h2 class="text-2xl font-semibold text-gray-800">Bobot Kriteria</h2>
        <button data-hs-overlay="#weight-detail" class="text-gray-600 hover:text-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
            </svg>
        </button>
    </div>
    <p class="mb-6 text-gray-600 leading-relaxed">Silahkan tentukan bobot kriteria wisata yang sesuai dengan preferensi
        Anda
        untuk mendapatkan rekomendasi terbaik.</p>

    <form action="/rekomendasi" method="POST">
        @csrf
        <ul class="space-y-4">
            @foreach ($selectedCriteria as $criteria)
                <li class="bg-gray-50 p-3 rounded-md shadow-sm border border-gray-200">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600 font-medium">{{ $criteria }}</span>
                        <div class="flex items-center space-x-3">
                            <!-- Slider Input -->
                            <input type="range" min="0" max="100" value="0" id="slider-{{ $criteria }}"
                                name="weights[{{ $criteria }}]"
                                class="slider w-20 sm:w-32 h-2 bg-blue-300 rounded-lg outline-none appearance-none"
                                oninput="syncInputs(this, 'input-{{ $criteria }}')">

                            <!-- Number Input -->
                            <input type="number" min="0" max="100" value="0" id="input-{{ $criteria }}"
                                class="text-center w-12 sm:w-16 border border-gray-300 rounded-md text-gray-600"
                                oninput="syncInputs(this, 'slider-{{ $criteria }}')">
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

        <button type="submit"
            class="mt-6 w-full bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-md shadow hover:bg-blue-700 transition">
            Selanjutnya
        </button>
    </form>

    <!-- Tombol Kembali -->
    <a href="/select-criteria-page" class="mt-4 inline-block text-blue-600 hover:text-blue-700 font-semibold text-sm">
        &#8592; Kembali ke Halaman Kriteria
    </a>
</div>

@include('page.guest.partials.footer')
@include('page.guest.components.modal-weight-detail')



<script>
    /**
     * Sinkronkan slider dan input angka
     * @param {HTMLInputElement} source Elemen sumber yang diubah
     * @param {string} targetId ID dari elemen target untuk sinkronisasi
     */
    function syncInputs(source, targetId) {
        const target = document.getElementById(targetId);
        const value = Math.min(100, Math.max(0, source.value)); // Pastikan nilai tetap di 0-100
        source.value = value; // Atur ulang sumber jika melebihi batas
        target.value = value; // Sinkron dengan target
    }


    document.querySelectorAll('[data-hs-overlay]').forEach(button => {
        button.addEventListener('click', function () {
            const modalId = this.getAttribute('data-hs-overlay');
            const modal = document.querySelector(modalId);

            if (modal) {
                modal.classList.toggle('hidden');
                modal.classList.toggle('hs-overlay-open');
            }
        });
    });

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
        });
    @endif

</script>
@endsection