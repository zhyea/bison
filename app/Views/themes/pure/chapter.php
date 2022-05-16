<script charset="utf-8" src="<?= $uriTheme ?>/js/reader.js" type="text/javascript"></script>

<div class="notice">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $siteUrl ?>">首页</a></li>
            <li class="breadcrumb-item"><a href="<?= $siteUrl ?>/c/<?= $w['cat_slug'] ?>.html"><?= $w['cat'] ?></a></li>
            <li class="breadcrumb-item"><a href="<?= $siteUrl ?>/work/<?= $w['id'] ?>.html#vol_$<?= $chp['volume_id'] ?>"><?= $w['name'] ?></a></li>
            <?php if (!empty($chp['volume_id']) && $chp['volume_id'] > 0) { ?>
                <li class="breadcrumb-item">
                    <a href="<?= $siteUrl ?>/work/<?= $w['id'] ?>.html#vol_<?= $chp['volume_id'] ?>"><?= $chp['volume'] ?></a>
                </li>
            <?php } ?>
            <li class="breadcrumb-item active"><?= $chp['name'] ?></li>
        </ol>
    </nav>
</div>

<div class="main chapter">
    <div class="row readerTools">
        <script type="text/javascript">
            if (system.win || system.mac || system.xll) {
                readerSet();
            }
        </script>
    </div>

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


        <script type="text/javascript">
            window.addEventListener('load', LoadReadSet, false);
        </script>

        <?php if (!empty($chapter_bottom_ad)) { ?>
            <div><?= $chapter_bottom_ad ?></div>
        <?php } ?>
    </div>

    <?php include_once 'comment.php'; ?>

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
</script>
