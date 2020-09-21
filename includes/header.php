<?php 
    session_start();
?>

<header>
    <div id="menu">

        <div id="header-box">
            <!-- <a id="logo" href="index.php">Atelier à façon</a> -->
            <?php 
                if (isset($_SESSION['id'])) {
                    echo'
                        <div id="logout-box">
                            <i class="fas fa-check-circle"></i>
                            <p>Connecté</p>
                            <form action="includes/logout.inc.php" method="post">
                                <button type="submit" name="logout-submit">Deconnexion</button>
                            </form>
                        </div>';
                } else {
                    echo'
                        <div id="logout-box">
                            <i class="fas fa-circle"></i>
                            <p>Déconnecté</p>
                        </div>';
                }
            ?>
            <div id="navbar">
                <li><a class="btn-sidebar" href="index.php">Accueil</a></li>
                <li><a class="btn-sidebar" href="profil.php">Profil</a></li>
                <li><a class="btn-sidebar" href="atelier.php">Atelier</a></li>
                <li><a class="btn-sidebar" href="contact.php">Contact</a></li>
                <li><a class="btn-sidebar" href="register.php">Inscription</a></li>
                <li><a class="btn-sidebar" href="login.php">Connexion</a></li>
                <li><a class="btn-sidebar" href="admin.php">Admin</a></li>
            </div>
            <i id="menu-icon" class="fas fa-bars"></i>
        </div>

        <nav id="nav-sidebar">
            <ul>
                <li><a class="btn-sidebar" href="index.php">Accueil</a></li>
                <li><a class="btn-sidebar" href="profil.php">Profil</a></li>
                <li><a class="btn-sidebar" href="atelier.php">Atelier</a></li>
                <li><a class="btn-sidebar" href="contact.php">Contact</a></li>
                <li><a class="btn-sidebar" href="register.php">Inscription</a></li>
                <li><a class="btn-sidebar" href="login.php">Connexion</a></li>
                <li><a class="btn-sidebar" href="admin.php">Admin</a></li>
            </ul>
        </nav>

    </div>
</header>