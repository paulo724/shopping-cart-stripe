<?php

use app\library\Cart;
use app\library\Product;

require '../vendor/autoload.php';

session_start();

$cart = new Cart;
$productsInCart = $cart->getCart();


if (isset($_GET['id'])) {
  $id = strip_tags($_GET['id']);
  $cart->remove($id);
  header('Location: mycart.php');
}

?>


<!doctype html>
<html lang="PT-BR" data-bs-theme="auto">

<head>
  <script src="assets/js/color-modes.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.111.3">
  <title>Checkout example · Bootstrap v5.3</title>



  <link href="assets/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
      z-index: 1500;
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="checkout.css" rel="stylesheet">
</head>

<body class="bg-body-tertiary">

  <div class="container">
    <main>
      <div class="py-5 text-center">
        <h2>Finalizar Compra</h2>
      </div>

      <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Seu carrinho</span>
            <span class="badge bg-primary rounded-pill">3</span>
          </h4>
          <ul class="list-group mb-3">
            <?php if (count($productsInCart) <= 0) : ?>
              Nenhum produto no carrinho
            <?php endif; ?>
            <?php foreach ($productsInCart as $product) : ?>
              <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                  <h6 class="my-0"><?php echo ucfirst($product->getName()); ?></h6>
                  <small class="text-body-secondary"><a href="?id=<?php echo $product->getId(); ?>">Remover</a></small>
                </div>
                <span class="text-body-secondary">R$ <?php echo number_format($product->getPrice(), 2, ',', '.') ?><br>Subtotal: R$ <?php echo number_format($product->getPrice() * $product->getQuantity(), 2, ',', '.') ?></span>
                <span class="text-body-secondary"><input class="form-control form-control-sm" type="text" value="<?php echo $product->getQuantity() ?>" size="2"></span>
              </li>
            <?php endforeach; ?>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total</span>
              <strong>R$ <?php echo number_format($cart->getTotal(), 2, ',', '.'); ?></strong>
            </li>
          </ul>

          <form class="card p-2">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Promo code">
              <button type="submit" class="btn btn-secondary">Aplicar</button>
            </div>
          </form>
        </div>
        <div class="col-md-7 col-lg-8">
          <h4 class="mb-3">Informações de Endereço</h4>
          <form class="needs-validation" novalidate>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="firstName" class="form-label">Primeiro Nome</label>
                <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Nome válido é obrigatório.
                </div>
              </div>

              <div class="col-sm-6">
                <label for="lastName" class="form-label">Segundo Nome</label>
                <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Nome válido é obrigatório.
                </div>
              </div>

              <div class="col-12">
                <label for="email" class="form-label">Email <span class="text-body-secondary">(Opcional)</span></label>
                <input type="email" class="form-control" id="email" placeholder="you@example.com">
                <div class="invalid-feedback">
                  Insira um endereço de e-mail válido para atualizações de envio.
                </div>
              </div>

              <hr class="my-4">
            </div>
            <p>A finzalizção da compra é feita em outra página. <a href="index.php">Voltar para home</a></p>

            <a class="w-100 btn btn-primary btn-lg" href="checkout.php">Ir para o checkout</a>
          </form>
        </div>
      </div>
    </main>
  </div>


  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

  <script src="checkout.js"></script>
</body>

</html>