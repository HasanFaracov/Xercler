<?php
include"header.php";
?>


<br><br><br>
<div class="container" id="container">
    <div class="alert alert-dark" role="alert">
        <h3 class="text-right">Xərclərin idarə edilməsi</h3>
    </div>
<div id="data">
<?php 
        echo '
    <form action="" method="post" id="addOdenisNovu" name="addOdenisNovu">
        Ödənişin növü:<br>
        <select name="odenis_novu" class="form-control">';
                $sec = mysqli_query($con,"SELECT id,odn_name FROM odenis_novu");
                while($info=mysqli_fetch_array($sec))
                {echo'<option value="'.$info['id'].'">'.$info['odn_name'].' </option>';}
            echo'
                </select> <br>

        <button type="submit" name="add" class="btn btn-primary">Davam et</button>
    </form>  
    ';
    ?>
</div>

   
</div>

<script>

$('#addOdenisNovu').submit(function(e) {
        e.preventDefault();//
        let data = new FormData(this);
        $("#data").html(' <img style="margin:20px 0 0 400px; width:250px" src="loader.gif">');
        $.ajax({
            url:'getDataOdenisNovu.php',
            type:'POST',
            data: data,
            success: function(response){              
                $("#data").html(response); 		
            },
            cache: false,
            contentType: false,
            processData: false
        })
       
    });
    

</script>
<?php
include"footer.php";
?>