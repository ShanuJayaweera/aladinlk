<?php
include "../../repository/aladinlk-function.php";
session_start();

$query="select id,main_img,title from advertisement where verified=0 and posted=1;";
$result=mysqli_query(DBConnection(),$query);

if (mysqli_num_rows($result)>0){
    echo "
  <div class=\"table-responsive\">
   <table class='table'>
    <thead>
        <tr>
            <th scope=\"col\">#</th>
         
            <th scope=\"col\">Image</th>
            <th scope=\"col\">Title</th>
            <th scope=\"col\">Options</th>
        </tr>
    </thead>
    <tbody>";

    while ($row=mysqli_fetch_assoc($result)){


        echo "  
                <tr>
                    <th scope=\"row\">".$row['id']."</th>
                    <td><img class='group list-group-image product-img' src='".$row['main_img']."' alt='Ad-img-".$row['id']."' /></td>
                    <td>".$row['title']."</td>
                   
                    <td style='color: red' class='view_ad pointer' id='view_".$row['id']."'>View</td>
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

