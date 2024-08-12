<!-- resources/views/components/real-time-clock.blade.php -->
<div id="clock" class="text-3xl  font-bold w-36 p-2 rounded-lg bg-slate-400"></div>
<script>
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
    }

    // Update the clock every second
    setInterval(updateClock, 1000);

    // Initial call to display the time immediately when the page loads
    updateClock();
</script>
