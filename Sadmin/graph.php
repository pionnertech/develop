<?php session_start();

if(isset($_SESSION['TxtCode']) && $_SESSION['TxtRange'] == 'sadmin'){

$datos = mysqli_connect('localhost', "root", "MoNoCeRoS", "K_usr10000");
                                                                
$Query_name = mysqli_query($datos, "SELECT FAC_NAME FROM FACILITY WHERE FAC_CODE = " . $_SESSION['TxtFacility']);
$Query_task = mysqli_query($datos, "SELECT A.ISS_SUBJECT, D.CTZ_NAMES,  C.USR_NAME, B.EST_DESCRIPT, B.EST_COLOR, SUBSTRING(A.ISS_FINISH_DATE, 1, 10) , C.USR_SURNAME, D.CTZ_SURNAME1, D.CTZ_SURNAME2 FROM ISSUES A INNER JOIN EST B ON(B.EST_CODE = A.ISS_STATE) INNER JOIN USERS C ON(C.USR_ID = A.ISS_CHARGE_USR)  INNER JOIN CITIZENS D ON(D.CTZ_RUT = A.ISS_CTZ) WHERE ISS_FAC_CODE = " . $_SESSION['TxtFacility'] . ";");
$qcd = mysqli_query($datos, "SELECT DISTINCT B.USR_DEPT FROM SUBTASKS A INNER JOIN USERS B ON(A.STSK_CHARGE_USR = B.USR_ID)  WHERE STSK_FAC_CODE = " . $_SESSION['TxtFacility'] . " GROUP BY USR_DEPT;");

//personal
$data_per = mysqli_query($datos, "SELECT DISTINCT B.USR_NAME , B.USR_DEPT FROM USERS B RIGHT JOIN SUBTASKS A ON(B.STSK_CHARGE_USR = A.USR_ID) WHERE STSK_FAC_CODE = " . $_SESSION['TxtFacility'] . " ORDER BY USR_DEPT");

$depts = mysqli_query($datos, "SELECT DISTINCT B.USR_DEPT FROM SUBTASKS A INNER JOIN USERS B  ON(A.STSK_CHARGE_USR = B.USR_ID) WHERE STSK_FAC_CODE = " . $_SESSION['TxtFacility'] . " GROUP BY USR_DEPT");

$parray = array();
$darray = array();
$iarray = array();

$i = 0;

while($extra = mysqli_fetch_row($depts)){
    $handup = mysqli_query($datos, "SELECT USR_NAME, USR_ID FROM USERS WHERE (USR_DEPT = '" . $extra[0] . "' AND USR_FACILITY = " . $_SESSION['TxtFacility'] . ");");
        while( $sub = mysqli_fetch_row($handup)){
               $parray[$i] = $sub[0];
               $darray[$i] = $extra[0];
               $iarray[$i] = $sub[1];
               $i = $i + 1;
        }
}

$counterId = count($darray);
$latest = 0;
$lastone= "";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eque-e</title>
        <link type="text/css" href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="../css/theme.css" rel="stylesheet">
        <link type="text/css" href="../images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'rel='stylesheet'>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="../css/revealing.css">

            <style type="text/css">

                    .linerchart{
            width:33.33%;
            display: inline-block;
            vertical-align: top;
        }
        #data-contents{
            display: inline-block;
            vertical-align: top;
            width: auto;

        }
        .widget-usage p{
            line-height: .2 !important;
        }

        </style>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.html">Eque-e</a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav nav-icons">
                            <li class="active"><a href="#"><i class="icon-envelope"></i></a></li>
                            <li><a href="#"><i class="icon-eye-open"></i></a></li>
                            <li><a href="#"><i class="icon-bar-chart"></i></a></li>
                        </ul>
                        <form class="navbar-search pull-left input-append" action="#">
                        <input type="text" class="span3">
                        <button class="btn" type="button">
                            <i class="icon-search"></i>
                        </button>
                        </form>
                        <ul class="nav pull-right">
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <b class="caret"></b></a>
                            </li>
                           
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="images/user.png" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="../backend/close.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled">
                                <li><a href="index.php"><i class="menu-icon icon-inbox"></i>Página principal<b class="label green pull-right">
                                    11</b> </a></li>
                                <li><a href="#"><i class="menu-icon icon-tasks"></i><b class="label orange pull-right">
                                    19</b> </a></li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->
                    <!--/.span9-->

                    <div class="span9" style="float: right;">
                        <div class="content">
                            <div class="module">
                                <div class="module-head">
                                    <h3>Análisis de trabajo</h3>
                                </div>
                                <div class="module-body">
                                    <div  style="width: 350px; height: 350px; display: inline-block;">
                                         <div id="dynamics" style="height: 350px; width:350px;"></div>
                                    </div>
                                    <div id="data-contents">
                                    <p><i class="fa fa-building"></i><span style="margin-right: 27%">Departamento</span>
                                    <i class="fa fa-user"></i><span style="margin-right: 27%">Usuario</span>
                                    </p>
                                        <select id="selection">
                                        <option value="Global">GLOBAL</option>
                                        <?  $i = 1;
                                               while($fil22 = mysqli_fetch_row($qcd)) {
                                        ?>
                                            <option value="<? printf($i) ?>"><? printf( $fil22[0]) ?></option>

                                        <? $i = $i + 1; } ?>

                                        </select>
                                        <select id="personal" disabled="true">
                                        <?  
                                            $z = 0;
                       
                                            for($y=0; $y < count($parray); $y++){ 

                                                    if(($y-1) < 0){

                                                        $z = 0;

                                                    } else {

                                                        if($darray[$y] != $darray[$y-1]  ){  
                                 ?>
                                    <option id="General" class="<? printf( str_replace(" ", "_", $darray[$y-1])) ?>" value="<? printf($z+1) ?>">General</option>
                                 <?
                                                             $z = 0;  

                                                        } else {

                                                            $z = $z+1;
                                                            $latest = $z;
                                                        }                                          
                                                    }
                                        ?>
                                   <option id="<? printf($iarray[$y]) ?>" class="<? printf( str_replace(" ", "_", $darray[$y]))?>" value="<? printf($z) ?>"><? printf( $parray[$y]) ?></option>
                                       <?
                                            }

                                        ?>
                                        <option id="General" class="<? printf( str_replace(" ", "_",$darray[$latest])) ?>" value="<? printf($latest+1) ?>">General</option>
                                        </select>
                                    <div class="wrap-progress" >
                                         <ul class="widget widget-usage unstyled progressDisplay" id="Audi-Display">
                                            <li>
                                                <p>
                                                    <strong>Compromisos Pendientes</strong><span class="pull-right small muted" style="font-weight: bolder;"></span>
                                                </p>
                                                <div class="progress tight">
                                                    <div class="bar bar-warning" style="width:;"></div>
                                                </div>
                                            </li>
                                            <li>
                                                <p>
                                                    <strong>Compromisos En Curso</strong><span class="pull-right small muted" style="font-weight: bolder;"></span>
                                                </p>
                                                <div class="progress tight">
                                                    <div class="bar" style="width:;"></div>
                                                </div>
                                            </li>
                                            <li>
                                                <p>
                                                    <strong>Compromisos Atrasados</strong><span class="pull-right small muted" style="font-weight: bolder;"></span>
                                                </p>
                                                <div class="progress tight">
                                                    <div class="bar bar-danger" style="width:;"></div>
                                                </div>
                                            </li>
                                            <li>
                                                <p>
                                                    <strong>Compromisos Por vencer</strong><span class="pull-right small muted" style="font-weight: bolder;"></span>
                                                </p>
                                                <div class="progress tight">
                                                    <div class="bar bar-warning" style="width:;"></div>
                                                </div>
                                            </li>
                                            <li>
                                                <p>
                                                    <strong>Compromisos Finalizados</strong><span class="pull-right small muted" style="font-weight: bolder;"></span>
                                                </p>
                                                <div class="progress tight">
                                                    <div class="bar bar-success" style="width:;"></div>
                                                </div>
                                            </li>
                                         </ul>
                                    </div>
                                    </div>
                                    <div class="media" style="display: inline-block;">
                                        <div class="media-avatar">
                                            <img src="../<? echo $_SESSION['TxtFacility']?>/img/Global.jpg" class="user-pic">
                                        </div>
                                    </div>
                                    <blockquote class="ram nam" style="display: inline-block; vertical-align: top"></blockquote>
                                </div>
                            </div>
                        </div>
                    </div>     
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <div class="footer">
            <div class="container">
                <b class="copyright">&copy; 2015 Eque-e </b>Todos los derechos reservados.
            </div>
        </div>
        <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script type="text/javascript">

              function heighter(obj){
                    obj.children('td').css({ height : '130px'});
                         }
        </script>

        <script src="../scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="../scripts/flot/jquery.flot.pie.js" type="text/javascript"></script>
        <script src="../scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="../scripts/jlinq.js" type="text/javascript"></script>
        <script src="../scripts/jlinq.jquery.js" type="text/javascript"></script>
        <script src="../scripts/jquery.revealing.js"></script>
        <script type="text/javascript">

var fac = <? printf($_SESSION['TxtFacility']) ?>;
var datas;
var perplot;
var matrix;
var datax;
var array_set;
var bars= ""; 

$(document).on('ready', function(){

     $("#ram").revealing();

array_set = [
<?
$global_query = "SELECT B.EST_DESCRIPT, COUNT( STSK_ID ) , B.EST_COLOR, B.EST_CODE FROM SUBTASKS A INNER JOIN EST B ON ( A.STSK_STATE = B.EST_CODE )  WHERE STSK_FAC_CODE = " . $_SESSION['TxtFacility'] . " GROUP BY EST_DESCRIPT";
$pass = mysqli_query($datos, $global_query);

while ( $fila2 = mysqli_fetch_row($pass)) {

?>
{ label: "<? printf(  $fila2[0] ) ?>",  data: <? printf( $fila2[1] ) ?> , color:"<? printf( $fila2[2] ) ?>"},
<? } 
mysqli_data_seek($pass, 0);
?>
{ label: "n/n",  data: 0, color: "#FFF"}
];

 $.plot($("#dynamics"), array_set, {
           series: {
            pie: {
                innerRadius: 0.5,
                show: true
            }
         },
         legend: {
            show: false         
        },
        grid: {
        hoverable: true,
        clickable: true
    }
});

<?

$x= 0;
$flow = "";

       $graph = mysqli_query($datos, $global_query);

       while($cuenta = mysqli_fetch_row($graph)){
           $x += $cuenta[1];
       }  
          
       $inner_query = mysqli_query($datos, $global_query);
       echo "bars = '";
        while ( $fila2 = mysqli_fetch_array($inner_query)){
          
        echo  $fila2[1] . "/" . round(($fila2[1]/$x) * 100) . "/" . $fila2[3] . "/"; 
        }
     echo "';";

?>

injectBarVars(bars);
updateChart();


         function pieHover(event, pos, obj) {
            if (!obj)
                return;
            percent = parseFloat(obj.series.percent).toFixed(2);
            $("#hover").html('<span>' + obj.series.label + ' - ' + percent + '%</span>');
        }

        function pieClick(event, pos, obj) {
            if (!obj)
                return;
            percent = parseFloat(obj.series.percent).toFixed(2);
            alert('' + obj.series.label + ': ' + percent + '%');
        }
});


$("#selection, #personal").on("change" , function (){

if($(this).attr("id") == "selection" && $(this).children("option:selected").text() == "GLOBAL" ){

$.plot($("#dynamics"), array_set, {
           series: {
            pie: {
                innerRadius: 0.5,
                show: true
            }
         },
         legend: {
            show: false         
        },
        grid: {
            
        hoverable: true,
        clickable: true
    }
});
      $("#personal").attr("disabled", true);
      injectBarVars(bars);
      
    setTimeout(function() { 
          $('.nam').html("GLOBAL");
             $('.nam').revealing('show') }
        , 150);

$('img.user-pic').fadeOut(500, function(){
$.ajax({
    type: "POST",
    url: '../' + fac + "/img/Global.jpg",
    success : function (data){
        var cUrl ='../' + fac + "/img/Global.jpg";
        $("img.user-pic").attr('src',cUrl).bind('onreadystatechange load', function(){
         if (this.complete) $(this).fadeIn(500);
      });
    }
    });

   });


}  else{

 $("#personal").attr("disabled", false);

       if($(this).attr("id") !== "personal"){
        var conte = $(this).children("option:selected").text()
       $("#personal option." + conte.replace(/\ /g, "_")).attr("selected", true);
       }
       


var depto_eval = document.querySelector("#selection").options[document.querySelector("#selection").selectedIndex].text.replace(/\ /g ,"_").toString();
var name       = document.querySelector("#personal").options[document.querySelectorAll("#personal")[0].selectedIndex].text.replace(/\ /g ,"_").toString();

$("#personal option").css({ display: "none" });
$("#personal option." + depto_eval).css({ display: "block" });
$("#personal option#general").css({ display: "block" });

var ind2 = document.querySelector("#personal").options[document.querySelectorAll("#personal")[0].selectedIndex].value;
var ind1 = $("#selection").val() - 1;
var mode = 0;
var usrId = document.querySelector("#personal").options[document.querySelectorAll("#personal")[0].selectedIndex].id;
// ind1 ve el departamento, ind2 ve la naturaleza, ind3 ve  el personal

$('img.user-pic').fadeOut(500, function(){

$.ajax({
    type: "POST",
    url: '../' + fac + "/img/" + usrId + "_opt.jpg",
    success : function (data){
       if(name !== "General"){
        var cUrl ='../' + fac + "/img/" + usrId + "_opt.jpg";
    } 
        $("img.user-pic").attr('src',cUrl).bind('onreadystatechange load', function(){
         if (this.complete) $(this).fadeIn(500);
      });
    }, 
    error : function(err){
        if(name == "General"){
            var cUrl = '../' + fac + "/img/General.jpg";
        } else {
             var cUrl = '../' + fac + "/img/user.jpg";
        }
                $("img.user-pic").attr('src',cUrl).bind('onreadystatechange load', function(){
         if (this.complete) $(this).fadeIn(500);
      });
    }

    });

   });

//$('.nam').revealing('reset');
       
       setTimeout(function() { 
          $('.nam').html(name.replace(/\_/g, " "));
             $('.nam').revealing('show') }
        , 150);

setDataByJSON(depto_eval, name, ind1, ind2, mode, usrId);

}
});

// create data.

function updateChart(){

$.ajax({ type: "POST", 
        url: "../backend/JSON.php?facility=" + fac, 
        success: function(datab){
               datas = datab;
                }
       });

}

function setDataByJSON(depto, name, index_d, index_p, mode, usrId){

var database = JSON.parse(datas);
var newData_eval = jlinq.from(database.data).select();
datax = newData_eval;
//make contador
var conta = eval('newData_eval[' + index_d + '].' + depto );
var per_conta = eval('newData_eval[' + index_d + '].' + depto + "[" + index_p + "]." + name );
console.info('perconta =' + 'newData_eval[' + index_d + '].' + depto + "[" + index_p + "]." + name);
// clean up the plot chart
$("#dynamics").html('');

var matriz =new Array();

   Mtx_data = eval('newData_eval[' + index_d + '].' + depto + "[" + mode + "]." + name );

  for (i=0; i < per_conta.length ; i++){
     var val1 = eval('newData_eval[' + index_d + '].' + depto + "[" + index_p + "]." + name + "[" + i + "].label" );
     var val2 = eval('newData_eval[' + index_d + '].' + depto + "[" + index_p + "]." + name + "[" + i + "].data" );
     var val3 = eval('newData_eval[' + index_d + '].' + depto + "[" + index_p + "]." + name + "[" + i + "].color" );
    
     matriz[i] = { label : val1 , data : parseInt(val2) , color:  val3 }
   
  } 

//recreate
$.plot($("#dynamics"), matriz, {
           series: {
            pie: {
                innerRadius: 0.5,
                show: true
            }
         },
         legend: {
            show: false         
        },
        grid: {
            
        hoverable: true,
        clickable: true
    }
});
console.info('getValueToBars(' + usrId + "," + depto +")");
getValueToBars(usrId, depto);

}

function getValueToBars(usr_id, dept){
    $.ajax({
        type:"POST",
        url: "../backend/graphVar.php?user_id=" + usr_id + "&dept=" + dept + "&fac=" + fac,
        success : function (data){
             console.info(data)
              injectBarVars(data);
        }

    })

}


function injectBarVars(idata){

  var narray = idata.split("/");
  var listA = [0,3,6,9,12];
  var listB = [1,4,7,10,13];
  var listC = [2,5,8,11,14];
$(".wrap-progress li div.bar").css({width : "0%"});
$(".wrap-progress li p span").html('0');


  for (i=0; i < (narray.length)/3 ; i++){
   
       switch(parseInt(narray[listC[i]])){
                    case 1:
                        document.querySelectorAll(".wrap-progress li p span")[0].innerHTML = narray[listA[i]];
                        document.querySelectorAll(".wrap-progress li div.bar")[0].style.width = narray[listB[i]] + "%";
          break;
                    case 2:
                        document.querySelectorAll(".wrap-progress li p span")[1].innerHTML = narray[listA[i]];
                        document.querySelectorAll(".wrap-progress li div.bar")[1].style.width = narray[listB[i]] + "%";
          break;
                    case 3:
                        document.querySelectorAll(".wrap-progress li p span")[2].innerHTML = narray[listA[i]];
                        document.querySelectorAll(".wrap-progress li div.bar")[2].style.width = narray[listB[i]] + "%";
          break;
                    case 4:
                        document.querySelectorAll(".wrap-progress li p span")[3].innerHTML = narray[listA[i]];
                        document.querySelectorAll(".wrap-progress li div.bar")[3].style.width = narray[listB[i]] + "%";
          break;
                    case 5:
                        document.querySelectorAll(".wrap-progress li p span")[4].innerHTML = narray[listA[i]];
                        document.querySelectorAll(".wrap-progress li div.bar")[4].style.width = narray[listB[i]] + "%";
          break;
        }
    }
}

function getUrl(url){

}



</script>
    </body>

<?

} else {

    echo "<script language='javascript'>window.location='../index.php'</script>";
}
?>