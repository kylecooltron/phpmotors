
  <?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';

  $firstname = 'Karl';
  $lastname = 'Coolon';
  $email = 'Kcool@gmail.com';
  $my_password = 'Smartpass123';
  $comment = 'Kaaaaaarrrrrll!';

  $data = [
    'firstname' => $firstname,
    'lastname' => $lastname,
    'email' => $email,
    'my_password' => $my_password,
    'comment' => $comment
  ];

  $sql = "INSERT INTO clients (
      clientFirstname,
      clientLastname,
      clientEmail,
      clientPassword,
      comment
    ) VALUES (:firstname, :lastname, :email, :my_password, :comment)";

  $stmt = $link->prepare($sql);
  $stmt->execute($data);
  ?>
