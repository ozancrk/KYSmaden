<?php


$pageMeta = getPageMeta($_GET['pageID']);

$userMeta = getPageMeta($_GET['pageID']);

?>

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Bildiri Bilgileri</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Bildiriler</a></li>
                            <li class="breadcrumb-item active">Bildiri Bilgileri</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!$pageMeta){ ?>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Hatalı Bildiri ID'si</h4>
                        </div><!-- end card header -->
                    </div>
                </div>
            </div>
        <?php }else{ ?>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-justified mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tr" role="tab">
                                Türkçe
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#en" role="tab">
                                İngilizce
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content text-muted">
                        <div class="tab-pane active" id="tr" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Yazar Bilgileri</h5>

                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>


                            </div>
                        </div>
                        <div class="tab-pane" id="en" role="tabpanel">


                        </div>


                    </div>
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!--end col-->
</div>

<?php } ?>
</div>
</div>
