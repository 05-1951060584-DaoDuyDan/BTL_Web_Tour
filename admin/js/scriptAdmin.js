$(document).ready(function(){
    $(".clickinformation").click(function(){
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        let form_datas = new FormData();
        form_datas.append('codetour',data[0]);
        $.ajax({
            url: 'process-informationTour.php', // gửi đến file upload.php 
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datas,
            type: 'post',
            success: function(res) {
                $(".modal-body").html(res);
            }
        });
        return false;
    })
})//clickBooking
$(document).ready(function(){
    $(".clickBooking").click(function(){
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();
        let form_datas = new FormData();
        console.log($(this).val());
        form_datas.append('codebookingtour',data[1]);
        $.ajax({
            url: '../process-informationBookingTour.php', // gửi đến file upload.php 
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_datas,
            type: 'post',
            success: function(res) {
                $(".modal-body").html(res);
            }
        });
        return false;
    })
})