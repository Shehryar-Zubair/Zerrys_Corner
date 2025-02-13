<?php
session_start();

// Initialize the cart in the session if not already done
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['email']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Zerry's Corner</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="menu.css">
</head>

<body>
    <header style="text-align: center; padding: 0px; background-color: #f8f8f8;">
        <!-- Logo -->
        <img src="pictures/zerrylogo.png" alt="Zerry's Corner Logo"
            style="width: 300px; height: auto; margin: 0 auto ;position: display: block;">
        <!-- Title and Tagline-->
        <h1>Our Menu</h1>
        <nav>
            <ul>
                <li><a href="#appetizers">Appetizers</a></li>
                <li><a href="#mains">Mains</a></li>
                <li><a href="#desserts">Desserts</a></li>
                <li>
            <a href="view_cart.php">
                View Cart
                <?php if (!empty($_SESSION['cart'])): ?>
                    (<?php echo count($_SESSION['cart']); ?>)
                <?php endif; ?>
            </a>
        </li>
            </ul>
        </nav>
    </header>

    <!-- Appetizers Section -->
    <section id="appetizers">
        <h2>Appetizers</h2>
        <div class="menu-items">
            <div class="menu-item">
                <img src="pictures/Fries.avif" alt="Fries" />
                <h4>Hot & Loaded</h4>
                <p>Crispy fries topped with cheese and jalapeños.</p>
                <span class="price">$3.50</span>
                <form method="post" action="add_to_cart.php">
                    <input type="hidden" name="m_id" value="1" />
                    <input type="hidden" name="price" value="2.99" />
                    <button type="submit" name="add_to_cart" <?php echo $isLoggedIn ? '' : 'disabled'; ?>>Add to Cart
                    </button><?php if (!$isLoggedIn): ?>
                    <p><a href="homepage.php?popup=login">Log in</a> to add items to your cart.</p>
                    <?php endif; ?>
                </form>
            </div>
            <div class="menu-item">
                <img src="pictures/moz_stix.jpg" alt="Mozzarella Sticks" />
                <h4>No Strings Attached</h4>
                <p>Golden fried mozzarella sticks served with marinara sauce.</p>
                <span class="price">$2.99</span>
                <form method="post" action="add_to_cart.php">
                    <input type="hidden" name="m_id" value="2" />
                    <input type="hidden" name="price" value="2.99" />
                    <button type="submit" name="add_to_cart" <?php echo $isLoggedIn ? '' : 'disabled'; ?>>Add to Cart
                    </button><?php if (!$isLoggedIn): ?>
                    <p><a href="homepage.php?popup=login">Log in</a> to add items to your cart.</p>
                    <?php endif; ?>
                </form>
            </div>
            <div class="menu-item">
                <img src="pictures/nacho.jpg" alt="Nachos" />
                <h4>Macho Nachos</h4>
                <p>Mexican-styled nachos loaded with salsa, cheese, and sour cream.</p>
                <span class="price">$3.50</span>
                <form method="post" action="add_to_cart.php">
                    <input type="hidden" name="m_id" value="3" />
                    <input type="hidden" name="price" value="3.50" />
                    <button type="submit" name="add_to_cart" <?php echo $isLoggedIn ? '' : 'disabled'; ?>>Add to Cart
                    </button><?php if (!$isLoggedIn): ?>
                    <p><a href="homepage.php?popup=login">Log in</a> to add items to your cart.</p>
                    <?php endif; ?>
                </form>
            </div>
            <div class="menu-item">
                <img src="pictures/sliders.jpg" alt="Mini Sliders" />
                <h4>Tiny But Mighty</h4>
                <p>Bite-sized burgers with a variety of fillings.</p>
                <span class="price">$4.99</span>
                <form method="post" action="add_to_cart.php">
                    <input type="hidden" name="m_id" value="4" />
                    <input type="hidden" name="price" value="4.99" />
                    <button type="submit" name="add_to_cart" <?php echo $isLoggedIn ? '' : 'disabled'; ?>>Add to Cart
                    </button><?php if (!$isLoggedIn): ?>
                    <p><a href="homepage.php?popup=login">Log in</a> to add items to your cart.</p>
                    <?php endif; ?>
                </form>
            </div>
            <div class="menu-item">
              <img src="pictures/wings.png" alt="Tenders" />
              <h4>Wingin' It</h4>
              <p>Honey Glazed Grilled Chicken Wings Dipped in honey mustard sauce.</p>
            <span class="price">$3.99</span>
            <form method="post" action="add_to_cart.php">
              <input type="hidden" name="m_id" value="5" />
              <input type="hidden" name="price" value="3.99" />
              <button type="submit" name="add_to_cart" <?php echo $isLoggedIn ? '' : 'disabled'; ?>>Add to Cart
                    </button><?php if (!$isLoggedIn): ?>
                    <p><a href="homepage.php?popup=login">Log in</a> to add items to your cart.</p>
                    <?php endif; ?>
                </form>
          </div>
        </div>
    </section>

    <!-- Mains Section -->
    <section id="mains">
        <h2>Mains</h2>
        <div class="menu-items">
            <div class="menu-item">
                <img src="pictures/cheeze.jpg" alt="Burger" />
                <h4>Say Cheese!</h4>
                <p>Succulent grilled patty with a generous layer of melted cheese, served fresh off the grill.</p>
                <span class="price">$5.99</span>
                <form method="post" action="add_to_cart.php">
                    <input type="hidden" name="m_id" value="6" />
                    <input type="hidden" name="price" value="5.99" />
                    <button type="submit" name="add_to_cart" <?php echo $isLoggedIn ? '' : 'disabled'; ?>>Add to Cart
                    </button><?php if (!$isLoggedIn): ?>
                    <p><a href="homepage.php?popup=login">Log in</a> to add items to your cart.</p>
                    <?php endif; ?>
                </form>
            </div>
            <div class="menu-item">
                <img src="pictures/carbonara.webp" alt="Pasta" />
                <h4>Creamy Carbonara</h4>
                <p>Rich, creamy carbonara with crispy pancetta, silky Parmesan sauce, and a touch of black pepper.</p>
                <span class="price">$6.99</span>
                <form method="post" action="add_to_cart.php">
                    <input type="hidden" name="m_id" value="7" />
                    <input type="hidden" name="price" value="6.99" />
                    <button type="submit" name="add_to_cart" <?php echo $isLoggedIn ? '' : 'disabled'; ?>>Add to Cart
                    </button><?php if (!$isLoggedIn): ?>
                    <p><a href="homepage.php?popup=login">Log in</a> to add items to your cart.</p>
                    <?php endif; ?>
                </form>
            </div>
            <div class="menu-item">
        <img src="pictures/pizza.jpg" alt="Pizza" />
        <h4>Mario's First Love</h4>
        <p>Wood-fired pizza topped with fresh basil and mozzarella.
          Princess Peach Who?
        </p>
        <span class="price">$6.99</span>
        <form method="post" action="add_to_cart.php">
          <input type="hidden" name="m_id" value="8" />
          <!-- Dynamic ID -->
          <input type="hidden" name="price" value="6.99" />
          <!-- Dynamic Price -->
          <button type="submit" name="add_to_cart" <?php echo $isLoggedIn ? '' : 'disabled'; ?>>Add to Cart
                    </button><?php if (!$isLoggedIn): ?>
                    <p><a href="homepage.php?popup=login">Log in</a> to add items to your cart.</p>
                    <?php endif; ?>
                </form>
      </div>
      <div class="menu-item">
        <img src="pictures/tomahawk.jpg" alt="Steak" />
        <h4>Sear-iously Epic</h4>
        <p>Juicy tomahawk steak served with garlic butter and vegetables.</p>
        <span class="price">$9.99</span>
        <form method="post" action="add_to_cart.php">
          <input type="hidden" name="m_id" value="9" />
          <!-- Dynamic ID -->
          <input type="hidden" name="price" value="9.99" />
          <!-- Dynamic Price -->
          <button type="submit" name="add_to_cart" <?php echo $isLoggedIn ? '' : 'disabled'; ?>>Add to Cart
                    </button><?php if (!$isLoggedIn): ?>
                    <p><a href="homepage.php?popup=login">Log in</a> to add items to your cart.</p>
                    <?php endif; ?>
                </form>
      </div>
      <div class="menu-item">
        <img src="pictures/club.jpg" alt="Sandwich" />
        <h4>Stack Attack</h4>
        <p>Three-layered  Club Sandwich having chicken, eggs, and veggies.</p>
        <span class="price">$7.99</span>
        <form method="post" action="add_to_cart.php">
          <input type="hidden" name="m_id" value="10" />
          <!-- Dynamic ID -->
          <input type="hidden" name="price" value="7.99" />
          <!-- Dynamic Price -->
          <button type="submit" name="add_to_cart" <?php echo $isLoggedIn ? '' : 'disabled'; ?>>Add to Cart
                    </button><?php if (!$isLoggedIn): ?>
                    <p><a href="homepage.php?popup=login">Log in</a> to add items to your cart.</p>
                    <?php endif; ?>
                </form>
      </div>
      <div class="menu-item">
        <img src="pictures/burrito.jpg" alt="Burrito" loading="lazy" />
        <h4>Wrap It Like It's Hot</h4>
        <p>Tortilla wrap filled with juicy meats, crisp veggies, and drizzled with creamy sour cream, smooth guac, and fiery hot sauce for the perfect bite.</p>
        <span class="price">$6.99</span>
        <form method="post" action="add_to_cart.php">
          <input type="hidden" name="m_id" value="11" />
          <!-- Dynamic ID -->
          <input type="hidden" name="price" value="6.99" />
          <!-- Dynamic Price -->
          <button type="submit" name="add_to_cart" <?php echo $isLoggedIn ? '' : 'disabled'; ?>>Add to Cart
                    </button><?php if (!$isLoggedIn): ?>
                    <p><a href="homepage.php?popup=login">Log in</a> to add items to your cart.</p>
                    <?php endif; ?>
                </form>
      </div>
    </div>
  </section>



    <!-- Desserts Section -->
    <section id="desserts">
        <h2>Desserts</h2>
        <div class="menu-items">
            <div class="menu-item">
                <img src="pictures/cake.jpg" alt="Cheesecake" />
                <h4>A Sweet Escape</h4>
                <p>Rich and creamy cheesecake with a graham cracker crust.</p>
                <span class="price">$5.99</span>
                <form method="post" action="add_to_cart.php">
                    <input type="hidden" name="m_id" value="12" />
                    <input type="hidden" name="price" value="5.99" />
                    <button type="submit" name="add_to_cart" <?php echo $isLoggedIn ? '' : 'disabled'; ?>>Add to Cart
                    </button><?php if (!$isLoggedIn): ?>
                    <p><a href="homepage.php?popup=login">Log in</a> to add items to your cart.</p>
                    <?php endif; ?>
                </form>
            </div>
            <div class="menu-item">
                <img src="pictures/brownie.jpg" alt="Brownie" />
                <h4>Fudged Up</h4>
                <p>Fudgy brownies served hot with ice cream.</p>
                <span class="price">$4.99</span>
                <form method="post" action="add_to_cart.php">
                    <input type="hidden" name="m_id" value="13" />
                    <input type="hidden" name="price" value="4.99" />
                    <button type="submit" name="add_to_cart" <?php echo $isLoggedIn ? '' : 'disabled'; ?>>Add to Cart
                    </button><?php if (!$isLoggedIn): ?>
                    <p><a href="homepage.php?popup=login">Log in</a> to add items to your cart.</p>
                    <?php endif; ?>
                </form>
            </div>
            <div class="menu-item">
        <img src="pictures/Ice.jpg" alt="Ice Cream" />
        <h4>Bean There Done That</h4>
        <p>Coffee and cinnamon Flavored ice cream topped with Caramel sauce.</p>
        <span class="price">$3.99</span>
        <form method="post" action="add_to_cart.php">
          <input type="hidden" name="m_id" value="14" />
          <!-- Dynamic ID -->
          <input type="hidden" name="price" value="3.99" />
          <!-- Dynamic Price -->
          <button type="submit" name="add_to_cart" <?php echo $isLoggedIn ? '' : 'disabled'; ?>>Add to Cart
                    </button><?php if (!$isLoggedIn): ?>
                    <p><a href="homepage.php?popup=login">Log in</a> to add items to your cart.</p>
                    <?php endif; ?>
                </form>
      </div>
    </div>
  </section>

    <footer>
        <p>&copy; 2024 Zerry's Corner. All rights reserved.</p>
        <p><a href="homepage1.php">Back to Home</a></p>
    </footer>

    <script>
        document.querySelectorAll("nav a").forEach(anchor => {
    anchor.addEventListener("click", function(e) {
        const href = this.getAttribute("href");
        if (href.startsWith("#")) { // Only prevent for in-page anchors
            e.preventDefault();
            const targetSection = document.querySelector(href);
            const headerHeight = 70;
            if (targetSection) {
                window.scrollTo({
                    top: targetSection.offsetTop - headerHeight,
                    behavior: "smooth"
                });
            }
        }
    });
});

    </script>
</body>

</html>
