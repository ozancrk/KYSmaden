<div class="page-content">
	<div class="container-fluid">

		<!-- start page title -->
		<div class="row">
			<div class="col-12">
				<div class="page-title-box d-sm-flex align-items-center justify-content-between">
					<h4 class="mb-sm-0">Editör Ekle</h4>

					<div class="page-title-right">
						<ol class="breadcrumb m-0">
							<li class="breadcrumb-item"><a href="javascript: void(0);">Editörler</a></li>
							<li class="breadcrumb-item active">Editör Ekle</li>
						</ol>
					</div>

				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<div class="card">
					<div class="card-header align-items-center d-flex">
						<h4 class="card-title mb-0 flex-grow-1">Yeni Editör Bilgileri</h4>
					</div><!-- end card header -->
					<div class="card-body">
						<?php echo createForm( array(
							'id'       => 'serialize',
							'buttonText'       => 'Kaydet',
							'elements' => array(
								array(
									'type'        => 'text',
									'name'        => 'gorev',
									'label'       => 'Unvanı',
									'placeholder' => 'Unvanı',
									'required' => true,
								),
								array(
									'type'        => 'text',
									'name'        => 'name',
									'label'       => 'Adı Soyadı',
									'placeholder' => 'Adı Soyadı',
									'required' => true,
								),
								array(
									'type'  => 'email',
									'name'  => 'userEmail',
									'label' => 'Email',
									'placeholder' => 'Email',
									'required' => true,
								),
								array(
									'type'  => 'text',
									'name'  => 'GSM',
									'label' => 'Telefon',
									'placeholder' => 'Telefon',
									'required' => true,
								),
								array(
									'type'  => 'text',
									'name'  => 'uzmanlık',
									'label' => 'Uzmanlık Alanı',
									'placeholder' => 'Uzmanlık Alanı',
									'required' => true,
								),
								array(
									'type'  => 'text',
									'name'  => 'kurum',
									'label' => 'Kurum',
									'placeholder' => 'Kurum',
									'required' => true,
								),
								array(
									'type'  => 'select',
									'name'  => 'ulke',
									'label' => 'Ülke',
									'optionValue' => 'kod',
									'optionText'  => 'tr',
									'option'      => listUlke(),
									'required'    => true,
								),
                                array(
									'type'  => 'hidden',
									'name'  => 'userType',
									'value' => 'yazar',
								),
								array(
									'type'  => 'hidden',
									'name'  => 'postUrl',
									'value' => 'users/ekle',
								)
							)
						) );

						?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
