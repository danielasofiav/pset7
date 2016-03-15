<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("quote_form.php", ["title" => "Get a quote!"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $stock = lookup($_POST['symbol']);
        
        if($stock)
        {
            render("quote.php", ["title" => $stock['name'] ." quote", "stock" => $stock]);
        }
        else
        {
            apologize("The symbol you typed it is not valid.");
        }
    }

?>
