<?php
session_start();
require_once "db.php";

$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $fullname = trim($_POST["fullname"]);
  $email = trim($_POST["email"]);
  $password = $_POST["password"];

  if ($fullname === "" || $email === "" || $password === "") {
    $msg = "กรอกข้อมูลให้ครบ";
  } else {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users(fullname,email,password_hash) VALUES (?,?,?)");
    $stmt->bind_param("sss", $fullname, $email, $hash);

    if ($stmt->execute()) {
      $msg = "สมัครสมาชิกสำเร็จ! ไปล็อกอินได้เลย";
    } else {
      $msg = "อีเมลนี้ถูกใช้แล้ว หรือมีข้อผิดพลาด";
    }
    $stmt->close();
  }
}
?>
<?php $pageTitle="Register"; include "header.php"; ?>

<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="card p-4">
      <h3 class="mb-1">สมัครสมาชิก</h3>
      <div class="text-muted mb-3">เริ่มใช้งานระบบจัดการงานแบบง่ายๆ</div>

      <?php if (!empty($msg)): ?>
        <div class="alert alert-danger py-2"><?= htmlspecialchars($msg) ?></div>
      <?php endif; ?>

      <form method="post">
        <div class="mb-2">
          <label class="form-label">ชื่อ-นามสกุล</label>
          <input name="fullname" class="form-control" required>
        </div>
        <div class="mb-2">
          <label class="form-label">Email</label>
          <input name="email" type="email" class="form-control" required>
        </div>
        <div class="mb-2">
          <label class="form-label">Password</label>
          <input name="password" type="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100 mt-2">สมัครสมาชิก</button>
        <a class="btn btn-link w-100" href="login.php">มีบัญชีแล้ว? ไปหน้า Login</a>
      </form>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>

</html>
