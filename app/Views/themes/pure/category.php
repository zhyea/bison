<div class="notice">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $siteUrl ?>/">首页</a></li>
            <li class="breadcrumb-item"><?= empty($cat) ? '不存在' : $cat['name'] ?></li>
        </ol>
    </nav>
</div>

<div class="gallery">
    <?php include_once 'recommend.php'; ?>
</div>

<div class="main">
    <?php if (!empty($cat)) { ?>
        <div class="page-header">
            <h3><a href="<?= $siteUrl ?>/c/<?= $cat['slug'] ?>.html">
                    <i class="glyphicon glyphicon-book"></i> <?= $cat['name'] ?>
                </a>
            </h3>
        </div>

        <?php include_once 'work-show.php'; ?>

        <div class="pagination">
            <a>共 <?= $total ?> 页</a>
            <?php for ($i = 1; $i <= $total; $i++) { ?>
                <a href="<?= $siteUrl ?>/c/<?= $cat['slug'] ?>/<?= $i ?>.html"
                   class="<?= ($page == $i ? 'active' : '') ?>"><?= $i ?></a>
            <?php } ?>
        </div>
    <?php } ?>
</div>
