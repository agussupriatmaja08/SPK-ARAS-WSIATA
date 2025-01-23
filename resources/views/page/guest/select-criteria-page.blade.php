@extends('app') <!-- Layout utama -->

@section('content') <!-- Mulai seksi konten -->

<!-- Header -->
@include('page.guest.partials.header')
<div class="bg-gray-50 flex items-center justify-center min-h-screen w-full">

    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-[600px] mt-5 border border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center">
                <h2 class="text-2xl font-semibold text-gray-800">Pilih Kriteria Wisata</h2>
                <button data-hs-overlay="#criteria-detail" class="ml-3 text-gray-600 hover:text-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                    </svg>
                </button>
            </div>
        </div>

        <p class="mb-6 text-gray-600 leading-relaxed">Silahkan pilih kriteria wisata yang sesuai dengan preferensi Anda
            untuk mendapatkan rekomendasi terbaik.</p>

        <!-- Formulir Kriteria -->
        <form method="GET" action="/weight" class="p-4">
            @csrf

            <h3 class="text-lg font-semibold text-gray-700 mb-4">Pilih Kriteria</h3>

            <div class="grid grid-cols-2 gap-6">
                <!-- Kolom Pertama -->
                <div class="space-y-4">
                    @foreach ([['id' => 1, 'label' => 'Kondisi Alam'], ['id' => 2, 'label' => 'Budaya'], ['id' => 3, 'label' => 'Infrastruktur'], ['id' => 4, 'label' => 'Aksesibilitas']] as $criteria)
                        <div
                            class="flex items-center bg-gray-100 p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow cursor-pointer">
                            <input id="criteria-{{ $criteria['id'] }}" type="checkbox" name="criteria[]"
                                value="{{ $criteria['id'] }}" class="form-checkbox h-5 w-5 text-blue-500">
                            <label for="criteria-{{ $criteria['id'] }}"
                                class="flex items-center w-full ml-3 text-gray-700 font-medium">{{ $criteria['label'] }}</label>
                        </div>
                    @endforeach
                </div>

                <!-- Kolom Kedua -->
                <div class="space-y-4">
                    @foreach ([['id' => 5, 'label' => 'Jarak Terdekat'], ['id' => 6, 'label' => 'Keamanan'], ['id' => 7, 'label' => 'Biaya'], ['id' => 8, 'label' => 'Waktu Operasional']] as $criteria)
                        <div
                            class="flex items-center bg-gray-100 p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow cursor-pointer">
                            <input id="criteria-{{ $criteria['id'] }}" type="checkbox" name="criteria[]"
                                value="{{ $criteria['id'] }}" class="form-checkbox h-5 w-5 text-blue-500">
                            <label for="criteria-{{ $criteria['id'] }}"
                                class="flex items-center w-full ml-3 text-gray-700 font-medium">{{ $criteria['label'] }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit"
                class="mt-6 w-full bg-blue-500 text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:bg-blue-600 transition-colors">
                Selanjutnya
            </button>
        </form>

    </div>
</div>

<!-- Footer -->
@include('page.guest.partials.footer')
@include('page.guest.components.modal-criteria-detail')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
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



@endsection <!-- Tutup seksi konten -->