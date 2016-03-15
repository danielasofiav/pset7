<?php

    // configuration
    require("../includes/config.php"); 
    
    $id =  $_SESSION["id"];
    // cuantas acciones tiene el user
    $rows = CS50::query("SELECT id, symbol, shares FROM portafolio WHERE user_id = $id");
    
    // vista
    $positions = [];
    
    foreach ($rows as $row)
    {
        // preguntar por el symbol
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"],
                "total" => sprintf("%.2f", $row["shares"]*$stock["price"])
            ];
        }
    }
    // el cash balance
    $cash = CS50::query("SELECT username, cash FROM users WHERE id = $id");
    
    // render portfolio
    render("portfolio.php", ["positions" => $positions, "title" => "Positions", "cash" => $cash]);
?>
