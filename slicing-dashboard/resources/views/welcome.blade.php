<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zamówienia</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 min-h-screen p-6">

  <div class="max-w-7xl mx-auto bg-white p-6 rounded-xl shadow">
    <h1 class="text-2xl font-bold text-blue-700 mb-6">DashBoard</h1>

    <!-- Filter -->
    <div class="flex flex-wrap gap-2 items-center mb-6">
      <select class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-blue-200">
        <option>Status</option>
        <option value="confirmed">Potwierdzone</option>
        <option value="shipped">Wysłane</option>
      </select>
      <input type="date" class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-blue-200">
      <input type="date" class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-blue-200">
      <input type="text" placeholder="Cari Data" class="border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring focus:ring-blue-200">
      <button class="ml-auto bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Filter</button>
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
        <tbody class="text-gray-800">
          <tr class="bg-yellow-50 border-t border-gray-200">
            <td class="p-3 font-semibold text-yellow-600">Potwierdzone</td>
            <td class="p-3">21-03-2022</td>
            <td class="p-3">23-03-2022</td>
            <td class="p-3">1596</td>
            <td class="p-3">PROFORMA/7/03/2022</td>
            <td class="p-3">21-03-2022</td>
            <td class="p-3">305.99 / 376.37</td>
            <td class="p-3">
              <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Tampilkan Data</button>
            </td>
            <td class="p-3 text-center">
              <button class="text-blue-500 hover:text-blue-700" title="Edytuj">
                <!-- Edit Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z" />
                </svg>
              </button>
            </td>
            <td class="p-3 text-center">
              <button class="text-red-500 hover:text-red-700" title="Usuń">
                <!-- Trash Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </td>
            <td class="p-3 text-center">
              <button class="text-gray-500 hover:text-gray-700" title="Szczegóły">
                <!-- Dots Horizontal Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M6 10a2 2 0 114 0 2 2 0 01-4 0zm6 0a2 2 0 114 0 2 2 0 01-4 0z" />
                </svg>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-between mt-6">
      <div></div>
      <div class="space-x-2">
        <button class="px-3 py-1 bg-white border rounded hover:bg-gray-100">&laquo;</button>
        <span class="text-sm text-gray-600">Page 1</span>
        <button class="px-3 py-1 bg-white border rounded hover:bg-gray-100">&raquo;</button>
      </div>
    </div>
  </div>

</body>
</html>
