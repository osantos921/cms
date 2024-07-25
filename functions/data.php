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

    function GetCommentPostCount($con,int $post_id)
    {
        $qry = "SELECT COUNT(*) as count FROM comments WHERE commentPostId= $post_id AND commentStatus= 'Approved' AND inactive = 0 ORDER BY commentId DESC";
        $result = mysqli_query($con, $qry);
        $row = mysqli_fetch_assoc($result);
       
        if ($row) {
            return $row['count'];
        } else {
            return 0;
        }
    }

    function GetUserPassword($con,int $user_id)
    {
        $qry = "SELECT * FROM users WHERE userId = $user_id AND inactive = 0";
        $result = mysqli_query($con, $qry);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            return $row['userPassword'];
        } else {
            return "";
        }
    }

?>