document.addEventListener("DOMContentLoaded", async function () {
    console.log("Fetching crypto data...");

    const cryptoDataUrl = "/crypto-data";

    async function fetchCryptoData() {
        try {
            const response = await fetch(cryptoDataUrl);
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);

            const data = await response.json();
            console.log("Fetched data:", data);

            let highestCoin = null;
            let highestClose = -Infinity;

            let lowestCoin = null;
            let lowestClose = Infinity;

            Object.values(data).forEach(coin => {
                let closeValue = parseFloat(coin.close);

                if (closeValue > highestClose) {
                    highestClose = closeValue;
                    highestCoin = coin.symbol;
                }

                if (closeValue < lowestClose) {
                    lowestClose = closeValue;
                    lowestCoin = coin.symbol;
                }
            });

            document.getElementById("highestReturn").textContent = `${highestCoin}`;
            document.getElementById("lowestReturn").textContent = `${lowestCoin}`;

        } catch (error) {
            console.error("Error fetching data:", error);
            document.getElementById("highestReturn").textContent = "Failed to fetch data.";
            document.getElementById("lowestReturn").textContent = "";
        }
    }

    fetchCryptoData();
    setInterval(fetchCryptoData, 60000);
});
