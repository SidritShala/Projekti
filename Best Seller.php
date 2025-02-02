<?php
$products = [
    [
        "name" => "Forza Horizon 5",
        "price" => "$59.99",
        "details" => "Forza Horizon 5 is a racing video game developed by Playground Games. It features an open-world design and dynamic weather.",
        "rating" => "4.5",
        "image" => "FORZA HORIZON 5.jpg"
    ],
    [
        "name" => "Call of Duty: Black Ops 6",
        "price" => "$49.99",
        "details" => "Call of Duty: Black Ops 6 is a first-person shooter focusing on multiplayer gameplay with advanced combat mechanics.",
        "rating" => "3.2",
        "image" => "CALL-OF-DUTY22.jpg"
    ],
    [
        "name" => "NBA2K25",
        "price" => "$79.99",
        "details" => "NBA2K25 is a basketball simulation video game developed by Visual Concepts.",
        "rating" => "4.7",
        "image" => "NBA2K25-2.jpg"
    ],
    // Të dhëna të tjera të produkteve
    [
        "name" => "Assassin's Creed® Origins",
        "price" => "$39.99",
        "details" => "Assassin’s Creed Origins is an action-adventure game set in an expansive open world that explores the origins of the Assassin Brotherhood.",
        "rating" => "3.2",
        "image" => "assasin creed origins.jpg"
    ],
    [
        "name" => "Grand Theft Auto V",
        "price" => "$89.99",
        "details" => "Grand Theft Auto V is an open-world action-adventure game set in the sprawling city of Los Santos.",
        "rating" => "4.2",
        "image" => "GTA-5-2.jpg"
    ],
    
];

// Të dhënat për komente
$reviews = [
    [
        "text" => "Forza Horizon 5 blew my mind! The graphics are stunning, and the gameplay is top-notch. A must-have for any racing fan!",
        "author" => "Alex G."
    ],
    [
        "text" => "I've been a fan of GTA for years, and GTA V exceeded all expectations. The story and the open-world gameplay are unparalleled.",
        "author" => "Jamie L."
    ],
    [
        "text" => "Minecraft is still the ultimate sandbox experience. Whether building or surviving, it never gets old!",
        "author" => "Chris P."
    ]
];

// Të dhënat për lajme
$news = [
    [
        "title" => "New DLC for Forza Horizon 5 Announced",
        "content" => "Playground Games has just unveiled a brand-new DLC for Forza Horizon 5, introducing exciting new challenges and vehicles."
    ],
    [
        "title" => "Minecraft Receives Major Update",
        "content" => "The latest update adds new biomes, mobs, and features, making Minecraft better than ever!"
    ],
    [
        "title" => "Upcoming Gaming Expo 2024",
        "content" => "Mark your calendars! The biggest gaming expo of the year is coming this summer, showcasing the latest and greatest in the gaming world."
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Seller Xbox Games - Illyrian PlayHouse</title>
    <link rel="stylesheet" href="bestseller.css">
    <script src="bestseller.js" defer></script>
</head>
<body>
    <header>
        <div class="logo">
            <h1>Illyrian PlayHouse</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="Games.html">Games</a></li>
                <li><a href="VR Games.html" class="active">VR World</a></li>
                <li><a href="About.html">About Us</a></li>
            </ul>
        </nav>
        <div class="search-bar">
            <input type="text" id="search" placeholder="Search games...">
            <button id="search-btn">Search</button>
        </div>
    </header>
    <main>
        <section class="best-seller">
            <h2>Best-Selling Games</h2>
            <div class="product-list">
                <?php foreach ($products as $product): ?>
                    <div class="product" data-name="<?= htmlspecialchars($product['name']) ?>" data-price="<?= htmlspecialchars($product['price']) ?>" data-details="<?= htmlspecialchars($product['details']) ?>" data-rating="<?= htmlspecialchars($product['rating']) ?>">
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                        <h3><?= htmlspecialchars($product['name']) ?></h3>
                        <p>Price: <?= htmlspecialchars($product['price']) ?></p>
                        <button class="buy-button">Buy Now</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="reviews">
            <h2>Player Reviews</h2>
            <div class="review-grid">
                <?php foreach ($reviews as $review): ?>
                    <div class="review">
                        <p>"<?= htmlspecialchars($review['text']) ?>"</p>
                        <span>- <?= htmlspecialchars($review['author']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="news">
            <h2>Latest Gaming News</h2>
            <div class="news-grid">
                <?php foreach ($news as $item): ?>
                    <div class="news-item">
                        <h3><?= htmlspecialchars($item['title']) ?></h3>
                        <p><?= htmlspecialchars($item['content']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="newsletter">
            <h2>Stay Updated</h2>
            <p>Subscribe to our newsletter for the latest updates, offers, and news in the gaming universe.</p>
            <form>
                <input type="email" placeholder="Enter your email" required>
                <button type="submit" class="subscribe-button">Subscribe</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Illyrian PlayHouse. All rights reserved.</p>
        <div class="footer-links">
            <a href="#">Terms of Service</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Contact Us</a>
        </div>
    </footer>
</body>
</html>
