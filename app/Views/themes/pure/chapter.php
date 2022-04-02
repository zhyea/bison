

<div class="container notice">
	<ol class="breadcrumb">
		<li><a href="<?= $siteUrl ?>/"><i class="glyphicon glyphicon-folder-open">&nbsp;首页</i></a></li>
		<li><a href="<?= $siteUrl ?>/c/<?= $w['cat_slug'] ?>.html"><?= $w['cat'] ?></a></li>
		<li><a href="<?= $siteUrl ?>/work/<?= $w['id'] ?>.html#vol_$<?= $chp['volume_id'] ?>"><?= $w['name'] ?></a></li>
        <?php if (!empty($chp['volume_id']) && $chp['volume_id'] > 0) { ?>
			<li>
				<a href="<?= $siteUrl ?>/work/<?= $w['id'] ?>.html#vol_<?= $chp['volume_id'] ?>"><?= $chp['volume'] ?></a>
			</li>
        <?php } ?>
		<li class="active"><?= $chp['name'] ?></li>
	</ol>
</div>

<div class="main">
	
	<div class="row" id="contentContainer">
		
		<div class="row chapter-name"><?= $chp['name'] ?></div>
		
		<div class="row chapter-nav">
            <?php if (!empty($last)) { ?>
				<a href="<?= $siteUrl ?>/chapter/<?= $last ?>.html">上一章</a>
            <?php } else { ?>
				<a>无</a>
            <?php } ?>
			←
			<a href="<?= $siteUrl ?>/work/<?= $w['id'] ?>.html#vol_<?= $chp['volume_id'] ?>">返回目录</a>
			→

            <?php if (!empty($next)) { ?>
				<a href="<?= $siteUrl ?>/chapter/<?= $next ?>.html">下一章</a>
            <?php } else { ?>
				<a>没有了</a>
            <?php } ?>
			
			<span class="chapter-author">作者：<a href="<?= $siteUrl ?>/author/<?= $w['author_id'] ?>.html"><?= $w['author'] ?></a></span>
		</div>

        <?php if (!empty($chapter_top_ad)) { ?>
			<div><?= $chapter_top_ad ?></div>
        <?php } ?>
		
		<div class="row chapter-content" id="contentText" style=""><?= $chp['content'] ?></div>
		
		<div class="row chapter-nav">
            <?php if (!empty($last)) { ?>
				<a href="<?= $siteUrl ?>/chapter/<?= $last ?>.html">上一章</a>
            <?php } else { ?>
				<a>无</a>
            <?php } ?>
			←
			<a href="<?= $siteUrl ?>/work/<?= $w['id'] ?>.html#vol_<?= $chp['volume_id'] ?>">返回目录</a>
			→

            <?php if (!empty($next)) { ?>
				<a href="<?= $siteUrl ?>/chapter/<?= $next ?>.html">下一章</a>
            <?php } else { ?>
				<a>没有了</a>
            <?php } ?>
		</div>

        <?php if (!empty($chapter_bottom_ad)) { ?>
			<div><?= $chapter_bottom_ad ?></div>
        <?php } ?>
        <?php if (!empty($third_party_comments)) { ?>
			<div><?= $third_party_comments ?></div>
        <?php } ?>
	</div>

</div>

<script type="text/javascript">

    <?php if(!empty($last)){ ?>
    let lastPage = "<?=$siteUrl?>/chapter/<?=$last?>.html";
    <?php   }else{?>
    let lastPage = "<?= $siteUrl ?>/work/<?= $w['id'] ?>.html";
    <?php }?>

    <?php if(!empty($next)){ ?>
    let nextPage = "<?=$siteUrl?>/chapter/<?=$next?>.html";
    <?php   }else{?>
    let nextPage = "<?= $siteUrl ?>/work/<?= $w['id'] ?>.html";
    <?php }?>

    document.onkeydown = function (evt) {
        let e = window.event || evt;
        if (e.keyCode === 37) location.href = lastPage;
        if (e.keyCode === 39) location.href = nextPage;
    };

    backToTop();
</script>
