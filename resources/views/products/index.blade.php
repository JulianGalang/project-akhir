<x-layout>
    <style>
        @media (max-width: 768px) {
            .grid-cols-3 {
                grid-template-columns: repeat(1, minmax(0, 1fr));
            }
            .col-span-1, .col-span-2 {
                grid-column: span 1 / span 1;
            }
            .text-5xl {
                font-size: 2.25rem;
            }
        }
    </style>

    <div class="p-4 mt-14">
        <p class="text-5xl font-bold text-center">Products</p>
    </div>


    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">

            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-1">
                    <form method="POST" action="/products" enctype="multipart/form-data" class="w-full">
                        @csrf
                    <!-- name -->
                    <div>
                        <x-input-label for="name" :value="__('Nama Produk')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- categories -->
                    <div>
                        <x-input-label for="categories_id" :value="__('Kategori')" />
                        <div class="mt-2 grid grid-cols-3">
                            <div class="grid col-span-2">
                                <select id="categories_id" name="categories_id" autocomplete="categories-name" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pl-3 pr-8 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    <option hidden value="1">Pilih Kategori</option>
                                    @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="col-span-1 mx-2 items-center">
                                <button type="button" data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="inline-flex items-center h-full px-2 py-1 border border-gray-500 text-xs font-medium rounded shadow-sm text-black bg-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Tambah Kategori
                                </button>

                                <!-- Main modal -->
                            </div>

                        </div>
                        <x-input-error :messages="$errors->get('categories_id')" class="mt-2" />
                    </div>

                    <!-- Group -->
                    <div>
                        <x-input-label for="group" :value="__('Golongan')" />
                        <div class="mt-2 grid grid-cols-1">
                            <select id="group" name="group" autocomplete="group-name" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pl-3 pr-8 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                <option hidden>Pilih Golongan</option>
                                <option value="wanita">Dewasa Wanita</option>
                                <option value="pria">Dewasa Pria</option>
                                <option value="bayi">Bayi</option>
                                <option value="anak-anak">Anak - Anak</option>
                            </select>
                            <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <x-input-error :messages="$errors->get('group')" class="mt-2" />
                    </div>

                    <!-- Size -->
                    <div id="sizeInputs">
                        <fieldset>
                            <x-input-label for="size" :value="__('Ukuran')" />
                            <div id="sizes-container">
                                <div>
                                    <x-text-input id="new-size" class="block mt-1 w-full" type="text" />
                                    <button type="button" onclick="addSize()" class="inline-flex items-center h-full px-2 py-1 border border-gray-500 text-xs font-medium rounded shadow-sm text-black bg-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Tambah Size
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                        <x-input-error :messages="$errors->get('size')" class="mt-2" />

                    </div>

                    <!-- picture -->
                    <div class="my-2">
                        <x-input-label for="picture" :value="__('Foto Produk')" />
                        <input name="picture" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="picture" type="file" accept=".jpg,.png,.jpeg" >
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
                        <div class="relative w-64 h-64 border border-gray-300 rounded-md">
                            <img id="preview-picture" class="w-full h-full object-contain rounded-md hidden" alt="Image Preview">
                            <div id="fallback-text" class="absolute inset-0 flex items-center justify-center text-gray-500 text-lg font-bold">
                                No Image Available
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('picture')" class="mt-2" />
                    </div>

                    <!-- description -->
                    <div>
                        <x-input-label for="description" :value="__('Deskripsi Produk')" />
                        <textarea name="description" id="description" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div>
                        <button type="submit" class="mt-4 items-center w-full inline-flex justify-center px-2 py-1 border border-gray-500 text-m font-medium rounded shadow-sm text-black bg-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" onclick="openModal()">
                            Tambah barang
                        </button>
                    </div>
                </div>
            </form>

                <div class="col-span-2 mx-3 mt-6">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Kategori
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Golongan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Ukuran
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Stock
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Harga
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $item->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $item->categories ? $item->categories->name : 'Uncategorized' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->group }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->size }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->stock }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->price }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="/products/{{ $item->id }}/edit" class="font-medium text-sm text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        <form action="/products/{{ $item->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="mx-1 text-red-600 font-medium text-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <div class="mt-4">
                                    {{ $products->links('vendor.pagination.tailwind') }}
                                </div>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- script --}}
    <script>
function addSize() {
    let newSize = document.getElementById('new-size').value.trim().toUpperCase();
    if (newSize === "") return;

    let container = document.getElementById('sizes-container');
    if (document.getElementById('size-' + newSize)) return; // Hindari duplikasi

    let div = document.createElement('div');
    div.id = 'size-' + newSize;
    div.innerHTML = `
        <label>
            <input type="checkbox" name="size[]" value="${newSize}" onchange="toggleInputs(this, '${newSize}')">
            Ukuran ${newSize}
        </label>
        <div id="input-${newSize}" style="display: none;">
            <input type="number" name="stock[${newSize}]" placeholder="Stock ${newSize}">
            <input type="number" name="price[${newSize}]" placeholder="Price ${newSize}">
        </div>
    `;
    container.appendChild(div);
    document.getElementById('new-size').value = "";
}

document.getElementById('picture').addEventListener('change', function() {
        var file = this.files[0];
        var imgElement = document.getElementById('preview-picture');
        var fallbackText = document.getElementById('fallback-text');

        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                imgElement.src = e.target.result; // Set the src of the image
                imgElement.classList.remove('hidden'); // Show image
                fallbackText.classList.add('hidden'); // Hide fallback text
            };
            reader.readAsDataURL(file);
        } else {
            imgElement.src = ""; // Clear the image source
            imgElement.classList.add('hidden'); // Hide image
            fallbackText.classList.remove('hidden'); // Show fallback text
        }
    });
function toggleInputs(checkbox, size) {
    let inputDiv = document.getElementById('input-' + size);
    inputDiv.style.display = checkbox.checked ? 'block' : 'none';
}

document.addEventListener("DOMContentLoaded", function() {
    // Tampilkan notifikasi jika ada session success
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    @endif

    // Konfirmasi sebelum menghapus produk
    document.querySelectorAll('form[action^="/products/"]').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
    </script>




    <!-- Modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tambah Kategori
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" method="POST" action="/categories">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required="">
                        </div>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Tambah Kategori
                    </button>
                </form>


                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Kategori
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $name)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $name->name }}
                                </th>
                                <form method="POST" action="/categories/{{ $name->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <td class="px-6 py-4 text-center">
                                        <button type="submit" class="mx-1 text-red-600 font-medium text-sm">
                                            Delete
                                        </button>
                                    </td>
                                </form>
                            </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-layout>

