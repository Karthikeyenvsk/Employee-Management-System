<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- JavaScript Bundle with Popper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="">Employee Details</h1>
                </div>
                <div class="col-md-6">
                    <a href="insert.php" class="btn btn-success"><i class="fa fa-plus p-2"></i>Add New Employee</a>
                </div>
                <?php

                require_once "Config.php";
                $sql = "SELECT * FROM employees";

                if ($result = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        echo '<table class="table table-hover">';

                        echo '<thead>';
                        echo '<tr>';
                        echo '<th scope="col">ID</th>';
                        echo '<th scope="col">Name</th>';
                        echo '<th scope="col">Address</th>';
                        echo '<th scope="col">Salary</th>';
                        echo '<th scope="col">Action</th>';
                        echo '</tr>';
                        echo '</thead>';

                        echo '<tbody>';
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<tr>';
                            // echo '<th scope="row">1</th>';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['address'] . '</td>';
                            echo '<td>' . $row['salary'] . '</td>';
                            echo "<td>";
                            echo '<a href = "view.php?id=' . $row['id'] . '" class ="p-2" title = "View Record" data-toggle = "tooltip"><span class="fa fa-eye"></span></a>';
                            echo '<a href = "edit.php?id=' . $row['id'] . '" class ="p-2" title = "Update Record" data-toggle = "tooltip"><span class="fa fa-pencil"></span></a>';
                            echo '<a href = "delete.php?id=' . $row['id'] . '" class ="p-2" title = "Delete Record" data-toggle = "tooltip"><span class="fa fa-trash"></span></a>';
                            echo "</td>";
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                        mysqli_free_result($result);
                    } else {
                        echo '<div class="alert alert-danger"><em>No Records were found.</em></div>';
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                mysqli_close($link);
                ?>

                <!-- <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        echo '
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table> -->
            </div>
        </div>
</body>

</html>