<?php
include("includes/db.php");
include("includes/header.php");
?>

<style>
    #about-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
        text-align: center;
    }

    #main-heading {
        font-size: 36px;
        color: #4a4a4a;
        margin-bottom: 20px;
        font-weight: bold;
    }

    #mission-heading,
    #story-heading,
    #values-heading,
    #team-heading,
    #cta-heading {
        font-size: 28px;
        color: #6c5b7b;
        margin-bottom: 15px;
        font-weight: normal;
    }

    #welcome-text,
    #mission-text,
    #story-text,
    #cta-text {
        font-size: 18px;
        line-height: 1.8;
        color: #555;
        margin-bottom: 20px;
    }

    #mission-section,
    #story-section,
    #values-section {
        margin-bottom: 50px;
    }

    #values-list {
        list-style: none;
        padding: 0;
    }

    #values-list li {
        font-size: 18px;
        margin-bottom: 10px;
        color: #555;
    }

    #team-section {
        background-color: #fff;
        padding: 40px 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    #team-members {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }

    #team-member-1,
    #team-member-2,
    #team-member-3 {
        width: 30%;
        margin-bottom: 20px;
    }

    #team-member-1 img,
    #team-member-2 img,
    #team-member-3 img {
        width: 100%;
        border-radius: 50%;
        max-width: 150px;
        margin-bottom: 15px;
    }

    #team-member-1 h3,
    #team-member-2 h3,
    #team-member-3 h3 {
        font-size: 20px;
        color: #4a4a4a;
        margin-bottom: 5px;
    }

    #team-member-1 p,
    #team-member-2 p,
    #team-member-3 p {
        font-size: 16px;
        color: #777;
    }

    #cta-button {
        display: inline-block;
        padding: 15px 30px;
        background-color: #6c5b7b;
        color: #fff;
        font-size: 18px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    #cta-button:hover {
        background-color: #4a3f52;
    }
</style>

<?php
$sql = "SELECT * FROM vision_mission";
$dataVisions = mysqli_query($conn, $sql);
if (mysqli_num_rows($dataVisions) > 0) {
    $res = mysqli_fetch_assoc($dataVisions);

?>
    <div id="about-container">
        <h1 id="main-heading">About Cloud7</h1>
        <p id="welcome-text">Welcome to <strong>Cloud7</strong>, <?=$res['vision']?></p>

        <div id="mission-section">
            <h2 id="mission-heading">Our Mission</h2>
            <p id="mission-text">At Cloud7, <?=$res['mission']?>.</p>
        </div>
<!-- 
        <div id="story-section">
            <h2 id="story-heading">Our Story</h2>
            <p id="story-text">Founded in 2020, Cloud7 began as a dream to bring the art of perfumery to everyone. Our journey started in a small lab, where we experimented with rare ingredients and unique blends. Today, we are proud to be a global brand, loved by fragrance enthusiasts worldwide.</p>
        </div>

        <div id="values-section">
            <h2 id="values-heading">Our Values</h2>
            <ul id="values-list">
                <li><strong>Quality:</strong> We use only the finest ingredients to ensure every fragrance is exceptional.</li>
                <li><strong>Sustainability:</strong> We are committed to eco-friendly practices and ethical sourcing.</li>
                <li><strong>Innovation:</strong> We constantly push the boundaries of perfumery to create unique scents.</li>
                <li><strong>Passion:</strong> Our love for fragrance drives everything we do.</li>
            </ul>
        </div> -->

        <!-- <div id="team-section">
            <h2 id="team-heading">Meet Our Team</h2>
            <div id="team-members">
                <div id="team-member-1" class="team-member">
                    <img src="https://via.placeholder.com/150" alt="Team Member 1">
                    <h3 id="team-member-1-name">John Doe</h3>
                    <p id="team-member-1-role">Founder & CEO</p>
                </div>
                <div id="team-member-2" class="team-member">
                    <img src="https://via.placeholder.com/150" alt="Team Member 2">
                    <h3 id="team-member-2-name">Jane Smith</h3>
                    <p id="team-member-2-role">Lead Perfumer</p>
                </div>
                <div id="team-member-3" class="team-member">
                    <img src="https://via.placeholder.com/150" alt="Team Member 3">
                    <h3 id="team-member-3-name">Emily Clark</h3>
                    <p id="team-member-3-role">Marketing Director</p>
                </div>
            </div>
        </div> -->

        <div id="cta-section">
            <h2 id="cta-heading">Discover Our Fragrances</h2>
            <p id="cta-text">Explore our collection of exquisite perfumes and find your signature scent.</p>
            <a href="index.php" id="cta-button">Shop Now</a>
        </div>
    </div>
<?php
}
?>

<?php include("includes/footer.php"); ?>