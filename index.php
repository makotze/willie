<?php

    require "DataModel.php";
    $dm = new DataModel();


    if(array_key_exists("action", $_POST)){

        if(isset($_POST["row_id"])){

            if($_POST["action"] == "row-delete"){

                $row_id = $_POST["row_id"];

                $result_c = $dm->delete_row($row_id);

                if($result_c){
                    die("SUCCESS");
                }else{
                    die("Something went wrong with the query ... ");
                }
            }else{
                die("Cannot preform this function ... ");
            }
        }else{
            die("Row ID missing, please provide ... ");
        }
        die("Should not see this ... ");
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Example</title>

        <link rel="stylesheet" href="css/style.css" >

        <!-- JQuery Libs -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <!-- Bootstrap Libs -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">


        <script>
            $(function(){


                $(".delete-me").on("click", function(){

                    var $t      = $(this);
                    var row_id  = $t.attr("rid");

                    $.post("index.php", {'action':'row-delete', row_id:row_id}, function(ret){
                        if(ret == "SUCCESS"){
                            $t.parent().parent().fadeOut("slow");
                        }else{
                            console.log(ret);
                        }
                    });

                });

            });

        </script>

    </head>
    <body>
    <div class="my-heading">My Websitx</div>
        <div class="container">
            <h3></h3>
            <div class="row">
                <div class="col-md-3">
                    <ul>
                        <li>Menu item 1</li>
                        <li>Menu item 2</li>
                        <li>Menu item 3</li>
                    </ul>
                </div>
                <div class="col-md-9">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th>Full Name</th>
                            <th>User name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>

                        <?php

                            $result = $dm->getUsers();
                            $c = 0;
                            while($row = $result->fetch_assoc()) {
                                print '<tr>
                                    <td><a href="/sandbox2/willie/?email='.$row["email"].'">'.$row["full_name"].'</a></td>
                                    <td>'.$row["username"].'</td>
                                    <td>'.$row["email"].'</td>
                                    <td><button class="btn btn-xs btn-danger delete-me" rid="'.$row["id"].'">Delete</button></td>
                                </tr>';
                                $c++;
                            }

                            if($c == 0){
                                print '<tr>
                                        <td colspan="4" style="text-align: center">No users found ...</td>
                                    </tr>';
                            }




                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>