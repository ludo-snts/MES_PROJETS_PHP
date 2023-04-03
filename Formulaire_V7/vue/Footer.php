    <footer>
        
        <div class="session_status">
        <?php
        echo '| '.$_SESSION['currentpage'].' |'
        ?>
        <?php 
        if( isset($_SESSION['personneconnectee']) ) {
            if ($_SESSION['personneconnectee']->getRole()->getId() === 1) {
                echo '🟢';
            } else {
                echo '🔵';
            }
        }
        else echo '🔴';
        ?>
        </div>
        <p>© 2023 - Ludo SNTS</p>
        
    </footer>

    <script  src="./JS/main.js"> </script>
</body>


</html>