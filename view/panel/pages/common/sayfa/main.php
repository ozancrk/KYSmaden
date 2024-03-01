<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Sayfalar</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Sayfalar</a></li>
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
                                <th>Sayfa Adı</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach (listPages() as $Paper):

                                ?>
                                <tr>
                                    <td><?=$Paper[$SiteLang]?></td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a href="<?=urlCreate('sayfa/details?pageID='.$Paper['id'])?>" class="dropdown-item edit-item-btn"><i
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
