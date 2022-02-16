<?php
$this->title = 'Portal Informasi RSUD Arifin Achmad Jadwal Dokter';
?>
<style>
    .displaycontainer {
        background-color: #ffffff;
        width: 100% !important;
        height: 0% !important;
        margin: 0;
        padding: 0;
        display: block;
        position: absolute;
    }

    .displaycontainer2 {
        width: 100% !important;
        height: 0% !important;
        padding-top: 140px;
        padding-left: 0;
        margin: 0;
        position: absolute;
        text-align: center;
    }

    .displaycontainer3 {
        width: 50% !important;
        height: 0% !important;
        margin-top: 0%;
        padding: 0;
        display: block;
        position: absolute;
        padding: 10px;
        text-align: center;
    }

    .card-list-dokter {
        color: #ffffff;
        width: 100%;
        height: 120px;
        padding: 40px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 29px;
    }

    .card-list-dokter2 {
        color: #ffffff;
        width: 100%;
        height: 120px;
        padding: 20px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 29px;
    }

    .card-list-dokter>.pull-right {
        padding-top: 9px;
    }

    .card-list-dokter2>.pull-left>.alert {
        margin: 0px;
        border-radius: 10px;
        background-color: #039FBE;
        color: #ffffff;
    }
</style>

<div class="container-fluid">
    <div class="row" style="margin-bottom: 140px; ">
        <div class="displaycontainer" style="left:0; top:0;">
            <div style="background-color:#039FBE; width:100%; height: 130px; padding:14px;">
                <h2 style="text-align:center; color:#ffffff; margin-top:0; padding:10px; padding-top:20px; font-weight:bold; font-size:60px;">INFORMASI JADWAL PRAKTEK DOKTER</h2>
            </div>
            <br>
        </div>
    </div>
    <marquee direction="up"  width="100%" scrollamount="10" height="900px" >
        <div class="row">
            <?php
            if (isset($data[1])) {
                foreach ($data as $dataV) {
                    foreach ($dataV['detail_dokter'] as $value) { ?>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-md-3" style="background-position:center; background-size:cover; width:240px !important; height:350px; border-radius: 10%; margin-left: 5px; margin-right:20px">
                                    <?php
                                    if ($value[2] == null) {
                                        echo "<img src='http://192.168.254.67/jadwal-dokter/web/images/doktor.jpg' style='background-position:center; background-size:cover; width:260px !important; height:350px; border-radius: 10%; margin-right:20px>'";
                                    } ?>

                                    <img src="http://192.168.254.67/informasi/web/informasi/images/dokter/<?= $value[2]; ?>" style="background-position:center; background-size:cover; width:260px !important; height:350px; border-radius: 10%; margin-right:20px">
                                    &nbsp;
                                </div>
                                <div class="col-md-8">
                                    <div class="card-list-dokter" style="background-color:#039FBE;">
                                        <div class="pull-left">
                                            <span><?= $value[1]; ?></span>
                                        </div>
                                    </div>
                                    <div class="card-list-dokter" style="background-color:#47C659; margin-top:5px">
                                        <?= $value[3]; ?>
                                    </div>

                                    <div class="card-list-dokter2" style="margin-top:5px">

                                        <div class="pull-left">
                                            <?php foreach ($value[4] as $k => $y) : ?>
                                                <span class="alert alert-info"><?= $y ?></span>
                                            <?php endforeach; ?>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            } ?>
        </div>
    </marquee>

</div>
</div>