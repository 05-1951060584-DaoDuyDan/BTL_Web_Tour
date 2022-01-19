<?php
include 'config/config.php';
//   session_start(); //Dịch vụ bảo vệ
  if(!isset($_SESSION['loginOK']) || $_SESSION['loginOK'] != 'admin'){
      header("Location:login.php");
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
            <i class="fas fa-user-plus"></i> Thêm loại tour
        </button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên loại tour</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $sql = "SELECT * from tb_typetour";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><?php echo $row['id_typetour']; ?></td>
                            <td><?php echo $row['nametypetour']; ?></td>
                            <td><a data-bs-toggle="modal" data-bs-target="#edittypetour" class="edit" id_typetour="<?php echo $row['id_typetour']; ?>"><i class="fas fa-user-edit" style="color:blue"></i></a></td>
                            <td><a data-bs-toggle="modal" data-bs-target="#deletetypetour" class="delete" id_typetour="<?php echo $row['id_typetour']; ?>" href="./deletetypetour.php?id=<?php echo $row['id_typetour']; ?>"><i class="fas fa-user-times" style="color:red"></i></a></td>
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
                        <h5 class="modal-title" id="exampleModalLabel">Thêm loại tour</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="./process-add-typetour.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Tên loại tour</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nhập tên loại tour" name="nametypetour">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="addtypetour">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal edit -->
        <div class="modal fade" id="edittypetour" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa loại tour</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="./process-edit-typetour.php" method="POST" class="form_edit_typetour">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="id_typetour">ID</label>
                                <input type="text" class="form-control" id="id_typetour" value="" name="id_typetour" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="nametypetour_new">Tên loại tour mới</label>
                                <input type="text" class="form-control" id="nametypetour_new" placeholder="Nhập tên loại tour" name="nametypetour_new">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="edittypetour" id="btnEdittypetour">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal delete -->
        <div class="modal fade" id="deletetypetour" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xóa loại tour</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="./process-delete-typetour.php" method="POST" class="form_edit_typetour">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="id_typetour_delete">ID</label>
                                <input type="text" class="form-control" id="id_typetour_delete" value="" name="id_typetour_delete" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="nametypetour_delete">Tên dịch vụ</label>
                                <input type="text" class="form-control" id="nametypetour_delete" placeholder="Nhập tên loại tour" name="nametypetour_delete" readonly="readonly">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="deletetypetour" id="btntypetour">Delete</button>
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
                $("#id_typetour").attr('value', data[0]);
                $("#nametypetour_new").val(data[1]);
            });

            $(".delete").click(function() {
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();
                $("#id_typetour_delete").attr('value', data[0]);
                $("#nametypetour_delete").val(data[1]);
            });
        });
    </script>
</body>

</html>