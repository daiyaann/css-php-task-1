<?php
session_start();

if (isset($_POST['restart'])) {
    session_destroy();
    session_start();
    header("Location: index.html");
    exit();
}

if (!isset($_SESSION['path'])) {
    $_SESSION['path'] = 0;
}

$stories = [
    0 => "Welcome to the Magic Door Adventure! You are on a quest to find hidden treasure. Choose a door to begin.",
    1 => "You step through Door 1 and find yourself in a dark forest. Two paths lie ahead: a sunny path and a shadowy path. Which one will you choose?",
    4 => "You took the sunny path and discovered a chest filled with gold coins. Congratulations, you found the treasure!",
    5 => "You followed the shadowy path and fell into a trap. Unfortunately, your adventure ends here."
];

$choices = [
    1 => [4 => "Sunny Path", 5 => "Shadowy Path"]
];

$doorImages = [
    4 => "Screenshot 2024-12-15 112654.png", // Replace with actual image file paths
    5 => "Screenshot 2024-12-15 112919.png"
];

if (isset($_POST['choice']) && isset($stories[$_POST['choice']])) {
    $_SESSION['path'] = $_POST['choice'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magic Door Adventure</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Magic Door Adventure</h1>

    <div class="story">
        <?php echo $stories[$_SESSION['path']]; ?>
    </div>

    <?php if (isset($choices[$_SESSION['path']])): ?>
        <form method="post">
            <?php foreach ($choices[$_SESSION['path']] as $key => $label): ?>
                <button class="door" name="choice" value="<?php echo $key; ?>">
                    <div>
                        <img src="<?php echo $doorImages[$key]; ?>" alt="<?php echo $label; ?>" class="door-image">
                        <p><?php echo $label; ?></p>
                    </div>
                </button>
            <?php endforeach; ?>
        </form>
    <?php else: ?>
        <form method="post">
            <button class="restart" name="restart">Restart Adventure</button>
        </form>
    <?php endif; ?>

</body>

<style>

body {
            background-image: url('organic-flat-jungle-background_23-2148952811.avif'); /* Replace with the actual background image file path */
            background-size: cover; /* Ensures the image covers the entire background */
            background-repeat: no-repeat; /* Prevents the image from repeating */
            background-attachment: fixed; /* Keeps the background fixed during scrolling */
            color: #fff; /* Sets default text color for better visibility */
            text-align: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

    button.door {
        background-color: transparent; /* Transparent background for image visibility */
        border: none;
        padding: 10px;
        cursor: pointer;
        margin: 10px;
        display: inline-block;
        text-align: center;
        width: 200px;
    }

    button.door img.door-image {
        width: 100%;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5); /* Adds depth */
        transition: transform 0.2s;
    }

    button.door img.door-image:hover {
        transform: scale(1.05); /* Slightly enlarge the image on hover */
    }

    button.door p {
        margin-top: 10px;
        font-size: 1.2em;
        color: #fff;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.7);
    }
</style>
</html>
