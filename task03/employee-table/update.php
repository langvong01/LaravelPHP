<?php
    require_once 'config.php';
    $name = $address = $salary = "";
    $name_err = $address_err = $salary_err = "";

   // Processing form data when form is submitted
    if (isset($_POST["id"]) && !empty($_POST["id"])) {
        $id = $_POST["id"];


        // Validate name
        $input_name = trim($_POST["name"]);
        if (empty($input_name)) {
            $name_err = "PLease enter a name";
        } elseif (!filter_var(trim($_POST["name"]),FILTER_VALIDATE_REGEXP,
            array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
            $name_err = "Please enter a vavid name";

        } else {
            $name = $input_name;
        }

        //Validate address address
        $input_address = trim($_POST["address"]);
        if (empty($input_address)) {
            $address_err = "Please enter a Address";
        } else {
            $address = $input_address;
        }

        // validate salary
        $input_salary = trim($_POST["salary"]);
        if (empty($input_salary)) {
            $salary_err = "Please enter a salary";
        } elseif (!ctype_digit($input_salary)) {
            $salary_err = 'Please enter a valid salary';
        } else {
            $salary = $input_salary;
        }
        if (empty($name_err) && empty($address_err) && empty($salary_err)) {
            $sql = "UPDATE employees SET name = ? , address = ?, salary = ? WHERE id = ?";
        }
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_address, $param_salary, $param_id);
            $param_name = $name;
            $param_salary = $salary;
            $param_address = $address;
            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {
                header("location : index.php");
                exit();
            } else {
                echo "Something went wrong, Please try again";
            }
            mysqli_stmt_close($stmt);
    }
        mysqli_close($link);

        }else{
        if (isset($_GET["id"]) && !empty($_GET["id"])) {
            $id = $_GET["id"];
            $sql = "SELECT * FROM employees WHERE id = ?";
            if ($stmt = mysqli_prepare($link,$sql)){
                mysqli_stmt_bind_param($stmt, "i",$param_id);
                $param_id = $id;
                if (mysqli_stmt_execute($stmt)){
                    $result =  mysqli_stmt_get_result($stmt);
                    if (mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                        $name = $row ["name"];
                        $address = $row ["address"];
                        $salary = $row ["salary"];
                    }else{
                        header("location :error.php");
                        exit();
                    }
                }else{
                    echo  "Oops, something went wrong. Please try again later";
                }
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);
    }
?>
<!DOCTYPE hmtl>
<html>
<head>
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin:  0 auto;
        }
    </style>

</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Update Record</h2>
                </div>
            <p>Please edit input values and submit to uppdate the record </p>
            <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI']));?>" method="post">
                <div class="form-group <?php echo !(empty($name_err))? 'has-error': '';?>">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $name;?>">
                    <span class="help-block"><?php echo $name_err;?></span>
                </div>

                <div class="form-group <?php echo !(empty($address_err))? 'has-error': '';?>">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" value="<?php echo $address;?>">
                    <span class="help-block"><?php echo $address_err;?></span>
                </div>

                <div class="form-group <?php echo !(empty($salary_err))? 'has-error': '';?>">
                    <label>Salary</label>
                    <input type="text" name="salary" class="form-control" value="<?php echo $salary;?>">
                    <span class="help-block"><?php echo $salary_err;?></span>
                </div>
                <input type="hidden" name="id" value="<?php  echo $id;?>">
                <input type="submit" class="btn btn-primary" value="submit">
                <a href="index.php" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>
</div>
</div>
</body>
</html>
