<?php
include 'sidebar_data.php';
include 'header.php';
include 'sidebar.php';

echo '<body>
<div id="layout-wrapper">

    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box horizontal-logo">
                        <a href="index-2.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="view/panel/assets/images/logo-sm.png" alt="" height="22">
                        </span>
                            <span class="logo-lg">
                            <img src="view/panel/assets/images/logo-dark.png" alt="" height="17">
                        </span>
                        </a>

                        <a href="index-2.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="view/panel/assets/images/logo-sm.png" alt="" height="22">
                        </span>
                            <span class="logo-lg">
                            <img src="view/panel/assets/images/logo-light.png" alt="" height="17">
                        </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                            id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    </button>

                </div>

                <div class="d-flex align-items-center">

                    <div class="dropdown d-md-none topbar-head-dropdown header-item">
                        <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                            <i class="bx bx-search fs-22"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                             aria-labelledby="page-header-search-dropdown">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header><div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">';

$loginUserURL = ltrim( $URL, $URLParts[0] );

if ( empty( $loginUserURL ) ) {
	if ( $_SESSION['admin'] ) {
		include server_root_dir() . '/view/' . $scriptConfig['adminDIR'] . '/pages/admin/home.php';
	} elseif ( $_SESSION['editor'] ) {
		include server_root_dir() . '/view/' . $scriptConfig['adminDIR'] . '/pages/editor/home.php';
	} elseif ( $_SESSION['hakem'] ) {
		include server_root_dir() . '/view/' . $scriptConfig['adminDIR'] . '/pages/hakem/home.php';
	} elseif ( $_SESSION['yazar'] ) {
		include server_root_dir() . '/view/' . $scriptConfig['adminDIR'] . '/pages/yazar/home.php';
	}
} else {
echo $fileCommon;
	$fileCommon = server_root_dir() . '/view/' . $scriptConfig['adminDIR'] . '/pages/common/' . URLseperateGet( $loginUserURL ) . '.php';
	if ( ! file_exists( $fileCommon ) ) {
		include server_root_dir() . '/view/' . $scriptConfig['adminDIR'] . '/404.php';
	} else {
		include $fileCommon;
	}

}


echo '<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <span><script>document.write(new Date().getFullYear())</script>
                © <a href="https://bredimedia.com" target="_blank">Bredimedia</a> & Maden Mühendisleri Odası</span>
            </div>
           
        </div>
    </div>
</footer>
</div>
<!-- end main content-->

</div>
<!-- JAVASCRIPT -->';

include 'footer.php';
