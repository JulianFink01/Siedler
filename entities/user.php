<?php


class User{

protected $id = NULL;
protected $username = "";
protected $password = "";
protected $email = "";

public function __construct($daten = array())
{
    // wenn $daten nicht leer ist, rufe die passenden Setter auf
    if ($daten) {
        foreach ($daten as $k => $v) {
            $setterName = 'set' . ucfirst($k);
            if (method_exists($this, $setterName)) {
                $this->$setterName($v);
            }

        }
    }
}
public function  __toString()
{
    return 'Id:'. $this->id .', Username: '.$this->username.', Password: '.$this->password.', Email: '.$this->email;
}
public function toArray($mitId = true)
{
    $attribute = get_object_vars($this);
    if ($mitId === false) {
        unset($attribute['id']);
    }
    return $attribute;
}

public function speichere()
{
    if ( $this->getId() > 0 ) {
        // wenn die ID eine Datenbank-ID ist, also größer 0, führe ein UPDATE durch
        $this->_update();
    } else {
        // ansonsten einen INSERT
        $this->_insert();
    }
}

public function setId($id){
   $this->id = $id;
}
public function getId(){
  return $this->id;
}
public function setUsername($username){
   $this->username = $username;
}
public function getUsername(){
  return $this->username;
}
public function setPassword($password){
   $this->password = MD5($password);
}
public function getPassword(){
  return $this->password;
}
public function setEmail($email){
   $this->email = $email;
}
public function getEmail(){
  return $this->email ;
}

public function loesche()
{
    $sql = 'DELETE FROM user WHERE id=?';
    $abfrage = DB::getDB()->prepare($sql);
    $abfrage->execute( array($this->getId()) );
    // Objekt existiert nicht mehr in der DB, also muss die ID zurückgesetzt werden
    $this->id = 0;
}

/* ***** Private Methoden ***** */

private function _insert()
{

    $sql = 'INSERT INTO user (username, password, email)'
         . 'VALUES (:username, :password, :email)';

    $abfrage = DB::getDB()->prepare($sql);
    $abfrage->execute($this->toArray(false));
    // setze die ID auf den von der DB generierten Wert
    $this->id = DB::getDB()->lastInsertId();
}

private function _update()
{
    $sql = 'UPDATE user SET username=:username, password=:password, email=:email'
        . 'WHERE id=:id';
    $abfrage = self::$db->prepare($sql);
    $abfrage->execute($this->toArray());
}
/* ***** Public Methoden ***** */
public static function findeAlle()
{
    $sql = 'SELECT * FROM user';
    $abfrage = DB::getDB()->query($sql);
    $abfrage->setFetchMode(PDO::FETCH_CLASS, 'User');
    return $abfrage->fetchAll();
}

public static function finde($id){
  $sql = 'SELECT * FROM user WHERE id=?';
  $abfrage = DB::getDB()->prepare($sql);
  $abfrage->execute(array($id));
  $abfrage->setFetchMode(PDO::FETCH_CLASS, 'User');
  return $abfrage->fetch();
}


public static function findeNachEmail($email)
{
    $sql = 'SELECT user.* FROM user '
         . 'WHERE email like ?';
         $abfrage = DB::getDB()->prepare($sql);
         $abfrage->execute(array($email));
         $abfrage->setFetchMode(PDO::FETCH_CLASS, 'User');
         return $abfrage->fetch();
}
public static function findeNachUsernameUndPassword($uname, $pass)
{
    $sql = 'SELECT user.* FROM user '
         . 'WHERE username like ? and password like ?';
         $abfrage = DB::getDB()->prepare($sql);
         $abfrage->execute(array($uname, $pass));
         $abfrage->setFetchMode(PDO::FETCH_CLASS, 'User');
         return $abfrage->fetch();
}

}


?>
