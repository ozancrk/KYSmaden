<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Yazarlar</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Yazarlar</a></li>
                            <li class="breadcrumb-item active">Listele</li>
                        </ol>
                    </div>

                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="<?=urlCreate('yazar/ekle')?>" class="btn btn-soft-primary">Yeni Ekle</a>
                    </div>
                    <div class="card-body">

                        <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                               style="width:100%">
                            <thead>
                            <tr>
                                <th>User ID</th>
                                <th>İsim</th>
                                <th>E-Posta</th>
                                <th>Kurum</th>
                                <th>Ülke</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach (getUserList('yazar') as $User): ?>
                            <tr>
                                <td><?=$User['id']?></td>

                                <td><?=$User['name']?></td>
                                <td><?=$User['username']?></td>
                                <td><?=$User['kurum']?></td>
                                <td><?=$User['ulke']?></td>
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a href="<?=urlCreate('yazar/duzenle?userID='.$User['id'])?>" class="dropdown-item edit-item-btn"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                    Düzenle</a></li>
                                            <li>
					                            <?php createJSObj('data'.$User['id'],array('userID'=>$User['id']));?>
                                                <a class="dropdown-item remove-item-btn" onclick="processConfirm('userDelete','<?=setFormTokenSession()?>',<?='data'.$User['id']?>)">
                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                    Sil
                                                </a>
                                            </li>
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
