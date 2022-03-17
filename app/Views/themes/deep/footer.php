<?php
?>

<div class="container footer">
	<div class="col-md-12 col-xs-12 copyright">
        <?php
        if (!empty($bottom_text)) {
            echo $bottom_text;
        }
        ?>
	</div>
</div>

<script src="<?= $uriTheme ?>/js/bootstrap.min.js"></script>

<!--统计代码-->
<?php
if (!empty($statistic)) {
    echo $statistic;
}
?>
</div>
</body>

