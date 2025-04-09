function timeTracker() {
    const tracer = new Date();

    const year = tracer.getFullYear().toString();
    const month = (tracer.getMonth() + 1).toString().padStart(2, '0');
    const date = tracer.getDate().toString().padStart(2, '0');
    const hours = tracer.getHours().toString().padStart(2, '0');
    const minutes = tracer.getMinutes().toString().padStart(2, '0');

    const formattedTime = `${date}/${month}/${year} ${hours}:${minutes}`;

    document.getElementById("timeTracker").innerHTML = `${formattedTime}`;
}

document.addEventListener("DOMContentLoaded", function () {
    timeTracker();
    setInterval(timeTracker, 60000);
});
