<h1><?php echo $stock["name"]; ?></h1>
<h2>$<?php echo number_format($stock["price"],2); ?></h2>
<h2>Symbol: <?php echo $stock["symbol"]; ?></h2>
<!-- boton -->
<div class = "form-group">
    <a class = "btn btn-default" href= "buy.php?symbol=<?=$stock["symbol"]?>">
    Buy
    </a>
</div>