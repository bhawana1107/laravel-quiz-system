<footer class="w-full mt-8">
    <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-6 text-center text-slate-400">
        © 2025 Quiz System | All rights reserved by <a href="https://bhawana1107.github.io/">Bhawana ❤️</a>
    </div>
</footer>
<script>
    // 3 seconds baad message hide ho jayega
    setTimeout(function() {
        let msg = document.querySelector('#successMsg');
        if (msg) {
            msg.style.transition = "opacity 0.5s";
            msg.style.opacity = 0;

            setTimeout(() => msg.remove(), 500); // completely remove
        }
    }, 3000);
</script>
