<h1 style ="font-family: Verdana; color: #4373F4"><?php echo $stock["name"]; ?></h1>
<h2 style ="font-family: Verdana; color: #2DAB7B">$<?php echo number_format($stock["price"],2); ?></h2>
<h2 style ="font-family: Verdana; color: #8773DA">Symbol: <?php echo $stock["symbol"]; ?></h2>
<!-- boton -->
<div class = "form-group">
    <a class = "btn btn-default" href= "buy.php?symbol=<?=$stock["symbol"]?>"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Buy</a>
</div>