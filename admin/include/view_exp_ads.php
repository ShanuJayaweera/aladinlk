<?php
require_once "../../repository/aladinlk-function.php";

date_default_timezone_set('Asia/Colombo');

/* Get expired date. */
$expire_date = date("Y-m-d H:i:s",strtotime("-30 days"));

$result=mysqli_query(DBConnection(),"SELECT * FROM advertisement WHERE modified <= '".$expire_date."'");

if (mysqli_num_rows($result)>0){
    echo "
  <div class=\"table-responsive\">
   <table class='table'>
    <thead>
        <tr>
            <th scope=\"col\">#</th>
         
            <th scope=\"col\">Image</th>
            <th scope=\"col\">Title</th>
            <th scope=\"col\">Modified</th>
            <th scope=\"col\">Remove AD</th>
            <th scope=\"col\">Renew AD</th>
        </tr>
    </thead>
    <tbody>";

    while ($row=mysqli_fetch_assoc($result)){


        echo "  
                <tr>
                    <th scope=\"row\">".$row['id']."</th>
                    <td><img class='group list-group-image product-img' src='".$row['main_img']."' alt='Ad-img-".$row['id']."' /></td>
                    <td>".$row['title']."</td>
                    <td>".$row['modified']."</td>
                    <td style='color: red' class='remove_exp_ad pointer' id='remove_exp".$row['id']."'>Remove Ad</td>
                    <td style='color: red' class='renew_exp_ad pointer' id='renew_exp".$row['id']."'>Renew Ad</td>
                </tr>";

    }

    echo "
            </tbody>
        </table>
        </div>";

}
else{
    echo "<div class='alert alert-info fade in'>
                <h6>All Advertisements are verified.</h6>
              </div>";
}
mysqli_close(DBConnection());
?>