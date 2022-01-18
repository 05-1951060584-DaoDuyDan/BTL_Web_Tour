<?php
include('partials-front/header.php');
require "../config/config.php";
if (isset($_SESSION['LoginOK']) && substr($_SESSION['LoginOK'], 0, 1) == '3') {
    
} else {
    header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
</head>


    <div class="container">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fas fa-user-plus"></i> Thêm loại trang
        </button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên loại trang</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $sql = "SELECT * from tb_typepage";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><?php echo $row['id_typepage']; ?></td>
                            <td><?php echo $row['nametypepage']; ?></td>
                            <td><a data-bs-toggle="modal" data-bs-target="#edittypepage" class="edit" id_typepage="<?php echo $row['id_typepage']; ?>"><i class="fas fa-user-edit" style="color:blue"></i></a></td>
                            <td><a data-bs-toggle="modal" data-bs-target="#deletetypepage" class="delete" id_typepage="<?php echo $row['id_typepage']; ?>" href="./deletetypepage.php?id=<?php echo $row['id_typepage']; ?>"><i class="fas fa-user-times" style="color:red"></i></a></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="container">
        <!-- Modal add -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm loại trang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="process-add-typepage.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Tên loại trang</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nhập tên loại trang" name="nametypepage">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="addtypepage">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal edit -->
        <div class="modal fade" id="edittypepage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa loại trang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="./process-edit-typepage.php" method="POST" class="form_edit_typepage">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="id_typepage">ID</label>
                                <input type="text" class="form-control" id="id_typepage" value="" name="id_typepage" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="nametypepage_new">Tên loại trang mới</label>
                                <input type="text" class="form-control" id="nametypepage_new" placeholder="Nhập tên loại trang" name="nametypepage_new">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="edittypepage" id="btnEdittypepage">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal delete -->
        <div class="modal fade" id="deletetypepage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xóa loại trang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="./process-delete-typepage.php" method="POST" class="form_edit_typepage">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="id_typepage_delete">ID</label>
                                <input type="text" class="form-control" id="id_typepage_delete" value="" name="id_typepage_delete" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="nametypepage_delete">Tên dịch vụ</label>
                                <input type="text" class="form-control" id="nametypepage_delete" placeholder="Nhập tên loại trang" name="nametypepage_delete" readonly="readonly">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="deletetypepage" id="btntypepage">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $(".edit").click(function() {
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();
                $("#id_typepage").attr('value', data[0]);
                $("#nametypepage_new").val(data[1]);
            });

            $(".delete").click(function() {
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();
                $("#id_typepage_delete").attr('value', data[0]);
                $("#nametypepage_delete").val(data[1]);
            });
        });
    </script>
</body>

</html>