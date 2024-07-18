<?php

    function GetCategories($con)
    {
        $qry = "SELECT * FROM categories where inactive = 0";
        return mysqli_query($con, $qry);
    }

    function GetPosts($con)
    {
        $qry = "SELECT * FROM posts where inactive = 0";
        return mysqli_query($con, $qry);
    }


?>