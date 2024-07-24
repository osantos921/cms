 <?php
   function getRandSalt($con)
   {
       $qry = "SELECT randSalt from users";
       $select_randsalt_qry = mysqli_query($con,$qry);
       $row = mysqli_fetch_assoc($select_randsalt_qry);
       if(!$select_randsalt_qry)
       {
          die("qry failed". mysqli_error($con)); 
       }
    
       return $row['randSalt'];
   }

function verifyPassword($provided_password, $stored_hash)
{
    return password_verify($provided_password, $stored_hash);
}

?> 