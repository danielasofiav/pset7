<?php

    // configuration
    require("../includes/config.php");
    // if the form was submitted
    
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $symbols = CS50::query("SELECT symbol FROM portafolio WHERE user_id = ?", $_SESSION["id"]);
        render("sell_form.php", ["title" => "Sell", "symbols" => $symbols]);
    }
     // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $shares = CS50::query("SELECT shares FROM portafolio WHERE user_id = ? AND symbol = ?", $_SESSION["id"],$_POST["symbol"]);
        $stock = lookup($_POST["symbol"]);
     
        $gain = $shares[0]["shares"] * $stock["price"];
        
        // para eliminar sumar lo que se gano de la venta de la accion:
        CS50::query("UPDATE users SET cash = (cash + ".$gain.") WHERE id = ?", $_SESSION["id"]);
        
        // para eliminar el symbol q ya se vendio:
        $rows = CS50::query("DELETE FROM portafolio WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $stock["symbol"]);
        CS50::query("INSERT INTO History (user_id, Transaction, Created_at, Symbol, Shares, Price) VALUES (?,'SELL',NOW(),?,?,?)", $_SESSION["id"], $_POST["symbol"], $shares[0]["shares"], $stock["price"]); 
        redirect("/");
    }
?>
