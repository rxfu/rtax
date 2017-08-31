<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0">
            <a href="{{ route('home') }}" class="site_title">
                <i class="fa fa-paw"></i> <span>{{ config('setting.slug') }}</span>
            </a>
        </div>

        <div class="clearfix"></div>

        <!-- Menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ asset('images/user.png') }}" alt="{{ Auth::user()->name }}" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>欢迎回来，</span>
                <h2>{{ Auth::user()->name }}</h2>
            </div>
        </div>
        <!-- /Menu profile quick info -->

        <br>

        <!-- Sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden_print main_menu">
            <!-- Menu section -->
            <div class="menu_section">
                <h3>资源税管理</h3>
                <ul class="nav side-menu">
                    <li>
                        <a>
                            <i class="fa fa-money"></i> 资源税风险管理 <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ route('tax.list') }}">评估项目列表</a>
                            </li>
                            <li>
                                <a href="{{ route('tax.create') }}">新增使用资源明细</a>
                            </li>
                            <li>
                                <a href="{{ route('paid.create') }}">新增资源税管理证明</a>
                            </li>
                            <li>
                                <a href="{{ route('declaration.create') }}">新增自行申报税</a>
                            </li>
                            <li>
                                <a href="{{ route('tax.search') }}">成果查询</a>
                            </li>
                            <li>
                                <a href="#">统计分析</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav side-menu">
                    <li>
                        <a>
                            <i class="fa fa-road"></i> 完工进度管理 <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ route('completion.list') }}">完工进度列表</a>
                            </li>
                            <li>
                                <a href="{{ route('completion.create') }}">新增完工进度</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                @if (Auth::user()->is_admin)
                <ul class="nav side-menu">
                    <li>
                        <a>
                            <i class="fa fa-road"></i> 标段管理 <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ route('project.list') }}">标段列表</a>
                            </li>
                            <li>
                                <a href="{{ route('project.create') }}">新增标段</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav side-menu">
                    <li>
                        <a>
                            <i class="fa fa-user"></i> 税率管理 <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ route('rate.list') }}">税率列表</a>
                            </li>
                            <li>
                                <a href="{{ route('rate.create') }}">新增税率</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav side-menu">
                    <li>
                        <a>
                            <i class="fa fa-file"></i> 政策管理 <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ route('policy.list') }}">政策列表</a>
                            </li>
                            <li>
                                <a href="{{ route('policy.create') }}">新增政策</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endif
            </div>
            <!-- /Menu section -->

            <!-- Menu section -->
            <div class="menu_section">
                <h3>系统管理</h3>
                @if (Auth::user()->is_admin)
                <ul class="nav side-menu">
                    <li>
                        <a>
                            <i class="fa fa-user"></i> 用户管理 <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ route('user.list') }}">用户列表</a>
                            </li>
                            <li>
                                <a href="{{ route('user.create') }}">新增用户</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endif
                <ul class="nav side-menu">
                    <li>
                        <a>
                            <i class="fa fa-cog"></i> 系统管理 <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ route('user.chgpwd') }}">修改密码</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav side-menu">
                    <li>
                        <a href="{{ route('home') }}">
                            <i class="fa fa-home"></i> 政策文件
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /Menu section -->
        </div>
        <!-- /Sidebar menu -->

        <!-- Menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a href="#" data-toggle="tooltip" data-placement="top" title="设置">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a href="#" data-toggle="tooltip" data-placement="top" title="全屏">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a href="#" data-toggle="tooltip" data-placement="top" title="锁定">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a href="{{ route('logout') }}" data-toggle="tooltip" data-placement="top" title="登出">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /Menu footer buttons -->
    </div>
</div>