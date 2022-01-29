<nav class="page-navigation">
    <div class="container navigator">
        <nav class="navbar navbar-inverse">
            <button type="button"
                    class="navbar-toggle collapsed"
                    data-toggle="collapse"
                    data-target="#main-nav-items"
                    aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div class="navbar-header">
                <a class="navbar-brand" href="<?= $ctx ?>admin">
                    <img alt="Calf Console" src="<?= $uri_admin ?>/static/img/logo-white.png" height="100%"/>
                </a>
            </div>

            <ul class="nav navbar-nav navbar-left" id="main-nav-items">
                <li class="dropdown">
                    <a href="#"
                       class="dropdown-toggle"
                       data-toggle="dropdown"
                       role="button"
                       aria-haspopup="true"
                       aria-expanded="false"><i class="glyphicon glyphicon-dashboard"></i> 控制台<span
                                class="caret"></span></a>
                    <ul class="dropdown-menu navbar-child">
                        <li class="navbar-child-item"><a href="<?= $ctx ?>admin/settings">网站设置</a></li>
                        <li class="navbar-child-item"><a href="<?= $ctx ?>admin/spt/list">脚本设置</a></li>
                        <li class="navbar-child-item"><a href="<?= $ctx ?>admin/nav/list">导航设置</a></li>
                        <li class="navbar-child-item"><a href="<?= $ctx ?>admin/cache">缓存管理</a></li>
                        <li class="navbar-child-item"><a href="<?= $ctx ?>admin/sitemap">网站地图</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#"
                       class="dropdown-toggle"
                       data-toggle="dropdown"
                       role="button"
                       aria-haspopup="true"
                       aria-expanded="false"><i class="glyphicon glyphicon-th-large"></i> 管理<span
                                class="caret"></span></a>
                    <ul class="dropdown-menu navbar-child">
                        <li class="navbar-child-item"><a href="<?= $ctx ?>admin/feature/list">专题管理</a></li>
                        <li class="navbar-child-item"><a href="<?= $ctx ?>admin/author/list">作者管理</a></li>
                        <li class="navbar-child-item"><a href="<?= $ctx ?>admin/work/list">作品管理</a></li>
                        <li class="navbar-child-item"><a href="<?= $ctx ?>admin/category/list">分类管理</a></li>
                        <li class="navbar-child-item"><a href="<?= $ctx ?>admin/user/list">用户管理</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#"
                       class="dropdown-toggle"
                       data-toggle="dropdown"
                       role="button"
                       aria-haspopup="true"
                       aria-expanded="false"><i class="glyphicon glyphicon-pencil"></i> 撰写<span
                                class="caret"></span></a>
                    <ul class="dropdown-menu navbar-child">
                        <li class="navbar-child-item"><a href="<?= $ctx ?>admin/remote/gen">远程写</a></li>
                    </ul>
                </li>
            </ul>


            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= $ctx ?>">
                        <i class="glyphicon glyphicon-home"></i> <?= empty($site_name) ? 'Test' : $site_name ?></a>
                </li>
                <li><a href="<?= $ctx ?>logout"><span class="glyphicon glyphicon-off"></span> 登出</a>
                </li>
            </ul>
        </nav>
    </div>
</nav>
