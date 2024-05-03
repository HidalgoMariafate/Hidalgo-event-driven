<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postal Code</title>

    <script src="./assets/js/search.js"></script>

    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #ecf0f1;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="./assets/img/Tcc-Logo.png" height="30">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="./index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Registration</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <p class="h2 mt-3">Postal Code Registration</p>
        <p>You can add record for addresses here.</p>
        <div class="card mt-3">

            <form action="./models/save-postal-code.php" method="POST">
                <div class="card-header">Registration Form</div>
                <div class="card-body">
                <?php
                    if (isset($_GET['success'])) {
                        ?>
                        <div class="alert alert-success">
                            <b>New Postal Code Added.</b>.Congrats. Thank you!
                        </div>
                        <hr>
                        <?php
                    } elseif (isset($_GET['invalid'])) {
                        ?>
                        <div class="alert alert-danger">
                            <b>Existed Postal ID</b>. Please try another. Thank you.
                        </div>
                        <hr>
                        <?php
                    }
                    ?>

                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label>REGION: <b class="text-danger">*</b></label>
                            <select name="inp_region" id="inp_region" class="form-select"
                                onchange="display_province(this.value)">
                                <option value="" selected disabled>--Select Region--</option>
                                <?php
                                include ('./config/database.php');
                                $sql = "SELECT * FROM `ph_region` ";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $row['regCode'] ?>"><?= $row['regDesc'] ?></option>
                                        <?php
                                    }
                                } else {
                                    echo "0 result";
                                }
                                $conn->close();

                                ?>
                            </select>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label>PROVINCE: <b class="text-danger">*</b></label>
                            <select name="inp_province" id="inp_province" class="form-select"
                                onchange="display_ctymun(this.value)">
                                <option value="" selected disabled>--Select Province--</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label>CITY/MUNICIPALITY: <b class="text-danger">*</b></label>
                            <select name="inp_ctymun" id="inp_ctymun" class="form-select"
                                >
                                <option value="" selected disabled>--Select City/Municipality--</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label>POSTAL CODE: <b class="text-danger">*</b></label>
                            <input name="inp_postalcode" id="inp_postalcode" type="number" class="form-control"
                                placeholder="Postal Code here...">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <span style="float: right">
                        <button class="btn btn-success">
                            Add Postal Code
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</body>


<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

<script>
    function display_province(regCode) {
        $.ajax({
            url: './models/ph-address.php',
            type: 'POST',
            data: {
                'type': 'region',
                'post_code': regCode,
            },
            success: function (response) {
                $('#inp_province').html(response);
            }

        });
    }

    function display_ctymun(provCode) {
        $.ajax({
            url: './models/ph-address.php',
            type: 'POST',
            data: {
                'type': 'province',
                'post_code': provCode,
            },
            success: function (response) {

                $('#inp_ctymun').html(response);
            }

        });
    }

</script>

</html>