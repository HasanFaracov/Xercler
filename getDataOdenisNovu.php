<?php include"connect.php";?>

<?php
echo '
<form action="" method="post" id="addValyuta" name="addValyuta">
    Valyuta:<br>
    <select name="valyuta" class="form-control">';
            $sec = mysqli_query($con,"SELECT id,val_name,full_name FROM valyuta");
            while($info=mysqli_fetch_array($sec))
            {echo'<option value="'.$info['id'].'">'.$info['val_name'].' ('.$info['full_name'].') </option>';}
        echo'
            </select> <br>
    <input type="hidden" name="odn_id" value="'.$_POST['odenis_novu'].'">
    <button type="submit" name="add" class="btn btn-primary">Davam et</button>
</form>  
';

?>

<script>

$('#addValyuta').submit(function(e) {
        e.preventDefault();//
        let data = new FormData(this);
        $("#data").html(' <img style="margin:20px 0 0 400px; width:250px" src="loader.gif">');
        $.ajax({
            url:'getDataValyuta.php',
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