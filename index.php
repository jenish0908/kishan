<?php
$con = mysqli_connect("sql202.epizy.com","epiz_33891038","K2KWkwshw2e","epiz_33891038_kishan");
if(!$con){
    die("Connection failed");
}

session_start();

if(!isset($_SESSION["sql"])){
    $_SESSION["sql"] = "select * from data LIMIT 1,50";
}

$pageDetect = "false";
$res = mysqli_query($con,"SELECT * FROM data");
$totalData = mysqli_num_rows($res);
if(isset($_SESSION["totalData"])){
    $totalData = $_SESSION["totalData"];
}
$dataPerPage = 50;
$totalPage = ceil($totalData/$dataPerPage);
if(!isset($_GET['page']))
    $page = 1;
else
    $page = $_GET['page'];
$startId = ($page-1) * $dataPerPage;

if(!isset($_GET['pageD']))
    $pageD = false;
else
    $pageD = true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kishan - Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tops">
            See Tops
            </button>
            <!-- <button class="btn btn-primary">see tops</button> -->
            <!-- Button trigger modal -->

            <!-- Modal -->
            <div class="modal fade" id="tops" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Top 5</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body table-re">
                        <table class="table table-stripped">
                            <thead>
                            <?php
                                $mdres = mysqli_query($con,"SELECT * FROM data");
                                if(mysqli_num_rows($mdres) > 0){
                                    $rowwww = mysqli_fetch_assoc($mdres);
                                    foreach($rowwww as $index => $value){
                                        ?>
                                        <th scope="col">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">    
                                                    <?php echo $index; ?>
                                                </label>
                                                
                                            </div>
                                        </th>
                                        <?php
                                    }
                                }
                            ?>
                            </thead>
                            <tbody>
                            <?php
                                $distBrm = "SELECT DISTINCT(brm) from (SELECT brm from tops ORDER by brm DESC LIMIT 5) as t2";
                                $r11 = mysqli_query($con,$distBrm);
                                while($r12 = mysqli_fetch_assoc($r11)){
                                    $distId = "SELECT id from tops WHERE brm = ".$r12['brm']." ORDER BY minutes ASC LIMIT 5";
                                    $r21 = mysqli_query($con,$distId);
                                    while($r22 = mysqli_fetch_assoc($r21)){
                                        $finalData = "SELECT * from data WHERE id = ".$r22['id'];
                                        $r31 = mysqli_query($con,$finalData);
                                        while($r32 = mysqli_fetch_assoc($r31)){
                                            ?>
                                            <tr>
                                                <td> <?php echo $r32['id']; ?></td>
                                                <td> <?php echo $r32['col2']; ?></td>
                                                <td> <?php echo $r32['name']; ?></td>
                                                <td> <?php echo $r32['club']; ?></td>
                                                <td> <?php echo $r32['result']; ?></td>
                                                <td> <?php echo $r32['event']; ?></td>
                                                <td> <?php echo $r32['brm']; ?></td>
                                                <td> <?php echo $r32['date']; ?></td>
                                                <td> <?php echo $r32['club_name']; ?></td>
                                                <td> <?php echo $r32['club_city']; ?></td>
                                                <td> <?php echo $r32['registration_close']; ?></td>
                                                <td> <?php echo $r32['ride_responsible']; ?></td>
                                                <td> <?php echo $r32['brm_name']; ?></td>
                                                <td> <?php echo $r32['start_time']; ?></td>
                                                <td> <?php echo $r32['start_place']; ?></td>
                                                <td> <?php echo $r32['route_link']; ?></td>
                                                <td> <?php echo $r32['fb_link']; ?></td>
                                            </tr>
                                            <!-- echo($r32['id']." ".$r32['name']." ".$r32['result']." ".$r32['brm']."<br>"); -->
                                            <?php

                                        }
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div> -->
                    </div>
                </div>
            </div>
            
                    </div>
        <div class="h1 text-center py-3">Data</div>
        <div>
        <?php
        

        
                if(isset($_POST['submit']))
                    
                        {

                        $col2 = $_POST['col2'];
                        $name = $_POST['name'];
                        $club = $_POST['club'];
                        $result = $_POST['result'];
                        $event = $_POST['event'];
                        $brm = $_POST['brm'];
                        $date = $_POST['date'];
                        $club_name = $_POST['club_name'];
                        $club_city = $_POST['club_city'];
                        $registration_close = $_POST['registration_close'];
                        $ride_responsible = $_POST['ride_responsible'];
                        $brm_name = $_POST['brm_name'];
                        $start_time = $_POST['start_time'];
                        $start_place = $_POST['start_place'];
                        $route_link = $_POST['route_link'];
                        $fb_link = $_POST['fb_link'];
                        
                        $query = "select * from data where name LIKE '".$name."%' AND club LIKE '".$club."%' AND result LIKE '".$result."%' AND event LIKE '".$event."%' AND brm LIKE '".$brm."%' AND date LIKE '".$date."%' AND club_name LIKE '".$club_name."%' AND registration_close LIKE '".$registration_close."%' AND ride_responsible LIKE '".$ride_responsible."%' AND brm_name LIKE '".$brm_name."%' AND start_time LIKE '".$start_time."%' AND start_place LIKE '".$start_place."%' AND route_link LIKE '".$route_link."%' AND fb_link LIKE '".$fb_link."%' LIMIT ".$startId.",".$dataPerPage."";
                        
                        $_SESSION["sql"] = $query;
                        
                    }
                if($pageD){
                    $str = explode("LIMIT",$_SESSION["sql"])[0]." LIMIT ".$startId.",".$dataPerPage."";
                    $_SESSION["sql"] = $str; 
                    

                }
                $resu = mysqli_query($con,explode("LIMIT",$_SESSION["sql"])[0]);
                
                $_SESSION["totalData"] = mysqli_num_rows($resu);
                

            $resultt = mysqli_query($con, $_SESSION["sql"]);
            


                
                ?>
                </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Search
        </button>
    </div>
    <div class="container-fluid table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <!-- Headings -->
                    <?php
                    if(mysqli_num_rows($res) > 0){
                        $row = mysqli_fetch_assoc($res);
                        foreach($row as $index => $value){
                            ?>
                            <th scope="col">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">    
                                        <?php echo $index; ?>
                                    </label>
                                    
                                </div>
                            </th>
                            <?php
                        }
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <!-- Data -->
                <?php
                while($row1 = mysqli_fetch_assoc($resultt)){
                    ?>
                    <tr>
                        <td> <?php echo $row1['id']; ?></td>
                        <td> <?php echo $row1['col2']; ?></td>
                        <td> <?php echo $row1['name']; ?></td>
                        <td> <?php echo $row1['club']; ?></td>
                        <td> <?php echo $row1['result']; ?></td>
                        <td> <?php echo $row1['event']; ?></td>
                        <td> <?php echo $row1['brm']; ?></td>
                        <td> <?php echo $row1['date']; ?></td>
                        <td> <?php echo $row1['club_name']; ?></td>
                        <td> <?php echo $row1['club_city']; ?></td>
                        <td> <?php echo $row1['registration_close']; ?></td>
                        <td> <?php echo $row1['ride_responsible']; ?></td>
                        <td> <?php echo $row1['brm_name']; ?></td>
                        <td> <?php echo $row1['start_time']; ?></td>
                        <td> <?php echo $row1['start_place']; ?></td>
                        <td> <?php echo $row1['route_link']; ?></td>
                        <td> <?php echo $row1['fb_link']; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="container py-2">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if($page == 1){?>
            <li class="page-item disabled">
                        <a class="page-link" href="<?php echo "?page=1&pageD=".$pageDetect; ?>" aria-label="Next">
                            <span aria-hidden="true">FIRST</span>
                        </a>
                    </li>
                <?php }
                 else{
                    ?>
                    <li class="page-item">
                          <a class="page-link" href="<?php echo "?page=1&pageD=".$pageDetect; ?>" aria-label="Next">
                              <span aria-hidden="true">FIRST</span>
                          </a>
                      </li>
                    <?php }?>

                <?php
                if($page == 1){
                    ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php
                }
                else{
                ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo "?page=".($page-1)."&pageD=".$pageDetect; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <?php
                if($page<3){
                  $i = 1;
                  $n = 5;
              }
              else if($page>($totalPage-2))
              {
                  $i = $totalPage-4;
                  $n = $totalPage;
              }
              else{
                  $i = $page-2;
                  $n = $page+2;
              }
                for($i; $i<=$n; $i++){
                    if($page == $i){
                        ?>
                        <li class="page-item active"><a class="page-link" href="<?php echo "?page=$i&pageD=".$pageDetect; ?>"><?php echo $i; ?></a></li>
                        <?php
                    }
                    else{
                        ?>
                        <li class="page-item"><a class="page-link" href="<?php echo "?page=$i&pageD=".$pageDetect; ?>"><?php echo $i; ?></a></li>
                        <?php
                        
                    }
                }

                if($page == $totalPage){
                    ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <li class="page-item disabled">
                        <a class="page-link" href="<?php echo "?page=".$totalPage ?>" aria-label="Next">
                            <span aria-hidden="true">LAST</span>
                        </a>
                    </li>
                    <?php
                }
                else{
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo "?page=".($page+1)."&pageD=".$pageDetect; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo "?page=".$totalPage."&pageD=".$pageDetect; ?>" aria-label="Next">
                            <span aria-hidden="true">LAST</span>
                        </a>
                    </li>
                    <?php
                }
                
                ?>
                
            </ul>
        </nav>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
            <div class="modal-body row g-0 ">
                <?php
                    $res = mysqli_query($con,"SELECT * FROM data");
                    if(mysqli_num_rows($res) > 0){
                        $row = mysqli_fetch_assoc($res);
                        foreach($row as $index => $value){
                            ?>
                            <div class="align-items-center col-6 row flex-row g-0 gap-3 p-3 py-1">
                                <div class="form-label col">    
                                    <?php echo $index; ?>
                                </div>
                                <div class="col-7">
                                    <input type="text" class="form-control rounded-0 col" id="exampleInputEmail1" name="<?php echo $index; ?>" aria-describedby="emailHelp" >
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary" >Save changes</button>
                
            </div>
            </form>
                
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>