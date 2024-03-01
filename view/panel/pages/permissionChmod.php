<div class="card">
    <div class="card-body">
        <h5 class="card-title mb-3">Yetki Değiştir</h5>
		<?php echo createForm( array(
			'id'         => 'serialize',
			'buttonText' => 'Kaydet',
			'elements'   => array(
				array(
					'type'  => 'checkbox',
					'name'  => 'editor',
					'id'    => 'editor',
					'label' => 'Editör',
					'value' => $userMeta['editor'],
				),
				array(
					'type'  => 'checkbox',
					'id'    => 'hakem',
					'name'  => 'hakem',
					'label' => 'Hakem',
					'value' => $userMeta['hakem'],
				),
				array(
					'type'  => 'checkbox',
					'id'    => 'yazar',
					'name'  => 'yazar',
					'label' => 'Yazar',
					'value' => $userMeta['yazar'],
				),
				array(
					'type'  => 'checkbox',
					'id'    => 'admin',
					'name'  => 'admin',
					'label' => 'Admin',
					'value' => $userMeta['admin'],
				),
				array(
					'type'  => 'hidden',
					'name'  => 'userID',
					'value' => $_GET['userID'],
				),
				array(
					'type'  => 'hidden',
					'name'  => 'postUrl',
					'value' => 'users/chmod',
				)
			)
		) );

		?>


    </div><!-- end card body -->
</div><!-- end card -->
