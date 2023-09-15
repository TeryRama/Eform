
<?php echo $_topbar;?>

<!-- Sidebar -->
<?php echo $_sidebar;?>

<!-- Page content -->
<div class="container" style="padding-top: 0px">

    <?php echo $_content;?>
    <?php echo $_js;?>
    <?php // echo $_footer;?>
</div>

<script type="text/javascript">    
$(document).ready(function() {
    $('[data-toggle=offcanvas]').click(function() {
    $('.row-offcanvas').toggleClass('active');
  });
});
</script>

</body>
</html>



