<header>
            <div class="container_12">
                <div class="grid_12">
                    <div class="menu_block">
                        <nav class="horizontal-nav full-width horizontalNav-notprocessed">
                            <ul class="sf-menu">
                                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true): ?><li><a href="dashboard.php">Home</a></li>
                                <?php else: ?>
                                <li>
                                <a href="../index.php">Home</a>
                                </li>
                                <?php endif; ?>
                                
                                <!-- <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true): ?><li><a href="../gallery.php">Gallery</a></li>
                                <?php else: ?>
                                <li>
                                <a href="gallery.php">Gallery</a>
                                </li>
                                <?php endif; ?> -->
                                
                                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true): ?><li>
                                <a href="../logout.php">Logout</a></li>
                                <?php else: ?>
                                <li>
                                <a href="../login.php">Login/Register</a>
                                </li>
                                <?php endif; ?>
                                
                                <li  style= "float:right; padding-top: 20px; color:#000300; width:300px "> &nbsp;Welcome<span style="text-transform:lowercase;"> 
                                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true): echo $_SESSION['username'].' !'; ?>
                                </span>
                                <?php else: echo "GUEST !"; ?>
                                <?php endif; ?>   
                                </li>
                                
                                
                            </ul>
                        </nav>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="grid_12">
                    <h1>
                        <a href="#">
                            
                        </a>
                    </h1>
                </div>
            </div>
        </header>