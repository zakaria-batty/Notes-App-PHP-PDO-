<?php

class Database
{
  private $db;

  public function __construct()
  {
    $this->db = new PDO(DSN, USERNAME, PASSWORD);
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  public function add($data)
  {
    $name = $data['name'];
    $description = $data['description'];

    try {
      $query = 'INSERT INTO notes (name,description,created_at) 
                   VALUES (:name,:description,now())';
      $statement = $this->db->prepare($query);
      $statement->execute(array(":name" => $name, ":description" => $description));

      if ($statement) :
        echo 'notes ajoutée';
      endif;
    } catch (PDOException $ex) {
      echo 'erreur ' . $ex->getMessage();
    }
  }

  public function update($data)
  {
    $name = $data['name'];
    $description = $data['description'];
    $id = $data['id'];

    try {
      $query = 'UPDATE notes SET name=:name,description=:description WHERE id=:id';
      $statement = $this->db->prepare($query);
      $statement->execute(array(
        ":name" => $name,
        ":description" => $description,
        ":id" => $id
      ));

      if ($statement) :
        echo 'notes modifié';
      endif;
    } catch (PDOException $ex) {
      echo 'erreur ' . $ex->getMessage();
    }
  }
  public function delete($data)
  {

    $id = $data['id'];

    try {
      $query = 'DELETE FROM notes  WHERE id=:id';
      $statement = $this->db->prepare($query);
      $statement->execute(array(":id" => $id));

      if ($statement) :
        echo 'notes suprimé';
      endif;
    } catch (PDOException $ex) {
      echo 'erreur ' . $ex->getMessage();
    }
  }
  public function getNotes()
  {
    try {
      $query = 'SELECT * FROM notes';
      $statement = $this->db->prepare($query);

      while ($note = $statement->fetch(PDO::FETCH_OBJ)) {
        $output = "
           <tr>
                <td>
                  $note->name
                </td>
                <td>
                  $note->description
                </td>
                <td>
                  $note->created_at
                </td>
           </tr>
        ";
        echo $output;
      }
    } catch (PDOException $ex) {
      echo 'erreur ' . $ex->getMessage();
    }
  }
  public function getNote($data)
  {

    $id = $data['id'];

    try {
      $query = 'SELECT * FROM notes WHERE id=:id';
      $statement = $this->db->prepare($query);
      $statement->execute(array(":id" => $id));
      $note = $statement->fetch(PDO::FETCH_OBJ);
      var_dump($note);
    } catch (PDOException $ex) {
      echo 'erreur ' . $ex->getMessage();
    }
  }
}
