<?php
function nav_of($item, $ctx)
{
    if ('custom' == $item['type']) {
        return $item['url'];
    }
    return $ctx . $item['url'];
}
?>


<div class="header">
    <?php if (empty($logo)) { ?>
		<a>&nbsp;</a>
    <?php } else { ?>
		<a href="<?= $siteUrl ?>">
			<img src="<?= $uriUpload . '/' . $logo ?>" width="100%" height="100%"/></a>
    <?php } ?>
</div>
<div class="navigator">
	<nav class="navbar navbar-expand-md navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?= $siteUrl ?>">
				<img src="<?= $uriTheme ?>/imgs/home.png" height="18" width="21"/>&nbsp;<?= $siteName ?>
			</a>
			<button aria-controls="navbarNavDropdown"
			        aria-expanded="false"
			        aria-label="Toggle navigation"
			        class="navbar-toggler"
			        data-bs-target="#navbarNavDropdown"
			        data-bs-toggle="collapse"
			        type="button">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav">
                    <?php if (!empty($navigator)) {
                        foreach ($navigator as $n) {
                            if (!empty($n['children'])) { ?>
								<li class="nav-item dropdown">
									<a aria-expanded="false"
									   class="nav-link dropdown-toggle"
									   data-bs-toggle="dropdown"
									   href="<?= $n['url'] ?>"
									   id="navbarDropdownMenuLink"
									   role="button"><?= $n['name'] ?></a>
									<ul aria-labelledby="navbarDropdownMenuLink" class="dropdown-menu">
                                        <?php $children = $n['children'];
                                        foreach ($children as $c) { ?>
											<li><a class="dropdown-item" href="<?= nav_of($c, $siteUrl) ?>"><?= $c['name'] ?></a></li>
                                        <?php } ?>
									</ul>
								</li>
                            <?php } else { ?>
								<li class="nav-item"><a class="nav-link" href="<?= nav_of($n, $siteUrl) ?>"><?= $n['name'] ?></a></li>
                            <?php }
                        }
                    } ?>
				</ul>
			</div>
		</div>
	</nav>
</div>
