<!-- Footer -->
<footer class="text-light py-5" style="background: #111111; border-top: 3px solid #0066b2;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold text">Dinoco Bengkel</h5>
                <p class="small">Melayani perawatan dan perbaikan kendaraan dengan standar profesional dan teknologi
                    terkini.</p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-light footer-social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light footer-social"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-light footer-social"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-light footer-social"><i class="fab fa-tiktok"></i></a>
                    <a href="#" class="text-light footer-social"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold text">Navigasi</h5>
                <ul class="list-unstyled">
                    <li><a href="#home" class="text-light text-decoration-none footer-link">Home</a></li>
                    <li><a href="#models" class="text-light text-decoration-none footer-link">Models</a></li>
                    <li><a href="#about" class="text-light text-decoration-none footer-link">About</a></li>
                    <li><a href="#contact" class="text-light text-decoration-none footer-link">Contact</a></li>
                    <li><a href="#galery" class="text-light text-decoration-none footer-link">Gallery</a></li>
                    <li><a href="#mechanic" class="text-light text-decoration-none footer-link">Mechanic</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold text">Hubungi Kami</h5>
                <p class="small"><i class="fas fa-map-marker-alt"></i> Jl. Raya Otomotif No.99, Jakarta</p>
                <p class="small"><i class="fas fa-phone"></i> +62 812-3456-7890</p>
                <p class="small"><i class="fas fa-envelope"></i> info@dinoco.com</p>
            </div>
        </div>
        <hr class="bg-light">
        <div class="text-center small">
            <p class="m-0">&copy; 2025 Dinoco Bengkel. All Rights Reserved.</p>
        </div>
    </div>
</footer>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom JS -->
<script src="script.js"></script>


<script>
    // NAVBAR WOI
    document.getElementById("userMenu").addEventListener("click", function (event) {
        event.preventDefault();
        let dropdown = document.getElementById("userDropdown");
        if (dropdown.style.display === "block") {
            dropdown.style.display = "none";
        } else {
            dropdown.style.display = "block";
        }
    });

    document.addEventListener("click", function (event) {
        let userMenu = document.getElementById("userMenu");
        let dropdown = document.getElementById("userDropdown");
        if (!userMenu.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = "none";
        }
    });
</script>

<script>
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>


</body>

</html>