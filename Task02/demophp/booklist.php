<head>
    <title>Booklist</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

</head>
<body>
<?php
$myDB = new mysqli('localhost','root','','library');
if ($myDB->connect_error){

    die('Connect Error (' . $myDB->connect_error . ')'
            .$myDB->connect_error);
}
$sql = "SELECT * FROM book WHERE available = 1 ORDER  BY bookid ASC";
$result = $myDB->query($sql);
?>

<h3 class="p-3 text-center" >These books are currently available</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">BookID</th>
            <th scope="col">Title</th>
            <th scope="col">Publish Year</th>
            <th scope="col">ISBN</th>
        </tr>
    </thead>
    <tbody>
    <?php
    while ($row = $result->fetch_assoc() ){
        echo "<tr>";
        echo "<td>";
        echo $row["bookid"];
        echo  "</td>";
        echo "<td>";
        echo stripslashes($row["title"]);
        echo "</td><td>";
        echo $row["pub_year"];
        echo "</td><td>";
        echo $row["ISBN"];
        echo "</td>";
        echo "</tr>";
    }
    ?>
        </tbody>
    </table>
</body>
</htlml>
