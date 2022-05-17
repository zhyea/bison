<?php

/**
 * 输出图标
 * @param string $iconName 图标名称
 * @param string $color 颜色
 */
function iconSvg(string $iconName, string $color)
{
    ?>
    <svg class="bi-icon icon-<?= $iconName ?>" fill="<?= $color ?>">
        <use xlink:href="/themes/pure/imgs/symbols.svg#<?= $iconName ?>"/>
    </svg>
    <?php
}


/**
 * 输出图标和标题
 * @param string $iconName 图标名称
 * @param string $color 颜色
 * @param string $title 标题
 */
function iconTitle(string $iconName, string $color, string $title)
{
    ?>
    <svg class="bi-icon icon-<?= $iconName ?>" fill="<?= $color ?>">
        <use xlink:href="/themes/pure/imgs/symbols.svg#<?= $iconName ?>"/>
    </svg>
    <?= $title ?>
    <?php
}

