<?php

    $to = "it@apec-tc.kz";
    $subject = "Robot - Accommodation Portal";
    $message = "Еженедельный отчет:<span style='color:green;font-weight: bold;'><a href='http://127.0.0.1:8000/admin/report/dailyReport'>Скачать</a></span>
            <br/>
            <i>Это письмо отправлено <b>роботом</b>
            и отвечать на него не нужно!</i>";
    $headers = "From: AeaLS.kz <support@aea-ls.kz>\r\nContent-type: text/html; charset=utf-8 \r\n";
    $d = mail($to, $subject, $message, $headers);
    var_dump($d);
?>
