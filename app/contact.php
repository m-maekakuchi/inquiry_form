<?php
  if (isset($_SESSION['inputData'])) {
    $inputData = $_SESSION['inputData'];
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お問い合わせ</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container">
    <form action="index.php" method="post">
      <div class="form-items item-pair">
        <div class="item">
          <label class="label-item">名前<span class="label-required">*</span></label>
          <input
            type="text"
            name="name"
            id="name"
            size="30"
            
            value="<?php echo isset($inputData['name']) ? $inputData['name'] : ""; ?>"
          />
        </div>
        <div class="item">
          <label class="label-item">フリガナ<span class="label-required">*</span></label>
          <input
            type="text"
            name="kana"
            id="kana"
            size="30"
            value="<?php echo isset($inputData['kana']) ? $inputData['kana'] : ""; ?>"
          />
        </div>
      </div>
      <div class="form-items item">
        <label class="label-item">電話番号<span class="label-required">*</span></label>
        <input 
          type="text"
          name="tel"
          id="tel"
          size="30"
          placeholder="000-0000-0000"
          value="<?php echo isset($inputData['tel']) ? $inputData['tel'] : ""; ?>"
        />
      </div>
      <div class="form-items item">
        <label class="label-item">性別<span class="label-required">*</span></label>
        <input
          type="radio"
          name="gender"
          value="1"
          id="man"
          <?php echo (isset($inputData['gender']) && $inputData['gender'] == 1) ? "checked" : "" ?>
        >
        <span class="gender">男性</span>
        <input
          type="radio"
          name="gender"
          value="2"
          id="woman"
          <?php echo (isset($inputData['gender']) && $inputData['gender'] == 2) ? "checked" : "" ?>
        >
        女性
      </div>
      <div class="form-items item-pair">
        <div class="item">
          <label class="label-item">メールアドレス<span class="label-required">*</span></label>
          <input
            type="text"
            name="email"
            id="email"
            size="50"
            placeholder="example@gmail.com"
            value="<?php echo isset($inputData['email']) ? $inputData['email'] : ""; ?>"
          />
        </div>
        <div class="item">
          <label class="label-item">メールアドレス確認用<span class="label-required">*</span></label>
          <input
            type="text"
            name="confirmEmail"
            id="confirmEmail"
            size="50"
            placeholder="example@gmail.com"
            value="<?php echo isset($inputData['confirmEmail']) ? $inputData['confirmEmail'] : ""; ?>"
          />
        </div>
      </div>
      <div class="form-items item">
        <label class="label-item">お問い合わせ<span class="label-required">*</span></label>
        <textarea name="content" id="content" cols="50" rows="10"><?php echo isset($inputData['content']) ? $inputData['content'] : ""; ?></textarea>
      </div>
      <div class="btn-wrapper">
        <button type="submit" class="btn">入力確認</button>
        <input type="hidden" name="btn" value="toConfirm">
      </div>
    </form>
  </div>
</body>
</html>