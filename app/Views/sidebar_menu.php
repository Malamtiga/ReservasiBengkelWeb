    <!-- start: sidebar -->
    <aside id="sidebar-left" class="sidebar-left">

        <div class="sidebar-header">
            <div class="sidebar-title">
                Navigation
            </div>
            <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>

        <div class="nano">
            <div class="nano-content">
                <nav id="menu" class="nav-main" role="navigation">
                    <ul class="nav nav-main">

                        <li class="nav-active">
                            <a href="<?= base_url() ?>Dashboard">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>


                        <li class="nav-parent">
                            <a>
                                <i class="fa fa-copy" aria-hidden="true"></i>
                                <span>Pos Artikel</span>
                            </a>
                            <ul class="nav nav-children">
                                <li>
                                    <a href="#">
                                        Data Artikel
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Kategori Artikel
                                    </a>
                                </li>

                            </ul>
                        </li>



                        <li class="nav-parent">
                            <a>
                                <i class="fa fa-tasks" aria-hidden="true"></i>
                                <span>Gallery</span>
                            </a>

                            <ul class="nav nav-children">
                                <li>
                                    <a href="#">
                                        images
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        video
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-parent">
                            <a>
                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                                <span>Inbox</span>
                            </a>
                            <ul class="nav nav-children">
                                <li>
                                    <a href="#">
                                        Data Inbox
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-parent">
                            <a>
                                <i class="fa fa-table" aria-hidden="true"></i>
                                <span>Data User</span>
                            </a>
                            <ul class="nav nav-children">
                                <li>
                                    <a href="<?= base_url() ?>user">
                                        Data User
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li>
                            <a href="<?= base_url() ?>Dashboard">
                                <i class="fa fa-power-off" aria-hidden="true"></i>
                                <span>Keluar</span>
                            </a>
                        </li>


                    </ul>
                </nav>





            </div>

        </div>

    </aside>
    <!-- end: sidebar -->