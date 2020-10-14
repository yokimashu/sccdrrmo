                                         <?php if ($get_photo == ''){
                                             $get_photo = 'user.jpg';
                                         }?>
                                         
                                            <div class="row col-12">
                                            <div class="row">
                                            <!-- <form method="POST" action="storeImage.php"> -->
                                            <div style="margin:auto">

                                                    <video id="webcam" autoplay playsinline width="600" height="530" align="center" hidden class="photo  img-thumbnail"></video>
                                                    <canvas id="canvas" class="d-none" hidden width="600" height="530" align="center" onClick="setup()" class="photo  img-thumbnail"></canvas>
                                                    <!-- <audio id="snapSound"  src="audio/snap.wav"  preload="auto"></audio> -->
                                                    <img src="../flutter/images/<?php echo $get_photo?>" id="photo" style="height: 300px; width:500px;margin:auto;" class="photo img-thumbnail">
                                                </div>
</div>
                                            <div style="margin:auto">
                                                <div class="col-12" style="margin:auto;margin-top:30px;margin-bottom:30px">
                                                    <span class="align-baseline">
                                                        <input type="hidden" name="image" class="image-tag" value = <?php echo $img;?>>
                                                        <!-- <input type="button" class="btn btn-primary" value="&#9654" onClick="setup()">  -->
                                                        <button type="button"  id="opencamera" class="btn btn-warning " value="CAPTURE"><i class="fa fa-camera"></i></button>
                                                        <button type="button" id="capture" class="btn btn-primary toastsDefaultSuccess" value="CAPTURE" onClick="take_snapshot()"><i class="fa fa-check"></i></button>
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
                                                        <label for="fileToUpload" class="custom-file-upload">
                                                            <i class="fa fa-cloud-upload"></i> Import Image
                                                        </label>
                                                        <input type="file"  id="fileToUpload" name="myFile" class="btn btn-danger custom-file-upload ">

                                                    </span>
                                                </div>
                                            </div>