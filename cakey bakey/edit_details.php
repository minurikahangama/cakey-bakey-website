<!-- Edit form initially hidden -->
<form id="editForm" class="edit-form">
  <div class="profile-info">
    <label for="newName">New User Name:</label>
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
  <button class="save-button" onclick="saveDetails()">Save</button>
</form>
</div>

<script>
function showEditForm() {
  var editForm = document.getElementById("editForm");
  editForm.style.display = "block";
}


</script>

<?php
// Start the session

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

    // Prepare and bind the UPDATE statement
    $sql_update = $conn->prepare("UPDATE register SET user_name=?, email=?, address=?, contact=? WHERE user_id=?");
    $sql_update->bind_param("ssssi", $newName, $newEmail, $newAddress, $newTelephone, $user_id);

    if ($sql_update->execute() === TRUE) {
        echo 'Details updated successfully';
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $sql_update->close();
    $conn->close();
}
?>

