<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wedding";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success_message = "";
$error_message = "";

$sql_contacts = "SELECT id, name, email, number, date, address, plan, message, photo, status FROM contact";
$result_contacts = $conn->query($sql_contacts);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="po.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>                        
    <script>                                                                                       
        $(document).ready(function() {
            $(".action-button").click(function(e) {
                e.preventDefault();
                var action = $(this).attr('name');                                                
                var contact_id = $(this).closest('form').find('input[name="contact_id"]').val();
                var row = $(this).closest('tr');
                $.ajax({
                    url: 'ajaxteja.php',
                    type: 'POST',                                              
                    data: {
                        action: action,
                        contact_id: contact_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            showAlert(response.message);
                            if (action === 'accept' || action === 'decline') {
                                row.find('td.status').text(action === 'accept' ? 'Accepted' : 'Rejected');
                                row.find('td.actions').html(
                                    '<form>' +
                                    '<input type="hidden" name="contact_id" value="' + contact_id + '">' +
                                    '<button class="action-button" name="delete">Delete</button>' +
                                    '</form>'
                                );
                            } else if (action === 'delete') {
                                row.remove();
                            }
                        } else {
                            showAlert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        showAlert('AJAX Error: ' + error);
                    }
                });
            });

            
            function showAlert(message) {
                alert(message);
            }
        });
    </script>
</head>
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>
        <div>
            <a href="teja.php">Home</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <div class="contacts-container">
            <h3>Contacts List</h3>
            <?php
            if ($result_contacts->num_rows > 0) {
                echo "<table id='contacts-table'>";
                echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Number</th><th>Date</th><th>Address</th><th>Plan</th><th>Message</th><th>Photo</th><th>Status</th><th>Action</th></tr>";

                while ($row = $result_contacts->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['number'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['plan'] . "</td>";
                    echo "<td>" . $row['message'] . "</td>";

                    echo "<td>";
                    if (!empty($row['photo'])) {
                        echo "<img src='" . $row['photo'] . "' alt='Photo' />";
                    } else {
                        echo "No photo available";
                    }
                    echo "</td>";

                    echo "<td class='status'>" . $row['status'] . "</td>";
                    echo "<td class='actions'>";
                    if (isset($row['status']) && ($row['status'] == 'Accepted' || $row['status'] == 'Rejected')) {
                        echo "<form>";
                        echo "<input type='hidden' name='contact_id' value='" . $row['id'] . "'>";
                        echo "<button class='action-button' name='delete'>Delete</button>";
                        echo "</form>";
                    } else {
                        echo "<form>";
                        echo "<input type='hidden' name='contact_id' value='" . $row['id'] . "'>";
                        echo "<button class='action-button' name='accept'>Accept</button>";
                        echo "<button class='action-button' name='decline'>Decline</button>";
                        echo "</form>";
                    }

                    echo "</td>";

                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No contacts found.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
<?php
$conn->close();
?>
