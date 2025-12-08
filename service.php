<?php include './includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<!-- Header Start -->
<div
  class="jumbotron jumbotron-fluid page-header"
  style="margin-bottom: 90px">
  <div class="container text-center py-5">
    <h1 class="text-white display-3 mt-lg-5">Service</h1>
    <div class="d-inline-flex align-items-center text-white">
      <p class="m-0"><a class="text-white" href="">Home</a></p>
      <i class="fa fa-circle px-3"></i>
      <p class="m-0">Service</p>
    </div>
  </div>
</div>
<!-- Header End -->

<!-- Services Start -->
<div class="container-fluid py-5">
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-6">
        <h1 class="section-title position-relative mb-5">
          Best Services We Provide For Our Clients
        </h1>
      </div>
      <div class="col-lg-6 mb-5 mb-lg-0 pb-5 pb-lg-0"></div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="owl-carousel service-carousel">
          <?php $no = 1;
          $result = $conn->query("SELECT * FROM service ORDER BY id DESC");
          while ($row = $result->fetch_assoc()): ?>
            <div class="service-item">
              <div class="team-img mx-auto">
                <img
                  class="w-100 h-100"
                  src="uploads/<?= $row['gambar']; ?>"
                  style="object-fit: cover"
                  alt="Quality Makeup Products" />
              </div>
              <div
                class="position-relative text-center bg-light rounded p-4 pb-5"
                style="margin-top: -30px">
                <h5 class="font-weight-semi-bold mt-5 mb-3 pt-5">
                  <?= htmlspecialchars($row['judul']); ?>
                </h5>
                <p>
                  <?= nl2br(htmlspecialchars($row['deskripsi'])); ?>
                </p>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Services End -->

<!-- Testimonial Start -->
<div class="container-fluid py-5">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <h1 class="section-title position-relative text-center mb-5">
          Clients Say About Our Famous Products
        </h1>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="owl-carousel testimonial-carousel">

          <?php
          $testimoni = $conn->query("SELECT * FROM testimoni");
          while ($row = $testimoni->fetch_assoc()):
          ?>
            <div class="text-center">
              <i class="fa fa-3x fa-quote-left text-primary mb-4"></i>

              <h4 class="font-weight-light mb-4">
                <?= htmlspecialchars($row['deskripsi']); ?>
              </h4>

              <!-- <img class="img-fluid mx-auto mb-3"
                                 src="uploads/<?= $row['foto']; ?>"
                                 alt="<?= htmlspecialchars($row['nama']); ?>"> -->

              <h5 class="font-weight-bold m-0">
                <?= htmlspecialchars($row['nama']); ?>
              </h5>

              <span>
                <?= htmlspecialchars($row['jabatan']); ?>
              </span>
            </div>
          <?php endwhile; ?>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- Testimonial End -->

<?php include 'includes/footer.php'; ?>