<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Profile</title>
<link rel="stylesheet" href="style.css">

<script src="https://kit.fontawesome.com/cb516eddc9.js" crossorigin="anonymous"></script>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background: url(cake-images/love\ cupcakes.webp);
  }

  .container {
    max-width: 600px;
    margin: 50px auto;
    background-color: #fff;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #ee19b9;
    font-size: 23px;
  }

  .profile-info {
    margin-bottom: 20px;
    font-size: 20px;
    color: blue;
  }
  .profile-info i{
    color: #ee19b9;
    cursor: pointer;
    
  }
  .profile-info label {
    font-weight: bold;
  }

  .profile-info p {
    margin: 5px 0;
  }

  

  .edit-form {
    display: none; 
  }

  .edit-form .profile-info {
    margin-bottom: 15px;
  }

  .edit-form input[type="text"],
  .edit-form input[type="email"] {
    width: calc(100% - 20px);
    padding: 10px;
    border: 1px solid palevioletred;
    border-radius: 17px;
    box-sizing: border-box;
  }

.btn{
  justify-content: center;
  margin-left: 20%;
  width: 50%;
}
</style>
</head>
<body>

<div class="container">
    
  <h1>Your Profile</h1>
  <?php
  // Start the session
  session_start();
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
    require 'connection.php';

    // Retrieve user ID from session
    $user_id = $_SESSION["user_id"];

    // Retrieve form data
    $newName = $_POST['newName'];
    $newEmail = $_POST['newEmail'];
    $newAddress = $_POST['newAddress'];
    $newTelephone = $_POST['newTelephone'];

    // Update user details in the database
    $sql_update = $conn->prepare("UPDATE register SET user_name=?, email=?, address=?, contact=? WHERE user_id=?");
    $sql_update->bind_param("ssssi", $newName, $newEmail, $newAddress, $newTelephone, $user_id);

    if ($sql_update->execute() === TRUE) {
        echo '<script>alert("Details updated successfully");</script>';
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $sql_update->close();
    $conn->close();
  }
  ?>

  <?php
    require 'connection.php';

    // Retrieve user ID from session
    $user_id = $_SESSION["user_id"];

    // SQL query to fetch user details using user ID from session
    $sql = "SELECT * FROM register WHERE user_id = $user_id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Output data of the user
      $row = $result->fetch_assoc();
      echo "<div class='profile-info'>
              <i class='fa-solid fa-user'></i>
              <p><label for='name'>User Name :    </label>" . $row["user_name"] . "</p>
            </div>
            <div class='profile-info'>
              <i class='fa-solid fa-envelope'></i>
              <p><label for='email'>Email :    </label>" . $row["email"] . "</p>
            </div>
            <div class='profile-info'>
              <i class='fa-solid fa-location-dot'></i>
              <p><label for='address'>Address :   </label>" . $row["address"] . "</p>
            </div>
            <div class='profile-info'>
              <i class='fa-solid fa-phone'></i>
              <p><label for='telephone'>Telephone :   </label>" . $row["contact"] . "</p>
            </div>";
    } else {
      echo "User not found";
    }
    $conn->close();
  ?>

  <button class="btn" onclick="showEditForm()">Edit Details</button>

  <!-- Edit form initially hidden -->
  <form id="editForm" class="edit-form" method="post">
    <div class="profile-info">
      <label for="newName" >New User Name:</label>
      <input type="text" id="newName" name="newName" required>
    </div>
    <div class="profile-info">
      <label for="newEmail">New Email:</label>
      <input type="email" id="newEmail" name="newEmail" required>
    </div>
    <div class="profile-info">
      <label for="newAddress">New Address:</label>
      <input type="text" id="newAddress" name="newAddress" required>
    </div>
    <div class="profile-info">
      <label for="newTelephone">New Telephone:</label>
      <input type="text" id="newTelephone" name="newTelephone" required>
    </div>
    <button class="btn" name="save">Save</button>
  </form>
</div>

<script>
function showEditForm() {
  var editForm = document.getElementById("editForm");
  editForm.style.display = "block";
}
</script>

</body>
</html>
