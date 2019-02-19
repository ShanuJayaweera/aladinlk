<link rel="stylesheet" href="assets/dropzone/dropzone.css" />
<script src="assets/dropzone/dropzone.js"></script>

<div class="col-md-12">

</div>
<div class="row">

<div class="col-md-2">
<h5>Upload Images </h5>
</div>
    <div class="col-md-7">
    <form action="include/image/upload.php" class="dropzone" id="dropzoneFrom" method="post">

    </form>

    <br />
    </div>
    <div class="col-md-3" style="background-color: #fbf6d5; font-family: roboto; border-color: #e2a01a;">
        <h6 style="color: #000000;"><i class="glyphicon glyphicon-camera"></i> Use real photos</h6>
        <h6 style="color: #000000;"><i class="glyphicon glyphicon-camera"></i> Images must be <strong>JPG</strong> or <strong>PNG</strong> format</h6>
        <h6 style="color: #000000;"><i class="glyphicon glyphicon-camera"></i> Maximum image size is 5MB</h6>
        <h6 style="color: #000000;"><i class="glyphicon glyphicon-camera"></i> Do not upload images with watermarks</h6>

    </div>


</div>
<div class="row">
    <div class="col-md-2"></div>
    <div id="preview">

    </div>
</div>
<br>
<script>

    $(document).ready(function(){


        Dropzone.options.dropzoneFrom = {
            autoProcessQueue: true,
            acceptedFiles:".png,.jpg,.gif,.bmp,.jpeg",
            init: function(){
                var submitButton = document.querySelector('#submit-all');
                myDropzone = this;
                this.on("complete", function(){
                    if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
                    {
                        var _this = this;
                        _this.removeAllFiles();
                    }
                    list_image();
                });
            },
        };

        list_image();

        function list_image()
        {

            $.ajax({
                url:"include/image/upload.php",
                success:function(data){
                    $('#preview').html(data);

                }
            });
        }

        $(document).on('click', '.remove_image', function(){
            var name = $(this).attr('id');
            $.ajax({
                url:"include/image/upload.php",
                method:"POST",
                data:{name:name},
                success:function(data)
                {
                    list_image();
                }
            })
        });

    });
</script>