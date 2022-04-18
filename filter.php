<?php
include"connect.php";
?>

<?php

if(!empty($_POST['kategoriya_filter'])){  
    $kategoriya_filteri= $_POST['kategoriya_filter'];
    $kaxtar = " AND ( k.id=".$kategoriya_filteri.") ";
}else{$kaxtar="";}

if(!empty($_POST['valyuta_filter'])){  
    $valyuta_filteri= $_POST['valyuta_filter'];
    $vaxtar = " AND (v.id=".$valyuta_filteri.") " ;
}else{$vaxtar="";}

if(!empty($_POST['t1']) && !empty($_POST['t2'])){
    $t1 = date('Y-m-d', strtotime("+1 day", strtotime($_POST['t1'])));
    $t2 = $_POST['t2'];
    $taxtar = " AND (o.tarix BETWEEN '".$t2."' AND '".$t1."' ) ";
}else{$taxtar="";}

$sec = mysqli_query($con,"SELECT o.id as o_id, o.rey, o.mebleg, o.tarix, k.id as k_id, k.kat_name,
 v.id as v_id, v.val_name ,odn.id as odn_id, odn.odn_name FROM odenis as o 
LEFT JOIN kategoriya as k ON o.kategoriya=k.id  
LEFT JOIN valyuta as v ON o.valyuta=v.id 
LEFT JOIN odenis_novu as odn ON o.nov=odn.id
WHERE o.id>0 ".$kaxtar.$vaxtar.$taxtar."
ORDER BY o.id DESC
");



$toplam = mysqli_query($con,"SELECT o.id as o_id, o.mebleg, v.val_name , odn.id as odn_id FROM odenis as o
LEFT JOIN kategoriya as k ON o.kategoriya=k.id  
LEFT JOIN valyuta as v ON o.valyuta=v.id 
LEFT JOIN odenis_novu as odn ON o.nov=odn.id
WHERE o.id>0 ".$kaxtar.$vaxtar.$taxtar."
ORDER BY o.id ASC
");





?>
<div class="alert alert-dark" role="alert">
<?php echo ' 
    <form action="" method="post" name="filterle" id="filterle">
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

    <button type="submit" name="filter" class="btn btn-success">Filter</button>
    </form>
';



?>  

</div>

<table class="table  table-hover">
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
            echo'<td> '.round($toplam_mexaric,2).' (AZN) </td>';
            echo'<td>'.round($toplam_medaxil,2).' (AZN) </td>';
            echo'<td> '.round($toplam_medaxil-$toplam_mexaric,2).'  </td>';
            echo'<td>'.$tarix.'</td>';
            
            echo'</tr>';
       
        $qaliq_sayi=count($toplam_qaliq)-1;
        $i = 0;
        while($info = mysqli_fetch_array($sec))
        {
            
            $i++;
            echo'<tr>';

            echo'<td>'.$i.'</td>';
            echo'<td class="reytd">'.$info['rey'].'</td>';
            echo'<td>'.$info['kat_name'].'</td>';
            if($info['odn_id']==2){  echo'<td>'.round($info['mebleg'],2).' ('.$info['val_name'].')</td>';  }else{echo'<td> &nbsp </td>';}
            if($info['odn_id']==1){  echo'<td>'.round($info['mebleg'],2).' ('.$info['val_name'].')</td>';  }else{echo'<td> &nbsp </td>';}
            echo'<td> '.round($toplam_qaliq[$qaliq_sayi],2).'  </td>';
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
