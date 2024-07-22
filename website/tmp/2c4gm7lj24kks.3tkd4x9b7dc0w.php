<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= ($pageTitle) ?></title>
        <meta name="description" content="<?= ($pageDecription) ?>">
        <meta name="author" content="Iana Setrakova">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <base href="<?= ($BASE) ?>/public/">
        <link rel="stylesheet" href="styles/main.css">

    </head>

    <body class="d-flex flex-column min-vh-100">
      <nav class="navbar navbar-expand-lg bg-body-secondary" id="header-navbar">
            <div class="container">
              <a class="navbar-brand" href="<?= ($BASE) ?><?= (Base::instance()->alias('home')) ?>">
                <img src="images/Task-it-logo.svg" alt="Bootstrap" height="40">
              </a>
              <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navbarResponsive">
                <span class="visually-hidden">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarResponsive">
                  <ul class="navbar-nav ms-auto">
                      <li class="nav-item"><a class="nav-link" href="<?= ($BASE) ?><?= (Base::instance()->alias('home')) ?>">Home</a></li>
                      <li class="nav-item"><a class="nav-link" href="<?= ($BASE) ?><?= (Base::instance()->alias('dashboard')) ?>">Dashboard</a></li>
                      <li class="nav-item"><a class="nav-link" href="<?= ($BASE) ?><?= (Base::instance()->alias('contact')) ?>">Contact us</a></li>
                  </ul>
                  
                  <?php if (isset($SESSION['userEmail'])): ?>
                    
                        <a href="<?= ($BASE) ?><?= (Base::instance()->alias('logout')) ?>" class="btn btn-primary px-4 rounded-pill ms-4">Log out</a>
                    
                    <?php else: ?>
                        <a href="<?= ($BASE) ?><?= (Base::instance()->alias('login')) ?>" class="btn btn-primary px-4 rounded-pill ms-4">Log in</a>
                    
                <?php endif; ?>       
              </div>
            </div>
        </nav>