<?php if (!empty($_SESSION['message'])) { ?>
    <div class="form-container-message" id="message">
        <?php echo $_SESSION['message']; ?>
    </div>
<?php } ?>