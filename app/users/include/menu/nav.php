<?php
/*
 *********************************************************************************************************
 * daloRADIUS - RADIUS Web Platform
 * Copyright (C) 2007 - Liran Tal <liran@lirantal.com> All Rights Reserved.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *
 *********************************************************************************************************
 *
 * Authors:    Liran Tal <liran@lirantal.com>
 *             Filippo Lauria <filippo.lauria@iit.cnr.it>
 *
 *********************************************************************************************************
 */

// prevent this file to be directly accessed
if (strpos($_SERVER['PHP_SELF'], '/include/menu/nav.php') !== false) {
    header("Location: ../../index.php");
    exit;
}

$nav = array(
                "home"   => array( 'Home', 'index.php', ),
                "pref" => array( 'Preferences', 'pref-main.php', ),
                "acct"   => array( 'Accounting', 'acct-main.php', ),
                "bill"   => array( 'Billing', 'bill-main.php', ),
                "graphs" => array( 'Graphs', 'graphs-main.php', ),
                "help" => array( 'Help', 'help-main.php', ),
            );

// detect category from the PHP_SELF name
$basename = basename($_SERVER['PHP_SELF']);
$detect_category = substr($basename, 0, strpos($basename, '-'));
if (!in_array($detect_category, array_keys($nav))) {
    $detect_category = "home";
}

?>



<!-- Custom Inline Navbar -->
<style>
.custom-navbar {
    background-color: #2c3e50;
    padding: 10px 0;
    text-align: center;
    font-family: Arial, sans-serif;
}

.custom-navbar a {
    color: #ecf0f1;
    text-decoration: none;
    padding: 10px 20px;
    margin: 0 8px;
    display: inline-block;
    border-radius: 5px;
    transition: all 0.3s ease;
    font-size: 16px;
}

.custom-navbar a:hover {
    background-color: #34495e;
    color: #ffffff;
}

.custom-navbar a.active {
    background-color: #1abc9c;
    color: #ffffff;
}
</style>

<div class="custom-navbar">
    <a href="http://192.168.102.78:8000/home-main.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'home-main.php') ? 'active' : ''; ?>">Radius Server</a>
    <a href="http://192.168.102.78:9000/open.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'open.php') ? 'active' : ''; ?>">Create Ticket</a>
    <a href="http://192.168.102.78:9000/scp/login.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'solve.php') ? 'active' : ''; ?>">Solve</a>
</div>

<!-- Custom Navbar -->


<header class="border-bottom">
    <div class="row p-2">
        <div class="d-flex align-items-center justify-content-center justify-content-lg-start">
            <a href="index.php" class="d-flex align-items-center mb-1 mb-lg-0 text-dark text-decoration-none">
                <img src="static/images/daloradius_small.png">
            </a>

            <ul class="nav col-12 col-lg-auto mx-2 me-lg-auto mb-1 justify-content-center mb-md-0">
<?php
                foreach ($nav as $category => $arr) {
                    list($label, $href) = $arr;

                    $class = ($detect_category === $category) ? 'link-active' : 'link-dark';
                    $label = htmlspecialchars(strip_tags(trim(t('menu', $label))), ENT_QUOTES, 'UTF-8');

                    printf('<li><a class="nav-link px-2 %s" href="%s">%s</a></li>', $class, urlencode($href), $label);
                }
?>
            </ul>

            <div class="dropdown text-end dropstart">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i>
                </a>

                <ul class="dropdown-menu text-small">
                    <li>
                        <span class="dropdown-item">
                            Welcome, <strong><?= htmlspecialchars($_SESSION['login_user'], ENT_QUOTES, 'UTF-8') ?></strong>
                        </span>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                </ul>
            </div><!-- -dropdown text-end -->
        </div>
    </div><!-- .container -->
</header>
