<?php
session_start();
require_once "db.php";

$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = trim($_POST["email"]);
  $password = $_POST["password"];

  $stmt = $conn->prepare("SELECT id, fullname, password_hash FROM users WHERE email=?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row["password_hash"])) {
      $_SESSION["user_id"] = $row["id"];
      $_SESSION["fullname"] = $row["fullname"];
      header("Location: index.php");
      exit();
    }
  }
  $msg = "อีเมลหรือรหัสผ่านไม่ถูกต้อง";
  $stmt->close();
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Login</title>
</head>

</html><?php $pageTitle="Login"; include "header.php"; ?>
<div class="row g-4 align-items-stretch">
  <div class="col-md-6">
    <div class="hero h-100">
      <img src="assets/img/logo.png" class="w-100 h-100" style="object-fit:cover" alt="banner">
    </div>
  </div>

  <div class="col-md-6">
    <div class="card p-4 h-100">
      <h3 class="mb-1">เข้าสู่ระบบ</h3>
      <div class="text-muted mb-3">จัดการงานของคุณแบบง่ายๆ</div>

      <?php if (!empty($msg)): ?>
        <div class="alert alert-danger py-2"><?= htmlspecialchars($msg) ?></div>
      <?php endif; ?>

      <form method="post">
        <div class="mb-2">
          <label class="form-label">Email</label>
          <input name="email" type="email" class="form-control" required>
        </div>
        <div class="mb-2">
          <label class="form-label">Password</label>
          <input name="password" type="password" class="form-control" required>
        </div>
        <button class="btn btn-success w-100 mt-2">Login</button>
        <a class="btn btn-link w-100" href="register.php">ยังไม่มีบัญชี? สมัครสมาชิก</a>
      </form>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>

