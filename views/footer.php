
        <!-- jQuery -->
        <script src="js/jquery.1.12.0.min.js"></script>

        <script src="js/bootstrap.min.js"></script>

        <script src="js/plugins/jbox.min.js"></script>
        <script src="js/plugins/tablesorter.min.js"></script>
        <script src="plugins/sweetAlert2/sweetalert2.min.js"></script>
        <script src="plugins/sweetBox/sweetBox.js"></script>
        <script src="js/plugins/spinner.js"></script>

        <script src="js/functions.js"></script>
        <script src="js/app.js"></script>

        <?php foreach($this->jsFiles as $jsFile): ?>
        <script src="<?php echo $jsFile; ?>"></script>
        <?php endforeach; ?>

	</body>
</html>