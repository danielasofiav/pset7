<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // TODO
        // valid passwords?
        if ($_POST["username"] == null)
        {
            apologize("You must set your username.");
        }
        if ($_POST["password"] == null)
        {
            apologize("You must establish your password.");
        }
        if ($_POST["confirmation"] == null)
        {
            apologize("You must confirm your password.");
        }
        if ($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Your paswords do not match!");
        }
        // agregar el nuevo id a la database
        $result = CS50::query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.00)",$_POST['username'],password_hash($_POST["password"], PASSWORD_DEFAULT));
        // si ya existe
        if ($result === false)
        {
            apologize("This username already exists.");
        }
        // entrar a index
        else
        {
            $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];
            $_SESSION["id"] = $id;
            redirect("index.php");
        }
    }