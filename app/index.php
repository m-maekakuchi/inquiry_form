<?php
  session_start();

  require_once('utilities/Validation.php');
  require_once('utilities/Message.php');
  require_once('utilities/Db.php');
  require_once('utilities/functions.php');

  try {
    $btn = "";

    if (array_key_exists('btn', $_POST)) {
      $btn = $_POST['btn'];
    } else if (array_key_exists('btn', $_GET)) {
      $btn = $_GET['btn'];
    }

    //正しいパラメータ名で受け取れなかった場合はお問い合わせフォームにリダイレクト
    if (!empty($btn)) {
      if ($btn === "toConfirm") {
        if (
          !isset($_POST['name'])
          ||
          !isset($_POST['kana'])
          || 
          !isset($_POST['tel'])
          ||
          !isset($_POST['gender'])
          ||
          !isset($_POST['email'])
          ||
          !isset($_POST['confirmEmail'])
          ||
          !isset($_POST['content'])
        ) {
          header('Location: contact.php');
          exit();
        }
        
        //入力データのエスケープ
        $name         = escape($_POST['name']);
        $kana         = escape($_POST['kana']);
        $tel          = escape($_POST['tel']);
        $email        = escape($_POST['email']);
        $confirmEmail = escape($_POST['confirmEmail']);
        $content      = escape($_POST['content']);
        $gender       = $_POST['gender'];

        //入力データのバリデーション
        $val = new Validation();
        $errorMsg = $val->validateForms($name, $kana, $tel, $gender, $email, $confirmEmail, $content);

        $inputData['name']          = (!isset($errorMsg['name'])) ? $name : "";
        $inputData['kana']          = (!isset($errorMsg['kana'])) ? $kana : "";
        $inputData['tel']           = (!isset($errorMsg['tel'])) ? $tel : "";
        $inputData['email']         = (!isset($errorMsg['email'])) ? $email : "";
        $inputData['confirmEmail']  = (!isset($errorMsg['confirmEmail'])) ? $confirmEmail : "";
        $inputData['content']       = (!isset($errorMsg['content'])) ? $content : "";
        if (!isset($errorMsg['gender'])) $inputData['gender'] = $gender;

        $_SESSION['inputData'] = $inputData;
        $_SESSION['errorMsg'] = $errorMsg;

        if (count($errorMsg) === 0) {
          //選択されたラジオボタンによって、確認画面で表示する文字を変数に代入
          if ($inputData['gender'] === '1') {
            $_SESSION['confirmGender'] = '男性';
          } else {
            $_SESSION['confirmGender'] = '女性';
          }
          //改行コードを変換した文字列を変数に代入
          $_SESSION['confirmContent'] = str_replace("\n", "<br>", $inputData['content']);

          header('Location: confirm.php');
          exit();
        } else {
          header('Location: contact.php');
          exit();
        }
      } else if ($btn === "toComplete") {
        //POSTされたトークンを取得
        $postToken = isset($_POST['token']) ? $_POST["token"] : "";
        //セッション変数のトークンを取得
        $sessionToken = isset($_SESSION['token']) ? $_SESSION['token'] : "";
        //セッション変数のトークンを削除
        unset($_SESSION['token']);

        $inputData = $_SESSION['inputData'];
        if($postToken !== "" && $postToken === $sessionToken) {
          $db = new Db();
          $insertRow = $db->insertInputData($inputData);
        }

        header('Location: complete.php');
        exit();
      } else if ($btn === "back") {
        $_SESSION = array();
        session_destroy();

        header('Location: contact.php');
        exit();
      }
    } else {
      header('Location: contact.php');
      exit();
    }
  } catch (PDOException $e) {
    die ("データベースエラー:{$e->getMessage()}");
  } catch (Exception $e) {
    echo "例外発生", $e->getMessage();
  }
?>