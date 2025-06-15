<!DOCTYPE html>
<html lang="hu">

<head>
  <title>Kezdőlap - vaszilijedc.hu</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="./css/index.css">
</head>

<body>
  <?php include './components/nav.php'; ?>
  <div class="jumbotron text-center" style="background-image: url('./images/front.jpg')">
    <h1>Vaszilijedc.hu</h1>
    <P>Kések, pengék és multi toolok egy helyen</P>
    <h1>Bemutatkozás</h1>
  </div>
  <br>
<div class="container">
  <div class="row justify-content-center">

    <div class="col-12 col-md-10 col-lg-8">
      <div class="row align-items-start my-4">

        <div class="col-12 col-md-4 col-lg-3 mb-3 mb-md-0 text-center">
          <img src="./images/IMG_20180614_163340_1.jpg.webp" alt="Balogh József" class="img-fluid rounded">
        </div>

        <div class="col-12 col-md-8 col-lg-9">
          <h1>Naplónak indult, Bemutató bloggá vált.</h1>
          <h5>
            Aztán átalakult valami mássá. Ablakká, amelyben kitekintek a világra, a világ meg betekinthet a
            gondolataimba: késekről, every day carry felszerelésekről, és az ezek mögött meghúzódó filozófiáról.
          </h5>
          <h5>
            Aztán ennél is több lett. Egy közösség, amelyben együtt, hasonló értékek mentén dolgozunk azért, hogy
            egy minőségi, kissé talán régimódi találkahely legyen ez az online térben.
          </h5>
          <h5>
            Balogh József vagyok, és azon dolgozom, hogy ez a közösség egyre nagyobbá váljon, és együtt adhassuk
            tovább ezek az értékeket. Tarts velünk te is!
          </h5>

          <h1>De mi az az EDC?</h1>
          <h5>
            Egy angol betűszó, amely kibontva az every day carry kifejezést takarja. Ez szó szerinti fordításban
            azokat a holmikat jelenti, amelyeket nap mint nap magunknál hordunk...
          </h5>

          <h1>Ha kést szeretnél vásárolni, látogasd meg viszonteladóinkat.</h1>

          <div class="text-center my-3">
            <a href="index.php?page=resellers" class="btn btn-primary btn-lg">Viszonteladók</a>
          </div>

          <div class="d-flex flex-column align-items-center gap-3 my-4">
            <div class="embed-responsive embed-responsive-16by9 mb-3" style="max-width: 100%;">
              <iframe class="embed-responsive-item" src="https://www.youtube.com/watch?v=_Nq5eEQpAFM" title="YouTube videólejátszó"
                frameborder="0" allowfullscreen></iframe>
            </div>

            <div class="map-responsive">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10898.25682619235!2d19.1573916!3d47.4847538!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741c5e0ff7f89ad%3A0xf2b4f0f0f205e978!2sBudapest%2C%20Cserkesz%20u.%2032%2C%201105!5e0!3m2!1shu!2shu!4v1718126759721!5m2!1shu!2shu"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
              </iframe>
            </div>
          </div>

        </div>

      </div>
    </div>

  </div>
</div>
  <br>
  <?php include './components/footer.php'; ?>

</body>

</html>