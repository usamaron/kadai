<?php

    //変数の初期化
    $name = $_POST['name'];
    $age = $_POST['age'];
    $department = $_POST['department'];
    $hobby = isset($_POST['hobby']) ? $_POST['hobby'] : [];
    $nameErorrCode = 0;
    $ageErorrCode = 0;
    $departmentErorrCode = 0;
    $hobbyErorrCode = 0;
    $success = false;

    //エラーチェック　1:未入力　2:文字種エラー
    if(isset($_POST['register'])){
        //名前チェック
        if (is_null($name) || $name === ""){
            $nameErorrCode = 1;
        }
        //年齢チェック
        if (is_null($age) || $age === ""){
            $ageErorrCode = 1;
        }elseif(!preg_match("/^[0-9]+$/", $age)){
            $ageErorrCode = 2;
        }
        //学部チェック
        if (is_null($department)){
            $departmentErorrCode = 1;
        }
        //趣味チェック
        if (empty($hobby)){
            $hobbyErorrCode = 1;
            $hobby = [];
        }

        //エラーなしの場合
        if($nameErorrCode === 0 && $ageErorrCode === 0 && $departmentErorrCode === 0 && $hobbyErorrCode === 0){
            $success = true;
            $name = "";
            $age = "";
            $department = "";
            $hobby = [];
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>二次課題フォーム</title>
</head>
<body>
    <p><?php echo $success ? "入力に成功しました。" : ""; ?></p>
    <form name="studentInfo" method="post" action="">
        <p>
            名前<br>
            <input type="text" name="name" value=<?php echo $name; ?>><br>
            <?php
                if (1 === $nameErorrCode){
                    echo "※名前を入力してください。";
                }
            ?>
        </p>
        <p>
            年齢<br><input type="text" name="age" value=<?php echo $age; ?>><br>
            <?php
                if (1 === $ageErorrCode){
                    echo "※年齢を入力してください。";
                }elseif(2 === $ageErorrCode){
                    echo "※年齢は半角数値で入力してください。";
                }
            ?>
        </p>
        <p>学部<br>
            <input type="radio" name="department" value="science" id="department-science" 
                <?php echo $department == "science" ? "checked" : "";?>
            ><label for="department-science">理学部 </label>

            <input type="radio" name="department" value="engineering" id="department-engineering" 
                <?php echo $department == "engineering" ? "checked" : "";?>
            ><label for="department-engineering">工学部 </label>
            <br>
            <?php
                if (1 === $departmentErorrCode){
                    echo "※学部を選択してください。";
                }
            ?>
        </p>
        <p>趣味<br>
            <input type="checkbox" name="hobby[]" value="touring" id="hobby-touring" 
                <?php echo in_array("touring", $hobby) ? "checked" : "";?>
            ><label for="hobby-touring">ツーリング </label>

            <input type="checkbox" name="hobby[]" value="driving" id="hobby-driving"
                <?php echo in_array("driving", $hobby) ? "checked" : "";?>
            ><label for="hobby-driving">ドライブ </label>

            <input type="checkbox" name="hobby[]" value="camping" id="hobby-camping"
                <?php echo in_array("camping", $hobby) ? "checked" : "";?>
            ><label for="hobby-camping">キャンプ </label>

            <input type="checkbox" name="hobby[]" value="snowboarding" id="hobby-snowboarding"
                <?php echo in_array("snowboarding", $hobby) ? "checked" : "";?>
            ><label for="hobby-snowboarding">スノーボード </label>
            <br>
            <?php
                if (1 === $hobbyErorrCode){
                    echo "※趣味を選択してください";
                }
            ?>
        </p>
        <input type="submit" name="register" value="登録"/>
    </form>
</body>
</html>
