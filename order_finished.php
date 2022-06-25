<!doctype html>

<html lang="en" class="h-100">
    <head>
        <?php
        include("./components/bootstrap.php");
        include_once("./classes/db.php");
        ?>
        <title>Beyond beauty - thank you</title>
    </head>

    <body class="d-flex h-100 text-center text-white bg-dark">
        <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
            <header class="mb-auto">
                <div>
                    <h3 class="float-md-start mb-0">
                        <a class="navbar-brand" href="main.php">
                            <svg class="bi bi-exclamation-triangle text-light" width="26" height="26" fill="currentColor" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004.961-2.989H4.186l.963 2.995 5.704-.006zM5.47 5.495 8 13.366l2.532-7.876-5.062.005zm-1.371-.999-.78-2.422-1.818 2.425 2.598-.003zM1.499 5.5l5.113 6.817-2.192-6.82L1.5 5.5zm7.889 6.817 5.123-6.83-2.928.002-2.195 6.828z"/>
                            </svg>
                            &ensp; Beyond Beauty
                        </a>
                    </h3>
                </div>
            </header>

            <main class="px-3">
                <h1>Thank you for your order!</h1>
                <p class="lead">
                    Our team is preparing your order, you will receive updates via email. Return to the
                    <a href="main.php" class="text-danger text-decoration-none">
                        <strong>main page</strong>
                    </a>
                </p>
            </main>

            <div class="px-3">
                <h3>Your products:</h3>
                <p class="lead">
                    <ul>
                    <?php
                        session_start();

                        $db = new DataBase();

                        $select = "SELECT product.product_name, ordered_products.product_amount_ordered, orders.value FROM ordered_products
                                    INNER JOIN product ON ordered_products.product_id = product.product_id
                                    INNER JOIN orders ON ordered_products.orders_id = orders.orders_id
                                    WHERE orders.orders_id = " . $_SESSION['last_order'];

                        $result = $db->getResultsAssoc($select);
                        $total = 0;
                        while($row = $result->fetch()){
                            echo "<li class='list-group-item'>" . $row['product_name'] . " - amount: " . $row['product_amount_ordered'] . "</li>";
                            $total = $row['value'];
                        }
                        echo "<li class='list-group-item'>Total: " . $total . "</li>";
                    ?>
                    </ul>
            </div>

            <footer class="mt-auto text-white-50"></footer>
        </div>
    </body>
</html>
