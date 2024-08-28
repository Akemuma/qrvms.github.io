 <?php
  @session_start();
  if (!isset($_SESSION['host'])) {
    echo "<script>alert('You are not logged in!'); window.location='../';</script>";
    exit;
  }

  if (($_SESSION['category']) != 'host' && $_SESSION['category'] != 'super') {
    echo "<script>alert('You are not logged in!'); window.location='../';</script>";
    exit;
  }
  $user_id = $_SESSION['host'];
  if (!isset($conn)) require '../conn.php';

  ?>