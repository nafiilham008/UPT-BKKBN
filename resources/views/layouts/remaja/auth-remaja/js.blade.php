<script src="https://cdn.tailwindcss.com"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.5/iconify-icon.min.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script>
    function showLoading(event) {
      event.preventDefault();
      document.querySelector('.loading-overlay').classList.add('active');
      setTimeout(function() {
        window.location.href = event.target.href;
      }, 1000);
    }

    // Menghilangkan overlay loading setelah halaman selesai dimuat
    window.addEventListener('load', function() {
      document.querySelector('.loading-overlay').classList.remove('active');
    });
</script>