<?php
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    require_once "Config.php";

    $sql = "SELECT * FROM employees WHERE id = ? ";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = trim($_GET["id"]);

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
            echo "Oops! Something went wrong. Please try again later";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    echo header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Employee Records</title>
</head>
<style>
    .wrapper {
        width: 600px;
        margin: 0 auto;
    }
</style>

<body>
    <div class="wrapper card mt-5 ">
        <div class="container card-body bg-light bg-gradient ">
        
            <div class=" row">
            <span class="text-center fs-6 h1 badge bg-primary bg-gradient p-3">Employee Records</span>
                <div class="container align-items-center">
                    <form>
                        <div class="row ">
                            <div class="col-6">
                                <label class="form-label"><b>Employee Name :</b></label>
                            </div>
                            <div class="col">
                                <b><p class="card-text"><?php echo $row["name"]; ?></p></b>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label class="form-label"><b>Employee Address :</b></label>
                            </div>
                            <div class="col">
                            <b><p class="card-text"><?php echo $row["address"]; ?></p></b>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label class="form-label"><b>Employee Salary :</b></label>
                            </div>
                            <div class="col">
                            <b><p class="card-text"><?php echo $row["salary"]; ?></p></b>
                            </div>                         
                        </div>
                       
                    </form>
                   
                </div>
                <a href="index.php" class="btn btn-dark bg-gradient">Back</a>
            </div>
        </div>
    </div>
</body>

</html>