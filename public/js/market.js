document.addEventListener("DOMContentLoaded", async function () {
    console.log("Fetching crypto data...");

    const cryptoDataUrl = "/crypto-data";

    async function fetchCryptoData() {
        try {
            const response = await fetch(cryptoDataUrl);
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

            const data = await response.json();
            console.log("Fetched data:", data);

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
    setInterval(fetchCryptoData, 60000);
});
