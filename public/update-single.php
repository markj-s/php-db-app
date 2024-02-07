<?php

/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $user =[
      "id"        => $_POST['id'],
      "firstname" => $_POST['firstname'],
      "lastname"  => $_POST['lastname'],
      "email"     => $_POST['email'],
      "age"       => $_POST['age'],
      "location"  => $_POST['location'],
      "date"      => $_POST['date']
    ];

    $sql = "UPDATE users 
            SET id = :id, 
              firstname = :firstname, 
              lastname = :lastname, 
              email = :email, 
              age = :age, 
              location = :location, 
              date = :date 
            WHERE id = :id";
  
  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
  
if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();
    
    $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>

  <div class="container mt-3">
  <div class="row">
    <div class="col-md-6 offset-md-3">
    
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo escape($_POST['firstname']); ?> successfully updated. 
        
        <div class="mt-3">
          <a href="update.php" class="btn btn-primary">
            Return to edit all users
          </a>
        </div>
        
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      
    </div>
  </div>
</div>

<?php endif; ?>

<div class="container mt-5">
  <div class="row">  
    <div class="col-md-6 offset-md-3">

      <h2>Edit user</h2>

      <div class="border p-3 rounded shadow"> 
        <form class="mb-3" method="post">

          <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
          
          <?php foreach ($user as $key => $value) : ?>

            <div class="mb-3">
              <?php
                $names = [
                  'id' => 'ID #',
                  'firstname' => 'First Name',
                  'lastname' => 'Last Name',
                  'email' => 'Email',
                  'age' => 'Age',
                  'location' => 'Location',
                  'date' => 'Date',
                ];
              ?>
              <label>
                <?= $names[$key] ?> 
              </label>

              <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" class="form-control" <?php echo (in_array($key, ['id', 'date']) ? 'readonly' : null); ?>>
            </div>

          <?php endforeach; ?>

          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          
        </form>
        
      </div>
      <a href="index.php" class="btn btn-light mt-3">Return Home</a>
    </div>
  </div>
</div>

<?php require "templates/footer.php"; ?>