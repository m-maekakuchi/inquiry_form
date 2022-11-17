<?php

require_once('Conf.php');

class ContactModel {
  /**
   * PDOオブジェクト
   *
   * @var PDO
  */
  private $name;
  private $kana;
  private $tel;
  private $gender;
  private $email;
  private $confirmEmail;
  private $content;

  /**
   * 
  */
  function __construct($name,
    $kana,
    $tel,
    $gender,
    $email,
    $confirmEmail,
    $content,) {
    $this->$name = name;
    $this->$kana = kana;
    $this->$tel = tel;
    $this->$gender = gender;
    $this->$email = email;
    $this->$confirmEmail = confirmEmail;
    $this->$content = content;
  }

  /**
   * データベースとの通信を切断するメソッド
   *
   * @return void
  */
  public function setName() {
    $this->db = null;
  }

  public function getName() {
    $this->db = null;
  }

  /**
   * inquiry表に入力データを登録するメソッド
   *
   * @param array $data 入力されたデータ
   *
   * @return int 登録されたレコード数
  */
  public function insertInputData($data) {
    $sql = "INSERT INTO contact(name, kana, tel, gender, email, confirmEmail, content)
            VALUES(?, ?, ?, ?, ?, ?, ?);";
    $stt = $this->db->prepare($sql);
    $stt->bindValue(1, $data['name']);
		$stt->bindValue(2, $data['kana']);
		$stt->bindValue(3, $data['tel']);
		$stt->bindValue(4, $data['gender']);
		$stt->bindValue(5, $data['email']);
		$stt->bindValue(6, $data['confirmEmail']);
		$stt->bindValue(7, $data['content']);
    $stt->execute();
    return $stt->rowCount();
  }
}