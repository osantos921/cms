<?php

    function GetCategories($con)
    {
        $qry = "SELECT * FROM categories WHERE inactive = 0";
        return mysqli_query($con, $qry);
    }

    function GetPosts($con)
    {
        $qry = "SELECT * FROM posts WHERE inactive = 0 ORDER BY postId DESC";
        return mysqli_query($con, $qry);
    }

    function GetComment($con,int $post_id)
    {
        $qry = "SELECT * FROM comments WHERE commentPostId= $post_id AND commentStatus= 'Approved' AND inactive = 0 ORDER BY commentId DESC";
        return mysqli_query($con, $qry);
    }


?>