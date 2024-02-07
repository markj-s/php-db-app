<?php

/**
 * List all users with a link to edit
 */

require "../config.php";
require "../common.php";

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

      <h2>Update users</h2>
      <div class="table-responsive">
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
              <th scope="col">Edit</th>
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
                  <td><a href="update-single.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm text-center w-100">Edit</a></td>
              </tr>
          <?php endforeach; ?>

          </tbody>
        </table>
      </div>
      <a href="index.php" class="btn btn-light">Return Home</a>

    </div>
  </div>
</div>

<?php require "templates/footer.php"; ?>