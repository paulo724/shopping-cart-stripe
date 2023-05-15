<!doctype html>
<html lang="PT-BR" data-bs-theme="auto">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Página de Checkout</title>



  <link href="assets/css/bootstrap.min.css" rel="stylesheet">


  <!-- Styles custom do template -->
  <link href="checkout.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

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
            <span class="badge bg-primary rounded-pill"><?php echo count($_SESSION['cart']['products']); ?></span>
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

  <!-- Scritps bootstrap -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="checkout.js"></script>

</body>

</html>