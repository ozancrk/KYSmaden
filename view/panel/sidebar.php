<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index-2.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="view/panel/assets/images/logo-sm.png" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="view/panel/assets/images/logo-dark.png" alt="" height="17">
                    </span>
        </a>
        <!-- Light Logo-->
        <a href="index-2.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="view/panel/assets/images/logo-sm.png" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="view/panel/assets/images/logo-light.png" alt="" height="17">
                    </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar" data-simplebar="init" class="h-100">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region"
                         aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                        <div class="simplebar-content" style="padding: 0px;">
                            <div class="container-fluid">

                                <div id="two-column-menu">
                                </div>
                                <ul class="navbar-nav" id="navbar-nav" data-simplebar="init">
                                    <div class="simplebar-wrapper" style="margin: 0px;">
                                        <div class="simplebar-height-auto-observer-wrapper">
                                            <div class="simplebar-height-auto-observer"></div>
                                        </div>
                                        <div class="simplebar-mask">
                                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                     aria-label="scrollable content"
                                                     style="height: auto; overflow: hidden;">
                                                    <div class="simplebar-content" style="padding: 0px;">
                                                        <li class="nav-item">
                                                            <a class="nav-link menu-link" href="/panel">
                                                                <i class="la la-home"></i>
                                                                <span data-key="t-widgets">Anasayfa</span>
                                                            </a>
                                                        </li>

                                                        <?php

                                                        if ( $_SESSION['admin'] ) {
	                                                        sidebarCreate( 'admin' );
                                                        }
                                                        if ( $_SESSION['editor'] ) {
	                                                        sidebarCreate( 'editor' );
                                                        }
                                                        if ( $_SESSION['hakem'] ) {
	                                                        sidebarCreate( 'hakem' );
                                                        }
                                                        if ( $_SESSION['yazar'] ) {
	                                                        sidebarCreate( 'yazar' );
                                                        }


                                                        ?>

                                                        <li class="nav-item">
                                                            <a class="nav-link menu-link" href="/logout">
                                                                <i data-feather="log-out"></i>
                                                                <span data-key="t-widgets">ÇIKIŞ</span>
                                                            </a>
                                                        </li>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="simplebar-placeholder"
                                             style="width: 249px; height: 1209px;">
                                        </div>
                                    </div>
                                    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                    </div>
                                    <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                        <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                                    </div>
                                </ul>
                            </div>
                            <!-- Sidebar -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 1209px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
            <div class="simplebar-scrollbar"
                 style="height: 491px; display: block; transform: translate3d(0px, 0px, 0px);"></div>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>
