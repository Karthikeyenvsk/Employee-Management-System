<?php
require_once "Config.php";

$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please Enter a Name.";
    } else {
        $name = $input_name;
    }

    $input_address = trim($_POST["address"]);
    if (empty($input_address)) {
        $address_err = "Please Enter a Address.";
    } else {
        $address = $input_address;
    }

    $input_salary = trim($_POST["salary"]);
    if (empty($input_salary)) {
        $salary_err = "Please Enter a Salary.";
    } else {
        $salary = $input_salary;
    }

    if (empty($name_err) && empty($address_err) && empty($salary_err)) {
        $sql = "INSERT INTO employees (name, address, salary) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address, $param_salary);

            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;

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
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
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
                <h2 class="m-3 text-center">Enter the Employee Details</h2>
                <div class="col">
                    <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
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
                                <span class="invalid-feedback"><?php echo $address_err;?></span>
                            </div>
                        </div>
                        <div class="row m-3">
                            <div class="col-4">
                                <label class="form-label">Employee Salary :</label>
                            </div>
                            <div class="col">
                                <input name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" type="text" placeholder="Employee Salary" value="<?php echo $salary; ?>"></input>
                                <span class="invalid-feedback"><?php echo $salary_err;?></span>
                            </div>
                        </div>
                        <div class="row m-3">
                            <div class="col ">
                                <button type="submit" class="btn btn-primary " value="submit">Submit</button>
                                <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>