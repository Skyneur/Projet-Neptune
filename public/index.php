<?php require_once __DIR__ . '/../bootstrap.php'; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Hotel Neptune'; ?></title>
    <link rel="icon" href="https://www.pngmart.com/files/22/Neptune-PNG-Pic.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/index.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>
    <script src="https://kit.fontawesome.com/a07d46abc4.js" crossorigin="anonymous" defer></script>
</head>

<div class="overlay">
<?php include __DIR__ . '/../_includes/navbar.php'; ?>

  <body>
  <section class="showcase">
  <div class="video-container">
    <video src="/images/video.mp4" muted loop autoplay></video>
    </div>
    <div class="overlay"></div>
    <div class="text">
      <h2>Neptune</h2>
      <p>L'Hôtel Neptune, situé au cœur de la ville, allie confort et luxe<br>
      dans un cadre historique. Avec des chambres luxueuses,<br>
      un restaurant gastronomique et un spa sur place,
      c'est l'endroit idéal pour profiter de la ville.</p>

<a href="/login.php?register=1" class="btn btn-primary" role="button">Voir Plus</a></div>
    <ul class="social">
      <li><a href="https://faceboog.com/neptune" target="_blank"><img src="https://i.ibb.co/x7P24fL/facebook.png"></a></li>
      <li><a href="https://x.com/neptune" target="_blank"><img src="https://i.ibb.co/Wnxq2Nq/twitter.png"></a></li>
      <li><a href="https://instagram.com/neptune" target="_blank"><img src="https://i.ibb.co/ySwtH4B/instagram.png"></a></li>
    </ul>
  </section>
</body>

<?php include __DIR__ . '/../_includes/document_end.php'; ?>