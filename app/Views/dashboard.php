<main id="main" class="main">
    <section class="section">
        <div class="row ">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center p-5">
                        <h5 class="card-title text-uppercase fw-bold text-primary mb-4 moving-text">SIPS</h5>
                        <h6 class="card-title text-uppercase text-muted">Sistem Informasi Pengumuman Sekolah</h6>
                        <h6 class="card-title display-6 text-dark mt-3">
                            <?php echo $setting->nama_sekolah ?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Custom CSS -->
<style>
    .card {
        background: linear-gradient(135deg, #e9f1f7, #ffffff);
        border-radius: 20px;
        transition: transform 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card-title {
        letter-spacing: 1px;
    }

    .card-body {
        animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Animasi untuk teks bergerak */
    .moving-text {
        display: inline-block;
        position: relative;
        animation: moveText 5s linear infinite;
    }

    @keyframes moveText {
        0% {
            transform: translateX(0);
        }
        50% {
            transform: translateX(20px);
        }
        100% {
            transform: translateX(0);
        }
    }
</style>
