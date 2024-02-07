<?php

/**
 * Function to query information based on 
 * a parameter: in this case, location.
 *
 */

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  try  {
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * 
            FROM users
            WHERE location = :location";

    $location = $_POST['location'];
    $statement = $connection->prepare($sql);
    $statement->bindParam(':location', $location, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit'])) { ?>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-8 offset-md-2">

      <?php if ($result && $statement->rowCount() > 0) : ?>

        <h2>Results</h2>

        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Email</th>
              <th scope="col">Age</th>
              <th scope="col">Location</th>
              <th scope="col">Date</th>
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
            </tr>
          <?php endforeach; ?>

          </tbody>
        </table>

      <?php else: ?>

        <div class="alert alert-danger" role="alert">
          No results found for <?php echo $_POST['location']; ?>.
        </div>

      <?php endif; ?>

    </div>
  </div>
</div>

<?php } ?>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-6 offset-md-3">

      <h2>Find user based on location</h2>

      <div class="border p-3 rounded">
        <form method="post" class="mb-3" >
          <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
          
          <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" id="location" name="location" class="form-control">
          </div>

          <button type="submit" name="submit" class="btn btn-primary">
            View Results
          </button>
          
        </form>
        
      </div>
      <a href="index.php" class="btn btn-light mt-3">Return Home</a>
    </div>
  </div>
</div>



<?php require "templates/footer.php"; ?>