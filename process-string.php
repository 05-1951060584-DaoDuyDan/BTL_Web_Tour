<?php
    
    function processString($stringa){
        $data = explode("$$", $stringa);
        $mang = array();
        for ($i = 0; $i < count($data); $i++) {
            $data1 = explode(":", $data[$i], 2);
            for ($j = 0; $j < count($data1); $j++) {
                $mang[] = $data1[$j];
            }
        }
        for ($i = 0; $i < count($mang); $i++) {
            if ($i % 2 == 0) {
                $mang[$i] = "<h4>" . $mang[$i] . ":" . "</h4>";
            }
        }

        for ($i = 0; $i < count($mang); $i++) {
            if ($i % 2 == 1) {
                $stringcd = "<ul>";
                $mangphu = explode(".", $mang[$i]);
                for ($j = 0; $j < count($mangphu) - 1; $j++) {
                    $stringtmp = "<li>" . $mangphu[$j] . "</li>";
                    $stringcd = $stringcd . $stringtmp;
                }
                $stringcd = $stringcd . "</ul>";
                $mang[$i] = $stringcd;
            }
        }
        $sxcc = "";
        for ($i = 0; $i < count($mang); $i++) {
            $sxcc = $sxcc . $mang[$i];
        }
        print_r($sxcc);
    }
    /*
    $string = "GIÁ VÉ BAO GỒM:
    Vận chuyển: Xe 29, 45 chỗ đời mới có máy lạnh, đưa đón khách đi theo chương trình tour.
    Khách sạn 2 sao hoặc tương đương 2 sao, gần Trung Tâm: LIILY, PX, TÂM DUNG,… Tiêu chuẩn: 4 - 6 khách/1 phòng, có tivi, tủ lạnh, điện thoại, nước nóng vệ sinh riêng, sạch sẽ, an toàn.
    Ăn uống gồm: 3 bữa sáng + 3 bữa trưa + 2 bữa tối.
    Hướng dẫn viên thuyết minh và phục vụ cho đoàn suốt tuyến.
    Vé tham quan vào cửa các thắng cảnh.
    $$
    GIÁ VÉ KHÔNG BAO GỒM:
    Phụ thu khách sạn:
    Phòng đôi 2 người: 400000 vnđ/phòng/2 đêm.
    Phòng đơn 1 người: 900000vnd/phòng/2 đêm.
    Xe ngựa, vui chơi giải trí cá nhân, và các chi phí ăn uống ngoài chương trình.
    Thưởng thức nước uống không bao gồm trong chương trình.
    Thuế VAT 10%.
    Chi phí xét nghiệm covid.
    $$
    GIÁ VÉ KHÔNG BAO GỒM:
    Phụ thu khách sạn:
    Phòng đôi 2 người: 400000 vnđ/phòng/2 đêm.
    Phòng đơn 1 người: 900000vnd/phòng/2 đêm.
    Xe ngựa, vui chơi giải trí cá nhân, và các chi phí ăn uống ngoài chương trình.
    Thưởng thức nước uống không bao gồm trong chương trình.
    Thuế VAT 10%.
    Chi phí xét nghiệm covid.
    ";
    processString($string);*/

    
?>