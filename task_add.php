<?php
require_once "auth.php";
require_once "db.php";

$user_id = $_SESSION["user_id"];
$msg = "";

// ดึงหมวดหมู่
$cats = $conn->query("SELECT id, name FROM categories ORDER BY name ASC");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $title = trim($_POST["title"]);
  $detail = trim($_POST["detail"]);
  $category_id = (int)$_POST["category_id"];

  if ($title === "") {
    $msg = "กรอกหัวข้องาน";
  } else {
    $stmt = $conn->prepare("INSERT INTO tasks(user_id, category_id, title, detail) VALUES (?,?,?,?)");
    $stmt->bind_param("iiss", $user_id, $category_id, $title, $detail);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit();
  }
}
?>
<?php $pageTitle="Add Task"; include "header.php"; ?>

<div class="row justify-content-center">
  <div class="col-md-7 col-lg-6">
    <div class="card p-4">
      <h3 class="mb-2">เพิ่มงาน</h3>

      <?php if (!empty($msg)): ?>
        <div class="alert alert-danger py-2"><?= htmlspecialchars($msg) ?></div>
      <?php endif; ?>

      <form method="post">
        <div class="mb-2">
          <label class="form-label">หัวข้อ</label>
          <input name="title" class="form-control" required>
        </div>
        <div class="mb-2">
          <label class="form-label">รายละเอียด</label>
          <textarea name="detail" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-2">
          <label class="form-label">หมวดหมู่</label>
          <select name="category_id" class="form-select">
            <?php while($c = $cats->fetch_assoc()): ?>
              <option value="<?= $c["id"] ?>"><?= htmlspecialchars($c["name"]) ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <button class="btn btn-success w-100 mt-2">บันทึก</button>
        <a class="btn btn-outline-secondary w-100 mt-2" href="index.php">กลับ</a>
      </form>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>
</html>