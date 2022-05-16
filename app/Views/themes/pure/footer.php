<div id="floatPanel">
	<div class="ctrlPanel">
		<a class="arrow" href="javascript:goToTop()"><span>顶部</span></a>
		<a class="arrow" href="javascript:goToBottom()"><span>底部</span></a>
	</div>
</div>

<div class="footer">
	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 copyright">
        <?php
        if (!empty($bottom_text)) {
            echo $bottom_text;
        }
        ?>
	</div>
</div>

<!--统计代码-->
<?php
if (!empty($statistic)) {
    echo $statistic;
}
?>
</div>
</body>

