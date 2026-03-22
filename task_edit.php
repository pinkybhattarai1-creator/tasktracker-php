<?php
require_once "auth.php";
require_once "db.php";

$user_id = $_SESSION["user_id"];
$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

// โหลดข้อมูลงานของ user เท่านั้น
$stmt = $conn->prepare("SELECT * FROM tasks WHERE id=? AND user_id=?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$task = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$task) {
  die("ไม่พบงานนี้");
}

$cats = $conn->query("SELECT id, name FROM categories ORDER BY name ASC");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $title = trim($_POST["title"]);
  $detail = trim($_POST["detail"]);
  $status = $_POST["status"];
  $category_id = (int)$_POST["category_id"];

  $stmt = $conn->prepare("UPDATE tasks SET title=?, detail=?, status=?, category_id=? WHERE id=? AND user_id=?");
  $stmt->bind_param("sssiii", $title, $detail, $status, $category_id, $id, $user_id);
  $stmt->execute();
  $stmt->close();

  header("Location: index.php");
  exit();
}
?>
<?php $pageTitle="Edit Task"; include "header.php"; ?>

<div class="row justify-content-center">
  <div class="col-md-7 col-lg-6">
    <div class="card p-4">
      <h3 class="mb-2">แก้ไขงาน</h3>

      <form method="post">
        <div class="mb-2">
          <label class="form-label">หัวข้อ</label>
          <input name="title" class="form-control" value="<?= htmlspecialchars($task["title"]) ?>" required>
        </div>

        <div class="mb-2">
          <label class="form-label">รายละเอียด</label>
          <textarea name="detail" class="form-control" rows="3"><?= htmlspecialchars($task["detail"]) ?></textarea>
        </div>

        <div class="mb-2">
          <label class="form-label">หมวดหมู่</label>
          <select name="category_id" class="form-select">
            <?php while($c = $cats->fetch_assoc()): ?>
              <option value="<?= $c["id"] ?>" <?= ($c["id"] == $task["category_id"]) ? "selected" : "" ?>>
                <?= htmlspecialchars($c["name"]) ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="mb-2">
          <label class="form-label">สถานะ</label>
          <select name="status" class="form-select">
            <option value="todo" <?= ($task["status"]==="todo")?"selected":"" ?>>todo</option>
            <option value="done" <?= ($task["status"]==="done")?"selected":"" ?>>done</option>
          </select>
        </div>

        <button class="btn btn-warning w-100 mt-2">บันทึก</button>
        <a class="btn btn-outline-secondary w-100 mt-2" href="/task_app/index.php">กลับ</a>
      </form>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>
