<?php

require_once "Config.php";

$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];

    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please Enter a Employee Name";
    } else {
        $name = $input_name;
    }

    $input_address = trim($_POST["address"]);
    if (empty($input_address)) {
        $address_err = "Please Enter a Employee Address";
    } else {
        $address = $input_address;
    }

    $input_salary = trim($_POST["salary"]);
    if (empty($input_salary)) {
        $salary_err = "Please Enter a Employee Salary";
    } else {
        $salary = $input_salary;
    }

    if (empty($name_err) && empty($address_err) && empty($salary_err)) {
        $sql = "UPDATE employees SET name = ?, address = ?, salary = ? WHERE id = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_address, $param_salary, $param_id);

            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id = trim($_GET["id"]);

        $sql = "SELECT * FROM employees WHERE id =?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $name = $row["name"];
                    $address = $row["address"];
                    $salary = $row["salary"];
                } else {
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went Wrong. Please try Again Later.";
            }
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        } else {
            header("location: error.php");
            exit();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Edit Employee Details</title>
</head>
<style>
    .wrapper {
        width: 600px;
        margin: 0 auto;
    }
</style>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <h2 class="m-3 text-center">Update the Employee Details</h2>
                <div class="col">
                    <form class="" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="row m-3">
                            <div class="col-4">
                                <label class="form-label">Employee Name :</label>
                            </div>
                            <div class="col">
                                <input name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" type="text" placeholder="Employee Name" value="<?php echo $name; ?>"></input>
                                <span class="invalid-feedback"><?php echo $name_err; ?></span>
                            </div>

                        </div>
                        <div class="row m-3">
                            <div class="col-4">
                                <label class="form-label">Employee Address :</label>
                            </div>
                            <div class="col">
                                <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" type="text" placeholder="Employee Address"><?php echo $address; ?></textarea>
                                <span class="invalid-feedback"><?php echo $address_err; ?></span>
                            </div>
                        </div>
                        <div class="row m-3">
                            <div class="col-4">
                                <label class="form-label">Employee Salary :</label>
                            </div>
                            <div class="col">
                                <input name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" type="text" placeholder="Employee Salary" value="<?php echo $salary; ?>"></input>
                                <span class="invalid-feedback"><?php echo $salary_err; ?></span>
                            </div>
                        </div>
                        <div class="row m-3">
                            <div class="col ">

                                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                                
                                <button type="submit" class="btn btn-primary " value="submit">Submit</button>
                                <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Salary</label>
                            <input type="text" name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div> -->
</body>

</html>