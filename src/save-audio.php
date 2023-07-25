<?php
    $input = $_FILES['audio_data']['tmp_name'];
    $output = $_FILES['audio_data']['name'].".mp3";

    move_uploaded_file($input, "../uploads/complaint-recordings/".$output);