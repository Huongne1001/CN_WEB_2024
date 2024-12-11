<?php
include_once("db.php");

function uploadAccounts($file) {
    global $conn;
    
    try {
        $data = array_map('str_getcsv', file($file));
        array_shift($data);
        
        foreach ($data as $account) {
            $stmt = $conn->prepare("INSERT INTO accounts 
                (username, password, lastname, firstname, city, email, course) 
                VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", 
                $account[0], $account[1], $account[2], $account[3], 
                $account[4], $account[5], $account[6]);
            $stmt->execute();
        }
        return true;
    } catch (Exception $e) {
        error_log("Lỗi upload accounts: " . $e->getMessage());
        return false;
    }
}

function uploadQuestions($file) {
  global $conn;
  
  $content = file_get_contents($file);
  $questions = preg_split('/Câu hỏi:/', $content);
  array_shift($questions);
  
  foreach ($questions as $question) {
      if (preg_match('/(.+)\n(A\..+)\n(B\..+)\n(C\..+)\n(D\..+)\nĐáp án: (.+)/s', $question, $matches)) {
          $stmt = $conn->prepare("INSERT INTO questions 
              (question_text, option_a, option_b, option_c, option_d, correct_answer) 
              VALUES (?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("ssssss", 
              trim($matches[1]), 
              trim($matches[2]), 
              trim($matches[3]), 
              trim($matches[4]), 
              trim($matches[5]), 
              trim($matches[6]));
          $stmt->execute();
      }
  }
}

if (isset($_FILES['csvfile']) && $_FILES['csvfile']['error'] == UPLOAD_ERR_OK) {
    $tmpName = $_FILES['csvfile']['tmp_name'];
    if (uploadAccounts($tmpName)) {
        echo "Upload accounts thành công!";
    }
}

if (isset($_FILES['txtfile']) && $_FILES['txtfile']['error'] == UPLOAD_ERR_OK) {
    $tmpName = $_FILES['txtfile']['tmp_name'];
    if (uploadQuestions($tmpName)) {
        echo "Upload questions thành công!";
    }
}
?>