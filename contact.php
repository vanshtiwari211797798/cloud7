<?php
include("includes/db.php");
include './includes/header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['name'])) {
        echo "
        <script>
            alert('Name is required');
        </script>
    ";
    } elseif (empty($_POST['email'])) {
        echo "
        <script>
            alert('Email is required');
        </script>
    ";
    }elseif(empty($_POST['message'])){
        echo "
        <script>
            alert('Message is required');
        </script>
    ";
    }else{
        $name=$_POST['name'];
        $email=$_POST['email'];
        $message=$_POST['message'];
        $sql="INSERT INTO contact_us (name,email,message) VALUES ('$name','$email','$message')";
        if(mysqli_query($conn,$sql)){
            echo "
            <script>
                alert('Contact successfully');
            </script>
        ";
        }
    }
}
?>

<style>
    /* Container for the entire section */
    #contact-section {
        display: flex;
        align-items: center;
        gap: 20px;
        /* Space between image and contact form */
        max-width: 800px;
        /* Adjust as needed */
        margin: 0 auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Image Section */
    #contact-image {
        flex: 1;
        /* Takes up 50% of the space */
        text-align: center;
    }

    #contact-image img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    /* Contact Form Section */
    #contact-container {
        flex: 1;
        /* Takes up 50% of the space */
        padding: 20px;
        border-radius: 8px;
        text-align: center;
    }

    #contact-title {
        margin-bottom: 10px;
        color: #333;
    }

    #contact-desc {
        color: #666;
        font-size: 14px;
    }

    #input-group {
        text-align: left;
        margin-bottom: 15px;
    }

    #input-label {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
        color: #555;
    }

    #input-field,
    #textarea-field {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    #input-field:focus,
    #textarea-field:focus {
        border-color: #28a745;
        outline: none;
    }

    #submit-btn {
        width: 100%;
        padding: 10px;
        background: #28a745;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        font-size: 16px;
        transition: background 0.3s ease;
    }

    #submit-btn:hover {
        background: #218838;
    }

    #form-message {
        margin-top: 10px;
        font-size: 14px;
    }

    #success-message {
        color: #28a745;
    }

    #error-message {
        color: #dc3545;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        #contact-section {
            flex-direction: column;
            /* Stack image and form on small screens */
        }

        #contact-image,
        #contact-container {
            flex: 1;
            width: 100%;
        }
    }
</style>

<!-- Contact Section -->
<div id="contact-section">
    <!-- Image on the Left -->
    <div id="contact-image">
        <img src="https://i.pinimg.com/736x/b9/a9/c4/b9a9c44d0faa77a2bbe98f4bf8448ea6.jpg" alt="Contact Image"> <!-- Replace with your image URL -->
    </div>

    <!-- Contact Form on the Right -->
    <div id="contact-container">
        <h2 id="contact-title">Contact Us</h2>
        <p id="contact-desc">Feel free to reach out to us. We are here to help you!</p>

        <form id="contact-form" method="post">
            <div id="input-group">
                <label id="input-label" for="name">Name</label>
                <input id="input-field" type="text" name="name" placeholder="Enter your name" aria-label="Name" required>
            </div>

            <div id="input-group">
                <label id="input-label" for="email">Email</label>
                <input id="input-field" type="email" name="email" placeholder="Enter your email" aria-label="Email" required>
            </div>

            <div id="input-group">
                <label id="input-label" for="message">Message</label>
                <textarea id="textarea-field" name="message" style="resize: none;" rows="4" placeholder="Type your message" aria-label="Message" required></textarea>
            </div>

            <button id="submit-btn" type="submit">Send Message</button>
            <p id="form-message"></p>
        </form>
    </div>
</div>




<?php include './includes/footer.php'; ?>