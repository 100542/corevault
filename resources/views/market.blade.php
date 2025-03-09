<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Market</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="bg-gray-800 text-white">

@include('nav')

<div class="container mx-auto p-8">
    <h1 class="text-4xl font-bold text-center mb-6">Live Crypto Market</h1>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-white/30 text-center">
            <thead class="bg-gray-900">
            <tr>
                <th class="border border-white/30 px-4 py-2">Symbol</th>
                <th class="border border-white/30 px-4 py-2">Open Price</th>
                <th class="border border-white/30 px-4 py-2">High</th>
                <th class="border border-white/30 px-4 py-2">Low</th>
                <th class="border border-white/30 px-4 py-2">Close Price</th>
                <th class="border border-white/30 px-4 py-2">Volume</th>
            </tr>
            </thead>
            <tbody id="crypto-table-body" class="bg-gray-700">
            </tbody>
        </table>
    </div>
</div>

<script>
    async function fetchCryptoData() {
        try {
            const response = await fetch("{{ route('crypto.data') }}");
            const data = await response.json();

            let tableBody = document.getElementById("crypto-table-body");
            tableBody.innerHTML = "";

            Object.values(data).forEach(coin => {
                let row = `
                        <tr class="border border-white/30">
                            <td class="text-yellow-300 border border-white/30 px-4 py-2">${coin.symbol}</td>
                            <td class="border border-white/30 px-4 py-2">${coin.open}</td>
                            <td class="border border-white/30 px-4 py-2">${coin.high}</td>
                            <td class="border border-white/30 px-4 py-2">${coin.low}</td>
                            <td class="border border-white/30 px-4 py-2">${coin.close}</td>
                            <td class="border border-white/30 px-4 py-2">${coin.volume}</td>
                        </tr>
                    `;
                tableBody.innerHTML += row;
            });
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    }

    fetchCryptoData();
    setInterval(fetchCryptoData, 1000);
</script>

</body>
</html>
