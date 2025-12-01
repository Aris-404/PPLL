<?php 
include 'includes/db.php'; // hanya koneksi database
?>

<?php include 'includes/header.php'; ?>

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h1 class="text-white display-3 mt-lg-5">Gallery</h1>
            <div class="d-inline-flex align-items-center text-white">
                <p class="m-0"><a class="text-white" href="index.php">Home</a></p>
                <i class="fa fa-circle px-3"></i>
                <p class="m-0">Gallery</p>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Portfolio Start -->
    <div class="container-fluid py-5 px-0">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <h1 class="section-title position-relative text-center mb-5">
                        Premium Beauty Products Made From Natural & Organic Ingredients
                    </h1>
                </div>
            </div>

            <!-- Filter -->
            <div class="row">
                <div class="col-12 text-center">
                    <ul class="list-inline mb-4 pb-2" id="portfolio-flters">
                        <li class="btn btn-sm btn-outline-primary m-1 active" data-filter="*">All</li>
                        <li class="btn btn-sm btn-outline-primary m-1" data-filter=".first">Kosmetik Mata</li>
                        <li class="btn btn-sm btn-outline-primary m-1" data-filter=".second">Kosmetik Bibir</li>
                        <li class="btn btn-sm btn-outline-primary m-1" data-filter=".third">Kosmetik Wajah (Skincare)</li>
                    </ul>
                </div>
            </div>

            <div class="row m-0 portfolio-container">
                <?php
                $query = mysqli_query($conn, "SELECT g.*, k.nama_kategori 
                                             FROM gallery g 
                                             LEFT JOIN kategori k ON g.kategori_id = k.id 
                                             ORDER BY g.id DESC");
                while ($row = mysqli_fetch_assoc($query)) {
                    $class = "third";
                    if ($row['nama_kategori'] == "Kosmetik Mata") $class = "first";
                    elseif ($row['nama_kategori'] == "Kosmetik Bibir") $class = "second";
                ?>
                <div class="col-lg-4 col-md-6 p-0 portfolio-item <?= $class; ?>">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="upload/<?= $row['gambar']; ?>" alt="<?= htmlspecialchars($row['title']); ?>">
                        <a class="portfolio-btn" href="upload/<?= $row['gambar']; ?>" data-lightbox="portfolio" title="<?= htmlspecialchars($row['title']); ?>">
                            <i class="fa fa-plus text-primary" style="font-size: 60px;"></i>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Portfolio End -->

<?php include 'includes/footer.php'; ?>
