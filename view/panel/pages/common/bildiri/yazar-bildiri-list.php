<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Bildiriler</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Bildiriler</a></li>
                            <li class="breadcrumb-item active">Listele</li>
                        </ol>
                    </div>

                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                               style="width:100%">
                            <thead>
                            <tr>
                                <th>Bildiri ID</th>
                                <th>Yazar</th>
                                <th>Bildiri Adı</th>
                                <th>Durum</th>
                                <th>Ekleme Tarihi</th>
                                <th>Son Güncelleme</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach (listBildiriler() as $Paper):

                                if($Paper['yazar'] != $_SESSION['UserID']){
                                    continue;
                                }

	                            if($Paper['status'] == 0){

		                            $durum1 =  '<span class="badge text-bg-danger">Düzenlenemez</span>';

	                            }else if($Paper['status'] == 1){

		                            $durum1 =  '<span class="badge text-bg-success">Düzenlenebilir</span>';

	                            }


                                ?>
                            <tr>
                                <td><?=$Paper['id']?></td>
                                <td><?=getUserMeta($Paper['yazar'],'name')?></td>
                                <td><?=$Paper['title']?></td>
                                <td><?php echo bildiriStatus($Paper['sonislem']['islem'],$SiteLang); ?></td>
                                <td><?php echo date("d.m.Y H:i:s", strtotime($Paper['ekleme']['date'])); ?> </td>
                                <td><?php echo date("d.m.Y H:i:s", strtotime($Paper['sonislem']['date'])); ?> </td>
                                <td><?=$durum1?></td>
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a href="<?=urlCreate('bildiri/yazar-bildiri-details?paperID='.$Paper['id'])?>" class="dropdown-item edit-item-btn"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                    Detaylar</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
