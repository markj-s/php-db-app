<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
	<title>Simple Database App</title>

	<link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="bg-dark text-secondary px-4 py-5 text-center">
    <div class="py-5">
        <h1 class="display-5 fw-bold text-white">Simple Database App</h1>
        <div class="col-lg-6 mx-auto">
            <p class="fs-5 mb-4">Just a simple CRUD app using PHP, MySQL and styled using Bootstrap 5</p>
            <p class="fs-5 mb-4">Click on the <span class="text-info fw-bold">Create user</span> button to add your first user.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="create.php" class="text-decoration-none">
                    <button type="button" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold">Create user</button>
                </a>
                <a href="read.php" class="text-decoration-none">
                    <button type="button" class="btn btn-outline-light btn-lg px-4 me-sm-3 fw-bold">Search user</button>
                </a>
                <a href="update.php" class="text-decoration-none">
                    <button type="button" class="btn btn-outline-warning btn-lg px-4 me-sm-3 fw-bold">Update user</button>
                </a>
                <a href="delete.php" class="text-decoration-none">
                    <button type="button" class="btn btn-outline-danger btn-lg px-4 fw-bold">Delete user</button>
                </a>
            </div>
        </div>
    </div>
</div>