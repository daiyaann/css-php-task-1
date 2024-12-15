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
    2 => "You step through Door 2 and enter an ancient cave. Inside, you hear the sound of rushing water. Will you follow the sound or explore the glowing crystals?",
    3 => "You step through Door 3 and find yourself in a mystical garden filled with talking animals. Will you speak to the wise owl or follow the playful fox?",
    4 => "You took the sunny path and discovered a chest filled with gold coins. Congratulations, you found the treasure!",
    5 => "You followed the shadowy path and fell into a trap. Unfortunately, your adventure ends here.",
    6 => "You followed the sound of water and discovered a hidden waterfall with a chest of jewels. You found the treasure!",
    7 => "You explored the glowing crystals and accidentally triggered a collapse. Your adventure ends here.",
    8 => "The wise owl gave you a map leading to a secret treasure. Congratulations, you found the treasure!",
    9 => "The playful fox led you into a maze, and you got lost. Unfortunately, your adventure ends here."
];

$choices = [
    1 => [4 => "Sunny Path", 5 => "Shadowy Path"],
    2 => [6 => "Follow the Sound", 7 => "Explore Crystals"],
    3 => [8 => "Speak to the Owl", 9 => "Follow the Fox"]
];

$doorImages = [
    4 => "Screenshot 2024-12-15 112654.png",
    5 => "Screenshot 2024-12-15 112919.png",
    6 => "door2_waterfall.png",
    7 => "door2_collapse.png",
    8 => "Screenshot 2024-12-15 115512.png", // Replace with the image for Door 3's owl outcome
    9 => "Screenshot 2024-12-15 115716.png"  // Replace with the image for Door 3's fox outcome
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
                        <img src="<?php echo $doorImages[$key] ?? 'default_image.png'; ?>" alt="<?php echo $label; ?>" class="door-image">
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
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        color: #fff;
        text-align: center;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    button.door {
        background-color: transparent;
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
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        transition: transform 0.2s;
    }

    button.door img.door-image:hover {
        transform: scale(1.05);
    }

    button.door p {
        margin-top: 10px;
        font-size: 1.2em;
        color: #fff;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.7);
    }
</style>
</html>
