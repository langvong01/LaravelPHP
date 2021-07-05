<?php
// include
require_once 'config.php';
//define variables and innitilizie emty vavlues
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validate Name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)){
        $name_err = "Please enter a name";
    }elseif (!filter_var(trim($_POST["name"]),FILTER_VALIDATE_REGEXP,
        array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $name_err = "Please enter a vavid name";
    }else {
        $name = $input_name;
    }

    // Validate adreess
    $input_address = trim($_POST["address"]);
    if (empty($input_address)) {
        $address_err = "Please enter a address";
    }else {
        $address = $input_address;
    }
    // Validate salary
    $input_salary = trim($_POST["salary"]);
    if (empty($input_salary)){
        $salary_err = "Please enter a  amount";
    }elseif (!ctype_digit($input_salary)) {
        $salary_err = "Please enter a positive interger value";
    }else {
        $salary = $input_salary;
    }
    // Check input errors before inserting in database
    if (empty($salary_err) && empty($address_err) && empty($name_err)) {
        $sql = "INSERT INTO employees (name,address,salary) VALUES (?,?,?)";
        if ($stmt = mysqli_prepare($link,$sql)) {
            //bind variable to the prepare statement as parameters
            mysqli_stmt_bind_param($stmt,"ssi",$param_name,$param_address,$param_salary);
            // set parameter
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;

            if (mysqli_stmt_execute($stmt)) {
                header("location : index.php");
                exit();
            }else{
                echo "Something went wrong. Please try again later";
            }
    }
        // close statement
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title> Create Record</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <style type="text/css">
            .wrapper {
                width:  500px;
                margin: 0 auto;
            }
        </style>
    </head>
<body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                                <h2> Create Record</h2>
                        </div>
                        <p>Please fill this form and submid to add employee record to the database</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error': '';?>">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="">
                                <span class="help-block"><?php echo $name_err;?></span>
                            </div>

                            <div class="form-group <?php echo (!empty($address_err)) ? 'has-error':'';?>">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" value="">
                                <span class="help-block"><?php echo $address_err;?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($salary_err)) ? 'has-error':'';?>">
                                <label>Salary</label>
                                <input type="text" name="salary" class="form-control" value="">
                                <span class="help-block"><?php echo $salary_err;?></span>
                            </div>

                            <input type="submit" class="btn btn-primary" value="Submit">
                            <a href="index.php" class="btn btn-default">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>

