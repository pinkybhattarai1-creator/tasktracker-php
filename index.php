<?php
require_once "auth.php";
require_once "db.php";

$user_id = $_SESSION["user_id"];

$sql = "
SELECT t.id, t.title, t.status, c.name AS category_name, t.created_at
FROM tasks t
JOIN categories c ON t.category_id = c.id
WHERE t.user_id=?
ORDER BY t.id DESC
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$tasks = $stmt->get_result();
?>
<?php $pageTitle="My Tasks"; include "header.php"; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h3 class="mb-0">My Work</h3>
   
  </div>
  <a class="btn btn-primary" href="task_add.php">+ เพิ่มงาน</a>
</div>

<div class="card p-3">
  <table class="table table-bordered mb-0">
    <thead>
      <tr>
        <th>หัวข้อ</th>
        <th>หมวด</th>
        <th>สถานะ</th>
        <th>วันที่</th>
        <th width="180">จัดการ</th>
      </tr>
    </thead>
    <tbody>
    <?php while($row = $tasks->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row["title"]) ?></td>
        <td><?= htmlspecialchars($row["category_name"]) ?></td>
        <td>
          <?php if ($row["status"] === "done"): ?>
            <span class="badge-soft badge-done">done</span>
          <?php else: ?>
            <span class="badge-soft badge-todo">todo</span>
          <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($row["created_at"]) ?></td>
        <td>
          <a class="btn btn-warning btn-sm" href="task_edit.php?id=<?= $row["id"] ?>">แก้ไข</a>
          <a class="btn btn-danger btn-sm" href="task_delete.php?id=<?= $row["id"] ?>"
             onclick="return confirm('ลบงานนี้ใช่ไหม?')">ลบ</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div>

<?php include "footer.php"; ?>
</html>
