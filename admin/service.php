<?php
    include("partials-front/header.php")
// session_start(); //Dịch vụ bảo vệ
// if(!isset($_SESSION['loginOK']) || $_SESSION['loginOK'] != 'admin'){
//     header("Location:../login.php");
// }
// include '../config.php';
?>



    <div class="container">
        <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fas fa-user-plus"></i> Thêm dịch vụ
        </button> -->

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên dịch vụ</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Sửa dịch vụ</th>
                    <th scope="col">Xóa dịch vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $sql = "SELECT * from tb_tourservice";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><?php echo $row['id_tourservice']; ?></td>
                            <td><?php echo $row['nameservice']; ?></td>
                            <td><?php echo $row['priceservice']; ?></td>
                            <td><a data-bs-toggle="modal" data-bs-target="#editService" class="edit" id_tourservice="<?php echo $row['id_tourservice']; ?>"><i class="fas fa-user-edit" style="color:blue"></i></a></td>
                            <td><a data-bs-toggle="modal" data-bs-target="#deleteService" class="delete" id_tourservice="<?php echo $row['id_tourservice']; ?>" href="./deleteService.php?id=<?php echo $row['id_tourservice']; ?>"><i class="fas fa-user-times" style="color:red"></i></a></td>
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
        <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm dịch vụ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="./process-add-service.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Tên dịch vụ</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nhập tên dịch vụ" name="nameservice">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Giá dịch vụ</label>
                                <input type="text" class="form-control2" id="formGroupExampleInput" placeholder="Nhập giá dịch vụ" name="priceservice">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="addService">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->

        <!-- Modal edit -->
        <!-- <div class="modal fade" id="editService" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa dịch vụ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="./process-edit-service.php" method="POST" class="form_edit_service">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="id_service">ID</label>
                                <input type="text" class="form-control" id="id_service" value="" name="id_tourservice" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="name_service_new">Tên dịch vụ mới</label>
                                <input type="text" class="form-control" id="name_service_new" placeholder="Nhập tên dịch vụ" name="name_service_new">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="editService" id="btnEditService">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> -->

        <!-- Modal delete -->
        <!-- <div class="modal fade" id="deleteService" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xóa dịch vụ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="./process-delete-service.php" method="POST" class="form_edit_service">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="id_service_delete">ID</label>
                                <input type="text" class="form-control" id="id_service_delete" value="" name="id_service_delete" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="name_service_delete">Tên dịch vụ</label>
                                <input type="text" class="form-control" id="name_service_delete" placeholder="Nhập tên dịch vụ" name="name_service_delete" readonly="readonly">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="deleteService" id="btnDeleteService">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $(".edit").click(function() {
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();
                $("#id_tourservice").attr('value', data[0]);
                $("#name_service_new").val(data[1]);
            });

            $(".delete").click(function() {
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();
                $("#id_service_delete").attr('value', data[0]);
                $("#name_service_delete").val(data[1]);
            });
        });
    </script>
</body>

</html>