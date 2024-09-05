<?php
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['username'])){
    echo json_encode(["success" => false, "message" => "Unauthorized access"]);
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wedding";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]);
    exit();
}
function sendEmail($conn, $contact_id, $status){
    $sql_contact = "SELECT name, email FROM contact WHERE  id = ?";
    $stmt_contact = $conn->prepare($sql_contact);
    $stmt_contact->bind_param("i", $contact_id);
    $stmt_contact->execute();
    $result_contact = $stmt_contact->get_result();

    if ($result_contact->num_rows > 0) {
        $contact = $result_contact->fetch_assoc();
        $to = $contact['email'];
        $subject = "Proposal Status Update";
        $message = "Dear " . $contact['name'] . ",\n\n";

        if ($status == 'Accepted') {
            $message .= "We are pleased to inform you that your proposal has been accepted.\n";
        } elseif ($status == 'Rejected') {
            $message .= "We regret to inform you that your proposal has been rejected.\n";
        }

        $message .= "Thank you.\n\nBest regards,\nYour Wedding Planner";
        $headers = "From: viswateja4949@gmail.com\r\n";
        $headers .= "Reply-To: viswateja4949@gmail.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        if (mail($to, $subject, $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }

    $stmt_contact->close();
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST"  &&  isset($_POST['action'])) {
    $action = $_POST['action'];
    $contact_id = $_POST['contact_id'];
    if ($action == 'accept') {
        $update_status = "UPDATE contact SET status = 'Accepted' WHERE id = ?";
        $stmt = $conn->prepare($update_status);
        $stmt->bind_param("i", $contact_id);
        if ($stmt->execute()) {
            if (!sendEmail($conn, $contact_id, 'Accepted')) {
                echo json_encode(["success" => false, "message" => "Failed to send acceptance email."]);
                exit;
            }
            echo json_encode(["success" => true, "message" => "Proposal accepted successfully.Email also sent successfully"]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to accept proposal: " . $conn->error]);
        }
        $stmt->close();
    } elseif ($action == 'decline') {
        $update_status = "UPDATE contact SET status = 'Rejected' WHERE id = ?";
        $stmt = $conn->prepare($update_status);
        $stmt->bind_param("i", $contact_id);

        if ($stmt->execute()) {
            if (!sendEmail($conn, $contact_id, 'Rejected')) {
                echo json_encode(["success" => false, "message" => "Failed to send rejection email."]);
                exit;
            }
            echo json_encode(["success" => true, "message" => "Proposal rejected successfully.Email also sent successfully"]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to reject proposal: " . $conn->error]);
        }
        $stmt->close();
    } elseif ($action == 'delete') {
        $delete_contact = "DELETE FROM contact WHERE id = ?";
        $stmt = $conn->prepare($delete_contact);
        $stmt->bind_param("i", $contact_id);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Contact deleted successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to delete contact: " . $conn->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Invalid action."]);
    }
}

$conn->close();
?>
