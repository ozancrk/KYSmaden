<?php

$menu = array(
	'admin'  => array(
		array(
			'name'     => array( 'tr' => 'ADMİN MENÜSÜ', 'en' => 'Paper Manage' ),
			'dropdown' => false,
			'type'     => 'title',
		),
		array(
			'name'     => array( 'tr' => 'Bildiri Yönetimi', 'en' => 'Paper Manage' ),
			'dropdown' => false,
			'type'     => 'title',
		),
		array(
			'name'     => array( 'tr' => 'Kullanıcılar', 'en' => 'Users' ),
			'icon'     => '<i class="la la-user"></i>',
			'dropdown' => true,
			'SUB'      => array(

				array(
					'name'     => array( 'tr' => 'Hakemler', 'en' => 'Referees' ),
					'dropdown' => false,
					'URL'      => 'hakem/list'
				),
				array(
					'name'     => array( 'tr' => 'Editörler', 'en' => 'Editors' ),
					'dropdown' => false,
					'URL'      => 'editor/list'
				),
				array(
					'name'     => array( 'tr' => 'Yazarlar', 'en' => 'Writers' ),
					'dropdown' => false,
					'URL'      => 'yazar/list'
				)
			)
		),
		array(
			'name'     => array( 'tr' => 'Bildiriler', 'en' => 'Papers & Abstract' ),
			'icon'     => '<i class="la la-user"></i>',
			'dropdown' => true,
			'SUB'      => array(

				array(
					'name'     => array( 'tr' => 'Tüm Bildiriler', 'en' => 'All Papers & Abstract' ),
					'dropdown' => false,
					'URL'      => 'bildiri/list'
				),
			)
		),
		array(
			'name'     => array( 'tr' => 'Kongre Yönetimi', 'en' => 'Congress Manage' ),
			'dropdown' => false,
			'type'     => 'title',
		),
		array(
			'name'     => array( 'tr' => 'Kongre', 'en' => 'Congress' ),
			'icon'     => '<i class="la la-calendar"></i>',
			'dropdown' => true,
			'SUB'      => array(
				array(
					'name'     => array( 'tr' => 'Delegeler', 'en' => 'Delegates' ),
					'dropdown' => false,
					'URL'      => 'delege/list'
				),
				array(
					'name'     => array( 'tr' => 'Oteller', 'en' => 'Hotels' ),
					'dropdown' => false,
					'URL'      => 'otel/otel-main'
				),
				array(
					'name'     => array( 'tr' => 'Kongre Programı', 'en' => 'Congress Program' ),
					'dropdown' => false,
					'URL'      => 'sergi/sergi-main'
				),
				array(
					'name'     => array( 'tr' => 'Yürütme Kurulu', 'en' => 'Chairs of Symposium' ),
					'dropdown' => false,
					'URL'      => 'yurutme/yurutme-main'
				),
			)
		),
		array(
			'name'     => array( 'tr' => 'Ürünler ve Sponsorlar', 'en' => 'Products and Sponsors' ),
			'icon'     => '<i class="la la-calendar"></i>',
			'dropdown' => true,
			'SUB'      => array(
				array(
					'name'     => array( 'tr' => 'Sponsorlar', 'en' => 'Sponsors' ),
					'dropdown' => false,
					'URL'      => 'sponsor/sponsorlar'
				),
				array(
					'name'     => array( 'tr' => 'Sponsorluk Paketleri', 'en' => 'Sponsors' ),
					'dropdown' => false,
					'URL'      => 'sponsor/sponsor-main'
				),
				array(
					'name'     => array( 'tr' => 'Sergi Paketleri', 'en' => 'Exhibition' ),
					'dropdown' => false,
					'URL'      => 'sergi/sergi-main'
				),
				array(
					'name'     => array( 'tr' => 'Sergi Firmaları', 'en' => 'Exhibition' ),
					'dropdown' => false,
					'URL'      => 'sergi/sponsorlar '
				),
				array(
					'name'     => array( 'tr' => 'Harici Ödeme', 'en' => 'External Payment' ),
					'dropdown' => false,
					'URL'      => 'odeme/odeme-main '
				),
			)
		),
		array(
			'name'     => array( 'tr' => 'Web Sitesi Yönetimi', 'en' => 'Web Site Manage' ),
			'dropdown' => false,
			'type'     => 'title',
		),
		array(
			'name'     => array( 'tr' => 'Mesajlar', 'en' => 'Messages' ),
			'icon'     => '<i class="la la-send"></i>',
			'dropdown' => false,
			'URL'      => 'mesaj/mesaj-main'
		),
		array(
			'name'     => array( 'tr' => 'Konu Başlıkları', 'en' => 'Subject Headings' ),
			'icon'     => '<i class="la la-bars"></i>',
			'dropdown' => false,
			'URL'      => 'konu/konu-main'
		),
		array(
			'name'     => array( 'tr' => 'Ayarlar', 'en' => 'Options' ),
			'icon'     => '<i class="la la-cogs"></i>',
			'dropdown' => true,
			'SUB'      => array(
				array(
					'name'     => array( 'tr' => 'Genel Ayarlar', 'en' => 'General Options' ),
					'dropdown' => false,
					'URL'      => 'options/general-options'
				),
                array(
                    'name'     => array( 'tr' => 'Anasayfa', 'en' => 'Home' ),
                    'dropdown' => false,
                    'URL'      => 'sayfa/anasayfa'
                ),
				array(
					'name'     => array( 'tr' => 'Sayfalar', 'en' => 'Pages' ),
					'dropdown' => false,
					'URL'      => 'sayfa/main'
				),
				array(
					'name'     => array(
						'tr' => 'Sponsor ve Sergi İçerikleri',
						'en' => 'Sponsor and Exhibition Contents'
					),
					'dropdown' => false,
					'URL'      => 'sponsor-icerik/main'
				),
				array(
					'name'     => array( 'tr' => 'Mesaj Metinleri', 'en' => 'Message Text' ),
					'dropdown' => false,
					'URL'      => 'mesajlar/mesajlar-main'
				),
			)
		)
	),
	'editor' => array(
		array(
			'name'     => array( 'tr' => 'EDİTÖR MENÜSÜ', 'en' => 'Paper Manage' ),
			'dropdown' => false,
			'type'     => 'title',
		),
		array(
			'name'     => array( 'tr' => 'Bildiriler', 'en' => 'Papers' ),
			'icon'     => '<i class="la la-newspaper-o"></i>',
			'dropdown' => true,
			'SUB'      => array(
				array(
					'name'     => array( 'tr' => 'Tüm Bildiriler', 'en' => 'All Papers' ),
					'dropdown' => false,
					'URL'      => 'bildiri/list'
				),
				array(
					'name'     => array( 'tr' => 'Bildirilerim', 'en' => 'My Papers' ),
					'dropdown' => false,
					'URL'      => 'bildiri/editor-bildirilerim'
				)
			)
		),
		array(
			'name'     => array( 'tr' => 'Yazarlar', 'en' => 'Writers' ),
			'icon'     => '<i class="la la-pencil"></i>',
			'dropdown' => false,
			'URL'      => 'yazar/yazar-main'
		),
		array(
			'name'     => array( 'tr' => 'Hakemler', 'en' => 'Referees' ),
			'icon'     => '<i class="la la-flag-checkered"></i>',
			'dropdown' => false,
			'URL'      => 'hakem/hakem-main'
		),
		array(
			'name'     => array( 'tr' => 'Mesajlar', 'en' => 'Messages' ),
			'icon'     => '<i class="la la-send"></i>',
			'dropdown' => false,
			'URL'      => 'mesaj/mesaj-main'
		),
		array(
			'name'     => array( 'tr' => 'Konu Başlıkları', 'en' => 'Subject Headings' ),
			'icon'     => '<i class="la la-bars"></i>',
			'dropdown' => false,
			'URL'      => 'konu/konu-main'
		),
		array(
			'name'     => array( 'tr' => 'Hesabım', 'en' => 'Account' ),
			'icon'     => '<i class="la la-user"></i>',
			'dropdown' => false,
			'URL'      => 'user/duzenle'
		)
	),
	'hakem'  => array(
		array(
			'name'     => array( 'tr' => 'HAKEM MENÜSÜ', 'en' => 'Paper Manage' ),
			'dropdown' => false,
			'type'     => 'title',
		),
		array(
			'name'     => array( 'tr' => 'Bildirilerim', 'en' => 'My Papers' ),
			'icon'     => '<i class="la la-newspaper-o"></i>',
			'dropdown' => false,
            'URL'      => 'bildiri/hakem-bildiri-list'
		)
	),
	'yazar'  => array(
		array(
			'name'     => array( 'tr' => 'YAZAR MENÜSÜ', 'en' => 'Paper Manage' ),
			'dropdown' => false,
			'type'     => 'title',
		),
		array(
			'name'     => array( 'tr' => 'Bildirilerim', 'en' => 'My Papers' ),
			'icon'     => '<i class="la la-newspaper-o"></i>',
			'dropdown' => false,
			'URL'      => 'bildiri/yazar-bildiri-list'
		)
	)
);

