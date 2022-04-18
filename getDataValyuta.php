<?php include"connect.php";?>

<?php
$_SESSION['token'] = md5(rand());
$val_id = $_POST['valyuta'];
$odn_id = $_POST['odn_id'];
echo '
<form action="" method="post" id="addOdenis" name="addOdenis">
    Ödənişin məbləği:<br>
    <input type="number" id="mebleg" class="form-control" name="mebleg" placeholder="Məbləğ girin" autocomplete="off" required><br>
    Kategoriya:<br>
    <select name="kategoriya" class="form-control">';
            $sec = mysqli_query($con,"SELECT id,kat_name FROM kategoriya");
            while($info=mysqli_fetch_array($sec))
            {echo'<option value="'.$info['id'].'">'.$info['kat_name'].'</option>';}
        echo'
            </select> <br>';
    $val = mysqli_query($con,"SELECT id,val_name,full_name FROM valyuta WHERE id = $val_id");
    $val = $val->fetch_array();
    echo'
    Valyuta:<br>
    <input type="text" id="valyuta" class="form-control" name="valyuta" value="'.$val['val_name'].'" autocomplete="off" disabled><br>';


    $odn = mysqli_query($con,"SELECT id,odn_name FROM odenis_novu WHERE id = $odn_id");
    $odn = $odn->fetch_array();
    echo'
    Ödənişin növü:<br>
    <input type="text" id="odenisin_novu" class="form-control" name="odenisin_novu" value="'.$odn['odn_name'].'" autocomplete="off" disabled><br>
    
    <div class="form-floating">
    <label for="rey">Rəy:</label>
    <textarea class="form-control" placeholder="Ödəniş haqqında rəylərinizi yaza bilərsiniz..." id="rey" name="rey" ></textarea>
    </div>
    <br>


    <input type="hidden" name="token" value="'.$_SESSION['token'].'">
    <input type="hidden" name="odn_id" value="'.$odn_id.'">
    <input type="hidden" name="val_id" value="'.$val_id.'">

    <button type="submit" name="addOdenis" class="btn btn-primary">Təsdiqlə</button>
</form>  
';

?>

<script>

$('#addOdenis').submit(function(e) {
        e.preventDefault();//
        let data = new FormData(this);
        $("#data").html(' <img style="margin:20px 0 0 400px; width:250px" src="loader.gif">');
        $.ajax({
            url:'getDataOdenis.php',
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