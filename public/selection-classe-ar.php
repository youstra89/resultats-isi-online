<?php
    require('connexion.inc.php');
    $lang = empty($_GET['lang']) ? 'fr' : $_GET['lang'];
    $city = $_GET['city'];
    if($city != 0 && $city != 1)
    echo "<script>document.location.replace('index-".$lang.".php');</script>";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>المركز بأبيدجان | نتائج الامتحان بالمركز الفترة الأولى 2018-2019</title>
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
                <a class="item" href="selection-classe-fr.php?lang=fr&city=<?php echo $city; ?>"><i class="globe icon"></i> Français</a>
                <a class="item" href="selection-classe-ar.php?lang=ar&city=<?php echo $city; ?>"><i class="globe icon"></i> العربية</a>
              </div>
            </div>
          </div>
        </div>
      </div>

        <br>
        <div class="ui container">
            <div class="ui red message" style="z-index: 1; position: fixed; display: none;" width="100%">
                <i class="close icon"></i>
                <strong>تحذير !!!</strong>
                <p>يجب ألا يكون الفصل فارغًا. يرجى اختيار الفصل قبل المتابعة.</p>
            </div>
        </div>
        <div class="ui container" style="position: relative; z-index: 0;">

            <div class="ui raised very padded text segment">
                <center>
                    <h2 class="ui center header" style="font-size: 4rem; color: teal">
                      مركز العلوم الإسلامية <br>
                      <?php echo $city == 0 ? 'أبيدجان' : 'أغبوفيل'; ?>
                    </h2>
                </center>
            </div>
            <div class="ui raised very padded text segment">
                <h2 class="ui center header">في أي فصل أنتم؟ ?</h2>
                <br>
                <?php
                    if(isset($_POST['sms']))
                    {
                        if(!empty($_POST['classe']))
                        {
                            //echo "<script>alert('".$_POST['classe']."');</script>";
                            echo "<script>document.location.replace('saisie-matricule.php?classe=".$_POST['classe']."');</script>";
                        }
                    }
                ?>
                <form class="ui form" method="post" action="" id="classe-form">
                    <h4 class="ui dividing header">حدد نظام التعليم، ثم المستوى، ثم الفصل</h4>
                    <div class="three fields">
                        <div class="field">
                            <label for="regime">مركز التدريب</label>
                            <select class="ui fluid dropdown" id="regime" name="regime" required>
                                <option value="">اختر نظامك التعليمي</option>
                                <option value="1">الأكاديمي</option>
                                <option value="2">التكوين</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="niveau">مستوى</label>
                            <select class="ui fluid dropdown" id="niveau" name="niveau" required>
                                <option value="">إختيار المستوى</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="classe">الفصل</label>
                            <select class="ui fluid dropdown" id="classe" name="classe">
                                <option value="">اختيار الفصل</option>
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <div class="field">
                        <button class="negative ui button" name="sms" id="sms-classe"><i class="send icon"></i> إرسال</button>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
