<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  $user = NULL;
  if (!empty($_SESSION['board_username'])) {
    $username = $_SESSION['board_username'];
    $user = get_user_from_username($username);
  }

  if (!$user || $user['role_id'] !== 1) {
    header("Location: index.php?errCode=3");
    die(); // Access denied.
  }

  $stmt = $conn->prepare("SELECT * FROM keke_users JOIN keke_roles ON keke_users.role_id = keke_roles.role_id ORDER BY user_id ASC;");
  $result = $stmt->execute();
  if (!$result) {
    die('Error: ' . $conn->error);
  }
  $result = $stmt->get_result(); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Board</title>
  <link rel="stylesheet" href=".\normalize.css">
  <link rel="stylesheet" href=".\style.css">
</head>
<body class="admin-page">
  <haeder class="warning">
    注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。
  </haeder>
  <main class="user-board">
    <div>
      <a href="index.php" class="board__btn">Board</a>
      <a href="logout.php" class="board__btn">Logout</a>
    </div>
    <h1 class="board__title">Users</h1>
    <?php
      if (!empty($_GET['errCode'])) {
        $code = $_GET['errCode'];
        $errorMsg = "Error!";
        if ($code === '1') {
          $errorMsg = "you didn't select any options!";
        } else if ($code === '2') {
          $errorMsg = "unable to set admin from front end!";
        } else if ($code === '3') {
          $errorMsg = "invalid option";
        } else if ($code === '4') {
          $errorMsg = "database error. Please try again.";
        }
        echo '<span class="board__error">Error: ' . escape($errorMsg) . '</span>';
      }
    ?>
    <section class="users">
      <table class="users__table">
        <tr class="table__title">
          <th>USER_ID</th>
          <th>USERNAME</th>
          <th>NICKNAME</th>
          <th>ROLE_ID</th>
          <th>ROLE_NAME</th>
          <th>UPDATE ROLE</th>
        </tr>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr class="user">
          <td><?php echo escape($row['user_id']); ?></td>
          <td><?php echo escape($row['username']); ?></td>
          <td><?php echo escape($row['nickname']); ?></td>
          <td><?php echo escape($row['role_id']); ?></td>
          <td><?php echo escape($row['role_name']); ?></td>
          <td>
            <form class="user__role-form" method="POST" action="handle_edit_user-role.php"> 
              <div>
                <?php if ($row['role_id'] !== 1) { ?>
                  <label><input type="radio" name="role_id" value=2 />2</label>
                  <label><input type="radio" name="role_id" value=3 />3</label>
                  <input type="hidden" name="username" value="<?php echo escape($row['username']); ?>" />
                  <input class="user__btn" type="submit" value="Update" />
                <?php } ?>
              </div>
            </form>
          </td>
        </tr>
      <?php } ?>
      </table>
    </section>
  </main>

</body>
</html>