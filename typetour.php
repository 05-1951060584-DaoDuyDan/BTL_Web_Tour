<?php
include('config/config.php');
if (isset($_SESSION['LoginOK'])) {
    $user = substr($_SESSION['LoginOK'], 1, 60);
    $user = rtrim($user);
}
?>



    <div class="container">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên dịch vụ</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Khóa dịch vụ</th>
                    <th scope="col">Mở dịch vụ</th>
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
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#editService" class="edit" id_tourservice="<?php echo $row['id_tourservice']; ?>">
                                <i class="fas fa-lock text-center" style="color:blue"></i></a>
                            </td>
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#deleteService" class="delete" id_tourservice="<?php echo $row['id_tourservice']; ?>" href="./deleteService.php?id=<?php echo $row['id_tourservice']; ?>">
                                <i class="fas fa-lock-open text-center" style="color:red"></i></a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

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