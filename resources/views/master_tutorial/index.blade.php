<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tutorial - Presentin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
        if (localStorage.getItem('dark-mode') === 'true') {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 p-8">
    <div class="max-w-6xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
        
        <div class="flex justify-between dark:text-white items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Manajemen Master Tutorial</h1>
            <div class="flex gap-2">
                <a href="/master-tutorial/create" class="bg-green-600 text-white dark:text-white px-4 py-2 rounded hover:bg-green-700 transition">
                    + Tambah Tutorial Baru
                </a>
                <a href="/logout-action" class="bg-red-600 text-white dark:text-white px-4 py-2 rounded hover:bg-red-700 transition" onclick="return confirm('Apakah Anda yakin ingin logout?')">
                    Logout
                </a>
                <div class="flex flex-col justify-center ml-3">
                    <input type="checkbox" id="light-switch" class="light-switch sr-only" />
                    <label class="relative cursor-pointer p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition" for="light-switch">
                        <svg class="dark:hidden" width="20" height="20" xmlns="http://www.w3.org/2000/svg">
                            <path class="fill-slate-600" d="M7 0h2v2H7zM12.88 1.637l1.414 1.415-1.415 1.413-1.413-1.414zM14 7h2v2h-2zM12.95 14.433l-1.414-1.413 1.413-1.415 1.415 1.414zM7 14h2v2H7zM2.98 14.364l-1.413-1.415 1.414-1.414 1.414 1.415zM0 7h2v2H0zM3.05 1.706 4.463 3.12 3.05 4.535 1.636 3.12z" />
                            <path class="fill-slate-700" d="M8 4C5.8 4 4 5.8 4 8s1.8 4 4 4 4-1.8 4-4-1.8-4-4-4Z" />
                        </svg>
                        <svg class="hidden dark:block" width="20" height="20" xmlns="http://www.w3.org/2000/svg">
                            <path class="fill-slate-400" d="M6.2 1C3.2 1.8 1 4.6 1 7.9 1 11.8 4.2 15 8.1 15c3.3 0 6-2.2 6.9-5.2C9.7 11.2 4.8 6.3 6.2 1Z" />
                            <path class="fill-slate-300" />
                        </svg>
                        <span class="sr-only">Switch to light / dark version</span>
                    </label>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 dark:bg-green-800 border-l-4 border-green-500 text-green-700 dark:text-green-200 p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                        <th class="p-3 border">No</th>
                        <th class="p-3 border">Judul</th>
                        <th class="p-3 border">Mata Kuliah</th>
                        <th class="p-3 border">URL (Presentasi / Finish)</th>
                        <th class="p-3 border text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tutorials as $index => $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 dark:text-gray-200">
                            <td class="p-3 border text-center dark:text-gray-200">{{ $index + 1 }}</td>
                            <td class="p-3 border font-semibold dark:text-gray-200">{{ $item->judul }}</td>
                            <td class="p-3 border text-sm text-gray-600 dark:text-gray-200">{{ $item->kode_mata_kuliah }}</td>
                            <td class="p-3 border dark:text-gray-200">
                                <div class="flex flex-col gap-1 text-xs">
                                    <a href="{{ $item->url_presentation }}" target="_blank" class="text-blue-500 dark:text-blue-400 hover:underline">🔗 Link Presentasi</a>
                                    <a href="{{ $item->url_finished }}" target="_blank" class="text-purple-500 dark:text-purple-400 hover:underline">🔗 Link Finish (PDF)</a>
                                </div>
                            </td>
                            <td class="p-3 border">
                                <div class="flex justify-center gap-2">
                                    <a href="/master-tutorial/{{ $item->id }}/detail" class="bg-blue-500 dark:bg-blue-400 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">
                                        Isi Materi
                                    </a>

                                    <a href="/master-tutorial/{{ $item->id }}/edit" class="bg-yellow-500 dark:bg-yellow-400 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                        Edit
                                    </a>

                                    <form action="{{ url('/master-tutorial/'.$item->id) }}" method="POST" onsubmit="return confirm('Hapus tutorial ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 dark:bg-red-400 text-white px-3 py-1 rounded text-sm hover:bg-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center dark:text-gray-200 text-gray-500 italic">Belum ada data tutorial.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const lightSwitch = document.getElementById('light-switch');
        if (lightSwitch) {
            if (localStorage.getItem('dark-mode') === 'true') {
                lightSwitch.checked = true;
            }
            lightSwitch.addEventListener('change', () => {
                if (lightSwitch.checked) {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('dark-mode', true);
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('dark-mode', false);
                }
            });
        }
    </script>
</body>
</html>