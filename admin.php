<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin.css"> 
    <title>portfolio</title>
</head>
<body>
    <div class="container  my-5">
        <h2>list of clients</h2>
        <a class="btn btn-primary" href="/portfolio/create.php" role="button">New Clients</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Create At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php 
            $servername="localhost" ;
            $username="root";
            $password="";
            $database="portdb";

            //create conection
            $connection = new mysqli( $servername, $username, $password, $database);

            //check connection
            if($connection->connect_error){
                die("Connection failed;" . $connection->connect_error);
            }

            //read all rows from database table
            $sql ="SELECT * FROM messages";
            $result = $connection->query($sql);

            if (!$result){
                die("Invalid query: " .$connection->error);
            }

            //read data of each row
            while($row = $result->fetch_assoc()){
                echo"<tr>
                    <td>$row[MessageID]</td>
                    <td>$row[FullName]</td>
                    <td>$row[Email]</td>
                    <td>$row[PhoneNumber]</td>
                    <td>$row[Subject]</td>
                    <td>$row[Message]</td>
                    <td>$row[Status]</td>
                    <td>$row[CreatedAt]</td>
                    <td>
                        <a class='btn btn-primary btn-sn' href='/myshop/edit.php?id=$row[MessageID]'>edit</a>
                        <a class='btn btn-primary btn-sn' href='/myshop/delete.php?id=$row[MessageID]'>delete</a>
                    </td>
                </tr>
                ";
            }
            ?>
            <tbody>
                
            </tbody>
        </table>
    </div>
    
</body>
</html>