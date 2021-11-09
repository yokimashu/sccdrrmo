<?php
$img = '';

?>
<style>



</style>

<?php if ($get_photo == '') {
    $get_photo = 'user.jpg';
} ?>

<div class="row">

    <!-- <form method="POST" action="storeImage.php"> -->
    <br>

    <div class="col-md-1"></div>

    <div class="col-md-10">

        <video id="webcam" autoplay playsinline width="600" height="530" align="center" hidden class="photo  img-thumbnail"></video>
        <canvas id="canvas" class="d-none" hidden width="600" height="530" align="center" onClick="setup()" class="photo  img-thumbnail"></canvas>
        <!-- <audio id="snapSound"  src="audio/snap.wav"  preload="auto"></audio> -->
        <img src="../flutter/images/<?php echo $get_photo ?>" id="photo" style="height: 300px; width:300px;margin:auto;" class="photo img-thumbnail">

    </div>

    





    </div><br>

    <div class="row">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-5 ">
                                                    <!-- <label>Street: </label> -->
                                                    <input type="text" readonly class="form-control" style=" text-transform: uppercase; font-weight: bold; color: red; text-align: center;" name="province" placeholder="Province" value="<?php echo $get_status; ?>">
                                                </div>
                                            </div><br>
                                
    <div class="row">


    <div class="col-md-3"></div>


    <div class="col-md-8" style="margin:auto;margin-top:30px;margin-bottom:5px">
        <span class="align-baseline">
            <input type="hidden" name="image" class="image-tag" value=<?php echo $img; ?>>
            <!-- <input type="button" class="btn btn-primary" value="&#9654" onClick="setup()">  -->
            <!-- <button type="button" id="opencamera" class="btn btn-warning " value="CAPTURE"><i class="fa fa-camera"></i></button> -->
            <!-- <button type="button" id="capture" class="btn btn-primary toastsDefaultSuccess" value="CAPTURE" onClick="take_snapshot()"><i class="fa fa-check"></i></button> -->
            <!--                                                        <button type="button"  id="crop" class="btn btn-primary toastsDefaultSuccess" value="CAPTURE" onClick="">CROP</button>-->
      
            <style>
                input[type="file"] {
                    display: none;
                }

                .custom-file-upload {
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    display: inline-block;
                    padding: 7px 12px;
                    cursor: pointer;
                }
            </style>


        
        </span>
    </div>

</div>