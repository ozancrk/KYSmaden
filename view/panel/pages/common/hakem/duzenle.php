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
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div>
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


												<?php foreach ( $userMeta as $key => $value ):

													if ( ! keyDetails( $key )[ $_SESSION['lang'] ] ) {
														continue;
													}

													?>

                                                    <tr>
                                                        <th class="ps-0"
                                                            scope="row"><?= keyDetails( $key )[ $_SESSION['lang'] ] ?></th>
                                                        <td class="text-muted"><?= $value ?></td>
                                                    </tr>

												<?php endforeach; ?>

                                                <tr>
                                                    <th class="ps-0" scope="row">Şifre:</th>
                                                    <td class="text-muted"><?= base64_decode( $userMeta['passbase64'] ) ?></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div>
                            <div class="col-md-4">
								<?php include server_root_dir() . '/view/' . $scriptConfig['adminDIR'] . '/pages/permissionChmod.php' ?>
                            </div>
                            <div class="col-md-4">
								<?php if ( $_SESSION['admin'] ): ?>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Şifre Değiştir</h5>
	                                    <?php echo createForm( array(
		                                    'id'       => 'serialize',
		                                    'buttonText'       => 'Kaydet',
		                                    'elements' => array(
			                                    array(
				                                    'type'        => 'password',
				                                    'name'        => 'password',
				                                    'label'       => 'Yeni Şifre',
				                                    'placeholder' => 'Yeni Şifre',
				                                    'required' => true,
			                                    ),
			                                    array(
				                                    'type'  => 'hidden',
				                                    'name'  => 'userID',
				                                    'value' => $_GET['userID'],
			                                    ),
			                                    array(
				                                    'type'  => 'hidden',
				                                    'name'  => 'postUrl',
				                                    'value' => 'users/passwordChance',
			                                    )
		                                    )
	                                    ) );

	                                    ?>
                                    </div>
                                </div>
                            </div>
							<?php endif; ?>
                        </div>
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
