<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("feature_form.php", ["title" => "Deposit"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // si pone cosas que no son validas
        if (preg_match("/^\d+$/", $_POST["add"] == NULL))
        {
            apologize("You must enter only valid data");
        }
        else if ($_POST["add"] == NULL)
        {
            apologize("Especify the sum of money you want to deposit.");
        }
        else
        {
            CS50::query("UPDATE users SET cash = (cash + ?) WHERE id = ?", $_POST["add"], $_SESSION["id"]);
        }
        redirect("/");
    }

?>