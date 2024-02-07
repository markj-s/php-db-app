<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try  {
    $connection = new PDO($dsn, $username, $password, $options);
    
    $new_user = array(
      "firstname" => $_POST['firstname'],
      "lastname"  => $_POST['lastname'],
      "email"     => $_POST['email'],
      "age"       => $_POST['age'],
      "location"  => $_POST['location']
    );

    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "users",
      implode(", ", array_keys($new_user)),
      ":" . implode(", :", array_keys($new_user))
    );
    
    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

  <?php if (isset($_POST['submit']) && $statement) : ?>

    <div class="container mt-3">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo escape($_POST['firstname']); ?> has been successfully added.  
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
      </div>
    </div>

  <?php endif; ?>

  <div class="container mt-5">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <h2>Add new user</h2>

      <div class="border p-3 rounded shadow mt-3">
        <form method="post" class="needs-validation mb-3" novalidate>
          <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">

          <div class="mb-3">
            <label for="firstname" class="form-label">First Name</label>  
            <input type="text" name="firstname" id="firstname" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="lastname" class="form-label">Last Name</label>    
            <input type="text" name="lastname" id="lastname" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>    
            <input type="text" name="email" id="email" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label for="age" class="form-label">Age</label>    
            <input type="text" name="age" id="age" class="form-control" required>
          </div>
          
          <div class="mb-3">
            <label for="location" class="form-label">Location</label>    
            <input type="text" name="location" id="location" class="form-control" required>
          </div>

          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
        
        
      </div>
      <a href="index.php" class="btn btn-light mt-3 d-inline-block">Return Home</a>
    </div>
  </div>  
</div>

<?php require "templates/footer.php"; ?>