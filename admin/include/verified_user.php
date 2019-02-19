<?php
include "../../repository/aladinlk-function.php";
session_start();

$query="select * from email_users;";
$result=mysqli_query(DBConnection(),$query);

if (mysqli_num_rows($result)>0){
    echo "
  <div class=\"table-responsive\">
   <table class='table'>
    <thead>
        <tr>
            <th scope=\"col\">#</th>
            <th scope=\"col\">User Name</th>
            <th scope=\"col\">User ID</th>
            <th scope=\"col\">E-mail</th>
            <th scope=\"col\">Verified</th>
            <th scope=\"col\">Options</th>
        </tr>
    </thead>
    <tbody>";

    while ($row=mysqli_fetch_assoc($result)){

        echo "  
                <tr>
                    <th scope=\"row\">".$row['Id']."</th>
                    <td>".$row['user_name']."</td>
                    <td>".$row['user_id']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['Verified']."</td>
                    <td class='remove_one_user pointer' id='user_".$row['Id']."'>Remove</td>
                </tr>";

    }

    echo "
            </tbody>
        </table>
        </div>";

}
mysqli_close(DBConnection());
//remove all non verified accounts
echo "<button class='remove_all_non_verified btn btn-default'>Remove all (non verified)</button>";
?>



