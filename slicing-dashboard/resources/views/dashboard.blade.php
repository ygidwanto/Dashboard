<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zamówienia</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .modal { 
      position: fixed; 
      inset: 0; 
      background: rgba(0,0,0,0.5); 
      display: flex; 
      justify-content: center; 
      align-items: center; 
      z-index: 50; 
    }
    .modal-box { 
      background: white; 
      border-radius: 1rem; 
      padding: 1.5rem; 
      width: 100%; 
      max-width: 32rem; 
      box-shadow: 0 10px 25px rgba(0,0,0,0.2); 
    }
    .hidden { display: none; }
  </style>
</head>
<body class="bg-blue-50 min-h-screen p-6">

  <div class="max-w-7xl mx-auto bg-white p-6 rounded-xl shadow">
    <h1 class="text-2xl font-bold text-blue-700 mb-6">DashBoard</h1>

    <!-- Filter -->
    <form method="GET" action="{{ route('dashboard') }}" class="flex flex-wrap gap-2 items-center mb-6">
        <select name="status" class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-blue-200">
            <option value="">Semua Status</option>
            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
        </select>
        <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-blue-200">
        <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-blue-200">
        <input type="text" name="search" placeholder="Cari Data" value="{{ request('search') }}" class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-blue-200">
        
        <div class="flex gap-2 ml-auto">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Filter</button>
            <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Reset</a>
            <button onclick="openModal('add-modal')" type="button" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Add</button>
        </div>
    </form>

    <!-- Modal Tambah Data -->
    <div id="add-modal" class="modal hidden">
      <div class="modal-box" onclick="event.stopPropagation()">
        <h2 class="text-xl font-bold text-gray-700">Tambah Data Dokumen</h2>
        <form action="{{ route('dokumen.store') }}" method="POST" class="space-y-4">
          @csrf
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label>Status</label>
              <select name="status" class="w-full border border-gray-300 rounded px-2 py-1">
                <option value="confirmed">Confirmed</option>
                <option value="shipped">Shipped</option>
              </select>
            </div>
            <div>
              <label>Dokumen</label>
              <input type="text" name="dokumen" class="w-full border border-gray-300 rounded px-2 py-1">
            </div>
            <div>
              <label>NR</label>
              <input type="text" name="nr" class="w-full border border-gray-300 rounded px-2 py-1">
            </div>
            <div>
              <label>Tanggal</label>
              <input type="date" name="tanggal" class="w-full border border-gray-300 rounded px-2 py-1">
            </div>
            <div>
              <label>Realisasi</label>
              <input type="date" name="realisasi" class="w-full border border-gray-300 rounded px-2 py-1">
            </div>
            <div>
              <label>Tanggal Awal</label>
              <input type="date" name="tanggal_awal" class="w-full border border-gray-300 rounded px-2 py-1">
            </div>
            <div class="col-span-2">
              <label>Pelanggan</label>
              <select name="pelanggan_id" class="w-full border border-gray-300 rounded px-2 py-1">
                @foreach($pelanggans as $pelanggan)
                <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="flex justify-end pt-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mr-2">Simpan</button>
            <button type="button" onclick="closeModal('add-modal')" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Table -->
    <div class="overflow-auto rounded-xl border border-gray-200">
      <table class="min-w-full text-sm text-left">
        <thead class="bg-gray-100 text-gray-700">
          <tr>
            <th class="p-3">Status</th>
            <th class="p-3">Data Tanggal</th>
            <th class="p-3">Data Realisasi</th>
            <th class="p-3">Nr</th>
            <th class="p-3">Dokumen</th>
            <th class="p-3">Data Awal</th>
            <th class="p-3">Nomor Id / Pelanggan</th>
            <th class="p-3">Tampilkan</th>
            <th class="p-3">Edit</th>
            <th class="p-3">Delete</th>
            <th class="p-3">Opsi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dokumens as $dokumen)
          <tr class="bg-yellow-50 border-t border-gray-200">
            <td class="p-3 font-semibold text-yellow-600">{{ $dokumen->status }}</td>
            <td class="p-3">{{ $dokumen->tanggal->format('d-m-Y') }}</td>
            <td class="p-3">{{ $dokumen->realisasi->format('d-m-Y') }}</td>
            <td class="p-3">{{ $dokumen->nr }}</td>
            <td class="p-3">{{ $dokumen->dokumen }}</td>
            <td class="p-3">{{ $dokumen->tanggal_awal->format('d-m-Y') }}</td>
            <td class="p-3">{{ $dokumen->pelanggan->no_pelanggan }} / {{ $dokumen->pelanggan->id }}</td>
            <td class="p-3">
              <button onclick="toggleDetail({{ $dokumen->id }})" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                Tampilkan Data
              </button>
            </td>
            <td class="p-3 text-center">
              <button onclick="openModal('edit-modal-{{ $dokumen->id }}')" class="text-blue-500 hover:text-blue-700" title="Edytuj">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z" />
                </svg>
              </button>
            </td>
            <td class="p-3 text-center">
              <form action="{{ route('dokumen.destroy', $dokumen->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                </button>
              </form>
            </td>
            <td class="p-3 text-center">
              <button class="text-gray-500 hover:text-gray-700" title="Szczegóły">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M6 10a2 2 0 114 0 2 2 0 01-4 0zm6 0a2 2 0 114 0 2 2 0 01-4 0z" />
                </svg>
              </button>
            </td>
          </tr>

          <!-- Detail Row -->
            <tr id="detail-{{ $dokumen->id }}" class="hidden bg-blue-50 border-b border-gray-200">
                <td colspan="11" class="p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
                    <!-- Informasi Dasar Pelanggan -->
                    <div class="space-y-2">
                        <h3 class="font-bold text-blue-600 border-b pb-1">Informasi Pelanggan</h3>
                        <p>
                        <span class="font-semibold inline-block w-24">ID:</span> 
                        <span class="bg-gray-100 px-2 py-1 rounded">{{ $dokumen->pelanggan->id }}</span>
                        </p>
                        <p>
                        <span class="font-semibold inline-block w-24">Nama:</span> 
                        {{ $dokumen->pelanggan->nama }}
                        </p>
                        <p>
                        <span class="font-semibold inline-block w-24">Telepon:</span> 
                        {{ $dokumen->pelanggan->telepon ?? '-' }}
                        </p>
                    </div>
                    
                    <!-- Alamat Pelanggan -->
                    <div class="space-y-2">
                        <h3 class="font-bold text-blue-600 border-b pb-1">Alamat</h3>
                        <p>
                        <span class="font-semibold">Alamat:</span><br>
                        <span class="text-gray-600">{{ $dokumen->pelanggan->alamat ?? '-' }}</span>
                        </p>
                    </div>
                    </div>
                    
                    <!-- Tombol Aksi (Opsional) -->
                    <div class="flex justify-end mt-3">
                    <a href="#" class="text-blue-500 hover:text-blue-700 text-sm underline">Lihat detail lengkap</a>
                    </div>
                </td>
            </tr>

          <!-- Modal Edit Data -->
          <div id="edit-modal-{{ $dokumen->id }}" class="modal hidden">
            <div class="modal-box" onclick="event.stopPropagation()">
              <h2 class="text-xl font-bold text-gray-700">Edit Data Dokumen</h2>
              <form action="{{ route('dokumen.update', $dokumen->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                  <div>
                    <label>Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded px-2 py-1">
                      <option value="confirmed" {{ $dokumen->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                      <option value="shipped" {{ $dokumen->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    </select>
                  </div>
                  <div>
                    <label>Dokumen</label>
                    <input type="text" name="dokumen" value="{{ $dokumen->dokumen }}" class="w-full border border-gray-300 rounded px-2 py-1">
                  </div>
                  <div>
                    <label>NR</label>
                    <input type="text" name="nr" value="{{ $dokumen->nr }}" class="w-full border border-gray-300 rounded px-2 py-1">
                  </div>
                  <div>
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" value="{{ $dokumen->tanggal->format('Y-m-d') }}" class="w-full border border-gray-300 rounded px-2 py-1">
                  </div>
                  <div>
                    <label>Realisasi</label>
                    <input type="date" name="realisasi" value="{{ $dokumen->realisasi->format('Y-m-d') }}" class="w-full border border-gray-300 rounded px-2 py-1">
                  </div>
                  <div>
                    <label>Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" value="{{ $dokumen->tanggal_awal->format('Y-m-d') }}" class="w-full border border-gray-300 rounded px-2 py-1">
                  </div>
                  <div class="col-span-2">
                    <label>Pelanggan</label>
                    <select name="pelanggan_id" class="w-full border border-gray-300 rounded px-2 py-1">
                      @foreach($pelanggans as $pelanggan)
                      <option value="{{ $pelanggan->id }}" {{ $dokumen->pelanggan_id == $pelanggan->id ? 'selected' : '' }}>{{ $pelanggan->nama }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="flex justify-end pt-4">
                  <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 mr-2">Update</button>
                  <button type="button" onclick="closeModal('edit-modal-{{ $dokumen->id }}')" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
                </div>
              </form>
            </div>
          </div>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-between mt-6">
      <div></div>
      <div class="space-x-2">
        {{ $dokumens->onEachSide(1)->links('pagination::tailwind') }}
      </div>
    </div>
  </div>

  <script>
    function openModal(id) {
      document.getElementById(id)?.classList.remove('hidden');
    }

    function closeModal(id) {
      document.getElementById(id)?.classList.add('hidden');
    }

    document.addEventListener('click', function(e) {
      if (e.target.classList.contains('modal')) {
        closeModal(e.target.id);
      }
    });

    function toggleDetail(id) {
      const detailRow = document.getElementById(`detail-${id}`);
      detailRow?.classList.toggle('hidden');
    }

    // Tambahkan event listener untuk menutup modal saat menekan ESC
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        const openModals = document.querySelectorAll('.modal:not(.hidden)');
        openModals.forEach(modal => {
          closeModal(modal.id);
        });
      }
    });
  </script>
</body>
</html>