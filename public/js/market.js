document.addEventListener("DOMContentLoaded", async function () {
    const cryptoDataUrl = "/crypto-data";

    async function fetchCryptoData() {
        try {
            const response = await fetch(cryptoDataUrl);
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

            const data = await response.json();
            let tableBody = document.getElementById("crypto-table-body");
            tableBody.innerHTML = "";

            Object.values(data).forEach((coin, index) => {
                let rowId = `chart-row-${index}`;
                let canvasId = `chart-${index}`;

                let row = `
                    <tr class="bg-[#040604]">
                        <td class="text-[#C4FFCE] border border-[#8DB295]/30 px-4 py-2">${coin.symbol}</td>
                        <td class="border border-[#8DB295]/30 px-4 py-2">${coin.open}</td>
                        <td class="border border-[#8DB295]/30 px-4 py-2">${coin.high}</td>
                        <td class="border border-[#8DB295]/30 px-4 py-2">${coin.low}</td>
                        <td class="border border-[#8DB295]/30 px-4 py-2">${coin.close}</td>
                        <td class="border border-[#8DB295]/30 px-4 py-2">${coin.volume}</td>
                        <td class="border border-[#8DB295]/30 px-4 py-2 text-center">
                            <button onclick="toggleAccordion('${rowId}', '${canvasId}', '${coin.symbol}')" class="text-[#C4FFCE] underline">View Graph</button>
                        </td>
                    </tr>
                    <tr id="${rowId}" class="hidden">
                        <td colspan="7" class="bg-[#040604] border border-[#8DB295]/30 px-4 py-4">
                            <canvas id="${canvasId}" height="100"></canvas>
                        </td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    }

    window.toggleAccordion = async function (rowId, canvasId, symbol) {
        const row = document.getElementById(rowId);
        if (row.classList.contains("hidden")) {
            row.classList.remove("hidden");

            if (!row.dataset.loaded) {
                const response = await fetch(`https://api.binance.com/api/v3/klines?symbol=${symbol}&interval=1h&limit=24`);
                const klineData = await response.json();

                const labels = klineData.map(d => new Date(d[0]).toLocaleTimeString());
                const prices = klineData.map(d => parseFloat(d[4]));

                const ctx = document.getElementById(canvasId).getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: `${symbol} (last 24h)`,
                            data: prices,
                            borderColor: 'rgba(0, 255, 153, 0.8)',
                            backgroundColor: 'rgba(4, 6, 4, 0.1)',
                            fill: true,
                            tension: 0.3,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: { beginAtZero: false },
                            x: { display: false }
                        }
                    }
                });

                row.dataset.loaded = true;
            }
        } else {
            row.classList.add("hidden");
        }
    }

    fetchCryptoData();
    setInterval(fetchCryptoData, 60000);
});
