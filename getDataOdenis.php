<?php include"connect.php";?>



<?php


if(isset($_POST['mebleg'])){  
    $mebleg = trim($_POST['mebleg']);
    $mebleg = strip_tags($mebleg);
    $mebleg = htmlspecialchars($mebleg);
    $mebleg = mysqli_real_escape_string($con,$mebleg);
    
    if($_SESSION['token']==$_POST['token']){ 
               
        $daxilet = mysqli_query($con,"INSERT INTO odenis(nov,kategoriya,valyuta,mebleg,rey,tarix)
        VALUES('".$_POST['odn_id']."','".$_POST['kategoriya']."','".$_POST['val_id']."','".$_POST['mebleg']."','".$_POST['rey']."','".$tarix."')");        
        if($daxilet==true){
            echo'<div class="alert alert-success" role="alert">Ödəniş bazaya əlavə edildi</div>';
        }else{
            echo'<div class="alert alert-danger" role="alert">Ödənişi bazaya əlavə etmək mümkün olmadı.</div>';
        }
   
    } 
}

?>
<div id="sontable">
<?php

$sec = mysqli_query($con,"SELECT o.id as o_id, o.rey, o.mebleg, o.tarix, k.id as k_id, k.kat_name,
 v.id as v_id, v.val_name ,odn.id as odn_id, odn.odn_name FROM odenis as o 
LEFT JOIN kategoriya as k ON o.kategoriya=k.id  
LEFT JOIN valyuta as v ON o.valyuta=v.id 
LEFT JOIN odenis_novu as odn ON o.nov=odn.id ORDER BY o.id DESC
");


$toplam = mysqli_query($con,"SELECT o.id as o_id, o.mebleg, v.val_name , odn.id as odn_id FROM odenis as o
LEFT JOIN valyuta as v ON o.valyuta=v.id 
LEFT JOIN odenis_novu as odn ON o.nov=odn.id ORDER BY o.id ASC
");





?>

<div class="alert alert-dark" role="alert">
<?php echo ' 
    <form action="" method="post" name="filterle" id="filterle" >
        <select name="kategoriya_filter" class="form-control filter1">
        <option value="">Kategoriya filterləyin</option>';
                $filterK_sec = mysqli_query($con,"SELECT id,kat_name FROM kategoriya");
                while($info=mysqli_fetch_array($filterK_sec))
                {echo'<option value="'.$info['id'].'">'.$info['kat_name'].' </option>';}
            echo'
        </select>
        <select name="valyuta_filter" class="form-control filter2">
        <option value="">Valyuta filterləyin</option>';
                $filterV_sec = mysqli_query($con,"SELECT id,val_name,full_name FROM valyuta");
                while($info=mysqli_fetch_array($filterV_sec))
                {echo'<option value="'.$info['id'].'">'.$info['val_name'].' </option>';}
            echo'
        </select> <br><br>

    
    <input type="date" class="float-right" name="t1" value="">
    <input type="date" class="float-right" name="t2" value="">

    <button type="submit" name="filter"  class="btn btn-success">Filter</button>

    
    </form>
';
?>  
</div>

<table class="table table-hover">
    <thead>
        <th>№</th>
        <th>Rəy</th>
        <th>Kategoriya</th>
        <th>Məxaric</th>
        <th>Mədaxil</th>
        <th>Qalıq (AZN)</th>
        <th>Tarix</th>
    </thead>

    <tbody>
        <?php
        $toplam_qaliq=[];
        $toplam_medaxil=0;
        $toplam_mexaric=0;
        $qaliq = 0;
        $j=0;
        while($t_info = mysqli_fetch_array($toplam))
        {
            $j++;
            $cevrilmis;
            switch ($t_info['val_name']) {
                case 'AZN':
                    $cevrilmis = $t_info['mebleg'];
                    break;
                case 'USD':
                    $cevrilmis = $t_info['mebleg']*1.7;
                    break;
                case 'EUR':
                    $cevrilmis = $t_info['mebleg']*1.8369;
                    break;
                case 'TRY':
                    $cevrilmis = $t_info['mebleg']*0.1162;
                    break;
                case 'RUB':
                    $cevrilmis = $t_info['mebleg']*0.0206;
                    break;
            }
            if($t_info['odn_id']==1){
                $qaliq = $qaliq+ $cevrilmis;
                $toplam_medaxil= $toplam_medaxil+ $cevrilmis;
            }else{ $qaliq = $qaliq - $cevrilmis;
                $toplam_mexaric = $toplam_mexaric+ $cevrilmis;
            }
            array_push($toplam_qaliq, $qaliq);


        }
        echo'<tr>';

            echo'<td>#</td>';
            echo'<td>Toplam</td>';
            echo'<td>----</td>';
            echo'<td> '.$toplam_mexaric.' (AZN) </td>';
            echo'<td>'.$toplam_medaxil.' (AZN) </td>';
            echo'<td> '.$toplam_medaxil-$toplam_mexaric.'  </td>';
            echo'<td>'.$tarix.'</td>';
            
            echo'</tr>';
       
        $qaliq_sayi=count($toplam_qaliq)-1;
        $i = 0;
        while($info = mysqli_fetch_array($sec))
        {
            
            $i++;
            echo'<tr>';

            echo'<td>'.$i.'</td>';
            echo'<td>'.$info['rey'].'</td>';
            echo'<td>'.$info['kat_name'].'</td>';
            if($info['odn_id']==2){  echo'<td>'.$info['mebleg'].' ('.$info['val_name'].')</td>';  }else{echo'<td> &nbsp </td>';}
            if($info['odn_id']==1){  echo'<td>'.$info['mebleg'].' ('.$info['val_name'].')</td>';  }else{echo'<td> &nbsp </td>';}
            echo'<td> '.$toplam_qaliq[$qaliq_sayi].'  </td>';
            echo'<td>'.$info['tarix'].'</td>';
            
            echo'</tr>';
            $qaliq_sayi--;
        }


        ?>
    </tbody>
</table>


<script>

$('#filterle').submit(function(e) {
        e.preventDefault();//
        let data = new FormData(this);
        $("#sontable").html(' <img style="margin:20px 0 0 400px; width:250px" src="loader.gif">');
        $.ajax({
            url:'filter.php',
            type:'POST',
            data: data,
            success: function(response){              
                $("#sontable").html(response); 		
            },
            cache: false,
            contentType: false,
            processData: false
        })
       
    });
    

</script>
</div>

