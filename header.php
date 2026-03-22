<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="/task_app/assets/css/style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : "Task App" ?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white border-bottom">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
      <img src="assets/img/banner.jpg" width="34" height="34" style="border-radius:10px" alt="logo">
      <b>Task Tracker</b>
    </a>

    <div class="ms-auto">
      <?php if (isset($_SESSION["user_id"])): ?>
        <span class="me-2">👋 <?= htmlspecialchars($_SESSION["fullname"]) ?></span>
        <a class="btn btn-outline-secondary btn-sm" href="logout.php">Logout</a>
      <?php else: ?>
        <a class="btn btn-outline-primary btn-sm" href="login.php">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
<div class="container py-4">
