<?php
  session_start();
  require_once('conn.php');
  
  if (
    empty($_POST['username']) ||
    empty($_POST['password']) 
  ) {
    die();
  }

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "select * from MySQL where username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }

  $result = $stmt->get_result();

  if ($result->num_rows === 0) {
    exit();
  }
  
  $row = $result->fetch_assoc();
  if (password_verify($password, $row['password'])) {
    $_SESSION['username'] = $username;
    header("Location: index.php");    
  } else {
    die();
  }

?>