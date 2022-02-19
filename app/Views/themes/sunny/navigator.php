<?php
function nav_of($item, $ctx)
{
    if ('custom' == $item['type']) {
        return $item['url'];
    }
    return $ctx . $item['url'];
}

?>


<div class="container header">
    <?php if (empty($logo)) { ?>
		<a>&nbsp;</a>
    <?php } else { ?>
		<a href="<?= $siteUrl ?>">
			<img src="<?= $uriUpload . '/' . $logo ?>" width="100%" height="100%"/></a>
    <?php } ?>
</div>
<div class="container navigator">
	<nav class="navbar navbar-default">
		<div class="navbar-header">
			<button type="button"
			        class="navbar-toggle collapsed"
			        data-toggle="collapse"
			        data-target="#navbar"
			        aria-controls="navbar"
			        aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?= $siteUrl ?>">
				<i class="glyphicon glyphicon-home"></i> <?= $site_name ?>
				<span class="sr-only">(current)</span>
			</a>
		</div>

		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
                <?php if (!empty($navigator)) {
                    foreach ($navigator as $n) {
                        if (!empty($n['children'])) { ?>
							<li class="dropdown">
								<a href="<?= $n['url'] ?>"
								   class="dropdown-toggle"
								   data-toggle="dropdown"
								   role="button"
								   aria-haspopup="true"
								   aria-expanded="false"><?= $n['name'] ?><span class="caret"></span></a>
								<ul class="dropdown-menu">
                                    <?php $children = $n['children'];
                                    foreach ($children as $c) { ?>
										<li>
											<a href="<?= nav_of($c, $siteUrl) ?>"><?= $c['name'] ?></a>
										</li>
                                    <?php } ?>
								</ul>
							</li>
                            <?php
                        } else {
                            ?>
							<li>
								<a href="<?= nav_of($n, $siteUrl) ?>"><?= $n['name'] ?></a>
							</li>
                        <?php }
                    }
                } ?>
			</ul>
		</div>
	</nav>
</div>
