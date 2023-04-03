    <footer>
        <div class="session_status">
        <?php 
        if(session_status() === PHP_SESSION_ACTIVE) {
            if ($_SESSION['personneconnectee']->getRole()->getId() === 1) {
                echo '🟢';
            } else {
                echo '🔵';
            }
        }
        if(session_status() === PHP_SESSION_NONE) echo '🔴';
        ?>
        </div>
        <?php
        if (isset($_SESSION['personneconnectee'])) {
        echo $_SESSION['personneconnectee']->getRole()->getId();
        }
        ?>
        <p>© 2023 - Ludo SNTS</p>
    </footer>

    <script  src="./JS/main.js"> </script>
</body>


</html>