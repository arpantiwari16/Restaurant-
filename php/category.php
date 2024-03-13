<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../js/jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <script src="../js/restaurant.js"></script>
    <script src="../js/time.js"></script>
    <script src="../js/category.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <style>
        * {
            overflow: hidden;
        }
    </style>
    <script>
        $(function() {
            $("#lp_category").css("backgroundColor", "#78C1F3");
            $("#lp_category a").css("color", "white");

        });
    </script>


</head>

<body class="">
    <?php
    session_start();
    include "navbar.php";
    ?>
    <section>
        <div class="row">
            <div class="col-2 mt-3">
                <?php
                include "leftpanel.php";

                ?>
            </div>
            <div class="col-10 mt-4">
                <div class="center">
                    <!-- <h6 class="mb-4 mt-3"><u>Category</u></h6> -->
                </div>
                <div class="w-75 mx-auto ">
                    <table id="cat_table" class="table mx-auto mt-3 table-bordered  ">
                        <thead>
                            <th>s.no</th>
                            <th>category</th>
                            <th>
                                <span>select all </span> <input type="checkbox" name="all" id="all" class="form-check-input">

                            </th>
                        </thead>
                        <tbody>
                            <?php
                            $sno = 1;
                            $check = '';
                            $pdo = new PDO("mysql:host=localhost;dbname=restaurant", "root", "");  //connection
                            $pdostm = $pdo->prepare("select * from category");          //query we use prepare
                            $pdostm->execute();                                                   //execute

                            while ($r = $pdostm->fetch(PDO::FETCH_ASSOC)) {                       //fetch
                                echo "<tr><td>" . "$sno" . "<td>" . '<a href="" class="anc" id="' . $r["id"] . '" value="' . $r["category"] . '" data-bs-toggle="modal" data-bs-target="#exampleModal1"  >' . $r["category"] . '</a>' .
                                    "<td>" . '<input type="checkbox" name="cb[]" value="' . $r["category"] . '" id="" class="form-check-input cb1">';
                                $sno++;
                            }

                            #"<td>" . '<a href="" class="anc" id="' . $r["id"] . '" value="' . $r["category"] . '" data-bs-toggle="modal" data-bs-target="#exampleModal1"  >' . $r["id"] . '</a>'  . 
                            ?>
                        </tbody>
                        <tfoot>
                            <td></td>
                            <td></td>
                            <td><input type="button" value="delete" id="delete" class="btn btn-danger btn-sm">
                                <input type="button" value="new" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary btn-sm ms-3">
                            </td>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </section>
</body>

</html>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">new menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-primary">
                    <tr>
                        <td>category</td>
                        <td><input type="text" class="form-control" id="category1" placeholder="enter category"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="button" id="model_save" value="save" class="btn btn-primary">
                        </td>
                    </tr>

                </table>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">update category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-primary">
                    <tr>
                        <td>category</td>
                        <td><input hidden type="text" id="catid"><input type="text" class="form-control " id="category2" placeholder="enter category"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="button" id="model_save1" value="save" class="btn btn-primary">
                        </td>
                    </tr>

                </table>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#cat_table').DataTable();
    });
</script>