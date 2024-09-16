<html>

<head>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
<link type="text/javascript" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js">
<link type="text/javascript" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?= base_url()?>public/css/style.css">

<style>

#preview-image {
        display: none;
      }


</style>
</head>

<body>
<div class="container-contact100">
    <div class="wrap-contact100">
        <form class="contact100-form validate-form" name="uploadfile" id="uploadfile" method="post" enctype="multipart/form-data">
            <span class="contact100-form-title">
                Upload Files
            
            </span>

            <div class="wrap-input100 validate-input" data-validate="Please enter your name">
                <input class="input100" type="text" name="name" placeholder="Name" required>
                <span class="focus-input100"></span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Please enter email: e@a.x">
                <input class="input100" type="file" name="file[]" id="file" multiple required>
                <span class="focus-input100"></span>
            </div>
           
<div id="box"></div>
            <div class="container-contact100-form-btn">
                <button class="contact100-form-btn" id="btn-add" type="submit">
                   Uplaod
                </button>
            </div>
        </form>

        <div class="message" ></div>
      
    </div>
</div>   

<div class="container-contact100">
    <div class="wrap-contact100">
            
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Image</th>
        </tr>
        </thead>
        <tbody id="table">
        <?php
         

        ?>
        </tbody>
    </table>

    </div>
</div>


</body>

</html>

<script>
    jQuery(document).ready(function() {

        $("body").on("submit", "#uploadfile", function(e) {

        
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                            type: 'POST',
                            url: "<?php echo base_url('imageupload') ?>",
                            data: data,
                            dataType: 'json',
                            contentType: false,
                        // cache: false,
                            processData:false,
                            beforeSend: function() {
                        $("#btn-add").prop('disabled', true);
                        },
                        success: function(result) {

                        
                        $("#btn-add").prop('disabled', false);
                        
                            console.log(result.status);
                        }
                });
            });




            const fileInput = document.getElementById('file');

                const box = document.getElementById('box');

                fileInput.addEventListener('change', event => {
                if (fileInput.files.length > 0) {
                    for (const file of fileInput.files) {
                    const previewImage = document.createElement('img');

                    previewImage.src = URL.createObjectURL(file);

                    previewImage.style.height = '150px';
                    previewImage.style.width = '150px';

                
                    previewImage.onload = function handleLoad() {
                        URL.revokeObjectURL(previewImage.src);
                    };


                    box.appendChild(previewImage);
                    }
                }


                fileInput.value = null;
                });



       


    });

   
</script>
