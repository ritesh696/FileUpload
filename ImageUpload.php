<html>

<head>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
<link type="text/javascript" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js">
<link type="text/javascript" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?= base_url()?>public/css/style.css">


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
                <input class="input100" type="file" name="file[]" multiple required>
                <span class="focus-input100"></span>
            </div>
        
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
          if(isset($getData))
            {   
                foreach($getData as $row)
                {   
                    $imgData = '';
                    $jsonArray = json_decode($row->image_url,true);
                    foreach($jsonArray as $value)
                    {
                        $imgData .= '<img src='.base_url($value).' width="200px">';
                    }
                    echo '<tr>
                        <td>'.$row->name.'</td>
                        <td>'.$imgData.'</td>
                        <td><a href="delete/'.$row->id.'">Delete</a></td>
                    </tr>' ;
                }
            } 

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
                    
                           if(result.status) {
                           
                            $(".message").html(result.message);
                            $("#table").append(result.path);
                            $("#uploadfile")[0].reset();
                        
                        } else {
                        
                            $(".message").html(result.message);
                        }  
                    }
            });
        });


    });
</script>