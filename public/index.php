<!doctype html>
<html lang="PT-BR" data-bs-theme="auto">

<head>
  <script src="assets/js/color-modes.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Página de compras</title>


  <!-- Styles custom do template -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

  <?php

  use app\library\Cart;
  use app\library\Product;

  require '../vendor/autoload.php';

  session_start();

  $products = [
    1 => ['id' => 1, 'name' => 'geladeira', 'price' => 1000.00, 'quantity' => 1],
    2 => ['id' => 2, 'name' => 'mouse', 'price' => 100.00, 'quantity' => 1],
    3 => ['id' => 3, 'name' => 'teclado', 'price' => 10.00, 'quantity' => 1],
    4 => ['id' => 4, 'name' => 'monitor', 'price' => 5000.00, 'quantity' => 1],
  ];


  if (isset($_GET['id'])) {
    $id = strip_tags($_GET['id']);
    $productInfo = $products[$id];
    $product = new Product;
    $product->setId($productInfo['id']);
    $product->setName($productInfo['name']);
    $product->setPrice($productInfo['price']);
    $product->setQuantity($productInfo['quantity']);

    $cart = new Cart;
    $cart->add($product);
  }

  ?>
</head>

<body>
  <main>
    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-light">Loja de compras</h1>
          <p class="lead text-body-secondary">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
          <p>
            <a href="mycart.php" class="btn btn-primary my-2">Ir para o carrinho <span class="badge text-bg-secondary"><?php echo count($_SESSION['cart']['products']); ?></span></a>
          </p>
        </div>
      </div>
    </section>

    <div class="album py-5 bg-body-tertiary">
      <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <?php foreach ($products as $product) : ?>
            <div class="col">
              <div class="card shadow-sm">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                  <title>Placeholder</title>
                  <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                </svg>
                <div class="card-body">
                  <h5><?php echo ucfirst($product['name']) ?> - R$ <?php echo number_format($product['price'], 2, ',', '.') ?></h5>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a class="btn btn-primary btn-sm" href="?id=<?php echo $product['id'] ?>">Comprar</a>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Ver mais</button>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>

      </div>
    </div>

  </main>

  <!-- Scripts bootstrap -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>