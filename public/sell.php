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
        if ($_POST["symbol"]=='symbol')
        {
            apologize("Please enter the stock symbol.");
        }
        $shares = CS50::query("SELECT shares FROM portafolio WHERE user_id = ? AND symbol = ?", $_SESSION["id"],$_POST["symbol"]);
        $stock = lookup($_POST["symbol"]);
        
        $gain = $shares[0]["shares"] * $stock["price"];
        
        $sell_share = $_POST["sell_share"];
        
        if ($_POST["sell_share"] == NULL)
        {
            apologize("Please enter the number of shares you want to sell.");
        }
        else if ($_POST["sell_share"] < 0)
        {
            apologize("Be sure you entered a positive number.");
        }
        else if ($_POST["sell_share"] > $shares[0]["shares"])
        {
            apologize("You don't have that amount of shares. Shares can't be sold.");
        }
        else if(!preg_match("/^\d+$/", $_POST["sell_share"]))
        {
            apologize("You have to enter the amount of shares you want to buy (a postive entire number).");
        }
        
        $value = $stock["price"] * $sell_share; // punto y coma ....... se llama value
        
        // para sumar lo que se gano de la venta de la accion:
       if ($_POST["sell_share"] < $shares[0]["shares"])
        {
            $rows = CS50::query("UPDATE portafolio SET shares = (shares - ".$sell_share.") WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $stock["symbol"]);
        }
        else if ($_POST["sell_share"] == $shares[0]["shares"])
        {
            $rows = CS50::query("DELETE FROM portafolio WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $stock["symbol"]);
        }
        
        CS50::query("UPDATE users SET cash = (cash + ".$value.") WHERE id = ?", $_SESSION["id"]);
        $type = 'Sell';
        CS50::query("INSERT INTO History (user_id, Transaction, Symbol, Shares, Price) VALUES (?, ?, ?, ?, ?)", $_SESSION["id"], $type, $_POST["symbol"], $shares[0]["shares"], $stock["price"]);
        
        redirect("/");    
    }
?>
