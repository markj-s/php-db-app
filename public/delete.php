<?php

/**
 * Delete a user
 */

require "../config.php";
require "../common.php";

$success = null;

if (isset($_POST["submit"])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try {
    $connection = new PDO($dsn, $username, $password, $options);
  
    $id = $_POST["submit"];

    $sql = "DELETE FROM users WHERE id = :id";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $success = "User was successfully deleted";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM users";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>
        
<div class="container mt-5">
  <div class="row">
    <div class="col-md-10 offset-md-1">

      <h2>Delete users</h2>

      <?php if ($success) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= $success ?> 
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <form method="post">
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Location</th>  
                <th>Date</th>
                <th>Delete</th>
              </tr>
            </thead>
            
            <tbody>

            <?php foreach ($result as $row) : ?>
              <tr>
                <td><?php echo escape($row["id"]); ?></td>
                <td><?php echo escape($row["firstname"]); ?></td>
                <td><?php echo escape($row["lastname"]); ?></td>
                <td><?php echo escape($row["email"]); ?></td>
                <td><?php echo escape($row["age"]); ?></td>
                <td><?php echo escape($row["location"]); ?></td>
                <td><?php echo escape($row["date"]); ?> </td>
                <td><button class="btn btn-danger btn-sm w-100" type="submit" name="submit" value="<?php echo escape($row["id"]); ?>">Delete</button></td>
              </tr>
            <?php endforeach; ?>

            </tbody>
          </table>
          </div>
      </form>
      
      <a href="index.php" class="btn btn-light">Return Home</a>

    </div>
  </div>  
</div>

<?php require "templates/footer.php"; ?>