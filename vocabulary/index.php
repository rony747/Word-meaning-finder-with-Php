<?php
require "inc/vendor/autoload.php";

use PHPHtmlParser\Dom;


$userInput = $_POST['userInput'] ?? '';

$apiUrl = "https://www.vocabulary.com/dictionary/definition.ajax?search={$userInput}&lang=en&format=json";
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
$dom = new Dom;
$dom->loadStr($result);
$short = $dom->find('p.short');
$long = $dom->find('p.long');
$definition = $dom->find('div.word-definitions ol');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <title>Vocabulary App</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="main_container">
        <div class="main_wrapper">
            <div class="form_holder">
                <div class="form_wrapper">
                    <form action="" method="POST" id="main_form">
                        <input type="text" name="userInput" id="userInput" placeholder="Enter Your Word">
                        <input type="submit" value="Search" name="submit">
                    </form>
                </div>
            </div><!-- form_holder -->
            <?php

            if ($short != '') { ?>
                <div class="results_area">
                    <div class="result_wrap">

                        <div class="result_box">
                            <div class="wordName">
                                <h3><?php echo $userInput ?></h3>

                            </div>
                            <div class="short_desc">

                                <?php echo $short; ?></div>
                            <div class="long_desc">

                                <?php echo $long; ?></div>

                            <?php if ($definition != '') { ?>
                                <div class="definition">
                                    <div class="definition_title">
                                        <h4>Definitions of <?php echo $userInput ?></h4>
                                    </div>

                                    <div class="definition_wrap">
                                        <?php echo $definition; ?>
                                    </div>
                                </div><!-- definition -->
                            <?php }; ?>
                        </div>


                    </div>

                </div><!-- results_area -->
            <?php }
            ?>
        </div><!-- main_wrapper -->


    </div>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="assets/scripts.js"></script>
</body>

</html>