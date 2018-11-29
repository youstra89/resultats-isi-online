<?php
  $lang = empty($_GET['lang']) ? 'fr' : $_GET['lang'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Vous pouvez désormais voir vos résultats d'examen en ligne sur le site de l'Institut des Sciences Islamiques">
        <title>نتائج الامتحان بالمركز الفترة الأولى 2018-2019</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css">
    </head>
    <body>
        <div class="ui attached large stackable menu">
          <div class="ui container">
            <a class="item" href="index-<?php echo $lang; ?>.php">
              <i class="home icon"></i> الاستقبال
            </a>
            <a class="item" href="selection-classe-<?php echo $lang; ?>.php?lang=<?php echo $lang; ?>&city=0">
              <i class="grid layout icon"></i> أبيدجان
            </a>
            <a class="item" href="selection-classe-<?php echo $lang; ?>.php?lang=<?php echo $lang; ?>&city=1">
              <i class="grid layout icon"></i> أغبوفيل
            </a>

            <div class="right item">
              <div class="ui simple dropdown item">
              تغيير اللغة
                <i class="dropdown icon"></i>
                <div class="menu">
                  <a class="item" href="index-fr.php"><i class="globe icon"></i> Français</a>
                  <a class="item" href="index-ar.php"><i class="globe icon"></i> العربية</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <br>
        <div class="ui container">
            <div class="ui raised very padded text segment center">
              <h2 class="ui header">نتائج امتحان الفترة الأولى للعام الدراسي: 2018-2019 في مركز العلوم الإسلامية</h2>
              <p>إذا كنت طالبا بالمركز في أبيدجان ، يرجى النقر على "أبيدجان" في القائمة الرئيسية</p>
              <p>وإلاّ، إذا كنت في أغبوفيل، انقر على أغبوفيل في القائمة الرئيسية.</p>
            </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js"></script>
    </body>
</html>
<?php

?>
