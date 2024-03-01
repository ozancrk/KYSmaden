<?php

$userMeta = getUserMeta( $_GET['userID'] );

?>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Kullanıcı Bilgileri</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kullanıcılar</a></li>
                            <li class="breadcrumb-item active">Kullanıcı Bilgileri</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

		<?php if ( ! $userMeta ){ ?>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Hatalı Kullanıcı ID'si</h4>
                        </div><!-- end card header -->
                    </div>
                </div>
            </div>
		<?php }else{ ?>

        <div class="profile-foreground position-relative mx-n4 mt-n4">
            <div class="profile-wid-bg">

            </div>
        </div>
        <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
            <div class="row g-4">
                <div class="col-auto">
                    <div class="avatar-lg">
						<?php if ( isset( $userMeta['fileID'] ) and ! empty( $userMeta['fileID'] ) ): ?>
                            <img src="<?= fileMeta( $userMeta['fileID'], 'url' ) ?>" alt="user-img"
                                 class="img-fluid mb-4"/>
						<?php endif; ?>
                        <h3 class="text-white mb-1 text-center mt-4"><?= $userMeta['name'] ?></h3>

                    </div>
                </div>
                <!--end col-->
                <div class="col">
                    <div class="p-2">

                    </div>
                </div>
            </div>
            <!--end col-->

            <!--end col-->

        </div>
        <!--end row-->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div>
                <div class="d-flex">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span
                                        class="d-none d-md-inline-block">Genel Görünüm</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#documents" role="tab">
                                <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span
                                        class="d-none d-md-inline-block">Dokümanlar</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#request" role="tab">
                                <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span
                                        class="d-none d-md-inline-block">Talep Oluştur</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Tab panes -->
                <div class="tab-content pt-4 text-muted">
                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-md-3">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Bilgi</h5>
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                <tr>
                                                    <th class="ps-0" scope="row">Unvan / Görev: :</th>
                                                    <td class="text-muted"><?= $userMeta['gorev'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Adı Soyadı:</th>
                                                    <td class="text-muted"><?= $userMeta['name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">E-Posta:</th>
                                                    <td class="text-muted"><?= $userMeta['username'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">GSM:</th>
                                                    <td class="text-muted"><?= $userMeta['GSM'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Ülke:</th>
                                                    <td class="text-muted"><?= $userMeta['ulke'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Dil:</th>
                                                    <td class="text-muted"><?= $userMeta['lang'] ?></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div>
                            <div class="col-md-3">
                                <?php include '../permissionChmod.php'?>
                            </div>

                            <!--end col-->

                            <!--end col-->
                        </div>
                    </div>
                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end col-->
    </div>

	<?php } ?>
</div>
</div>
