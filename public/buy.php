<?php
    // configuration
    require("../includes/config.php"); 
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        //dump($_GET);
        // crear variable
        $symbol = empty($_GET["symbol"]) ? "" : $_GET["symbol"];
        // else render form
        render("buy_form.php", ["title" => "Buy","symbol"=>$symbol]);
    }
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(!preg_match("/^\d+$/", $_POST["shares"]))
        {
            apologize("You have to enter the amount of shares you want to buy (a postive entire number).");
        }
        else if($_POST["symbol"] == null)
        {
            apologize("You must select a valid symbol.");
        }
        else if($_POST["shares"] == null)
        {
            apologize("You must enter how many shares you want to buy.");
        }
        // else if($_POST["shares"] == 0); // Aquí tenias punto y coma
        else if($_POST["shares"] == 0)
        {
            apologize("You have to especify how many shares you want to buy.");
        }
        $stock = lookup($_POST["symbol"]);
        if($stock == 0)
        {
            apologize("Please enter a valid symbol");
        }
        else
        {
            $stock = lookup($_POST["symbol"]);
            $purchase = $_POST["shares"] * $stock["price"];
            $rowcash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
            $cash = $rowcash[0]["cash"];
            
            //si si tiene el cash para comprar
            if ($cash > $purchase)
            {
                //cs50::query("INSERT INTO portafolio (user_id, symbol, shares) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], $_SESSION["symbol"], $_SESSION["shares"]);
                // Ahi tambien tnias SESSION en las variables que llegaban en POST
                CS50::query("INSERT INTO portafolio (user_id, symbol, shares) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + ?", $_SESSION["id"], $_POST["symbol"], $_POST["shares"], $_POST["shares"]); 
                CS50::query("UPDATE users SET cash = (cash - ".$purchase.") WHERE id = ?", $_SESSION["id"]);
                CS50::query("INSERT INTO History (user_id, Transaction, Created_at, Symbol, Shares, Price) VALUES (?,'BUY',NOW(),?,?,?)", $_SESSION["id"], $_POST["symbol"], $_POST["shares"], $stock["price"]); 
                redirect("/");
            }
            else
            {
                // si no le alcanza el money
                if ($cash < $purchase)
                {
                    apologize("You can not afford that");
                }
            }
            
        }
    }
?>