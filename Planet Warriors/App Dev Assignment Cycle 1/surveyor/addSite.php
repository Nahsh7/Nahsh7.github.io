<?php
	include("services/security.php");
	//get the firstname and the lastname from the session
	$firstName = $_SESSION['firstName'];
	$lastName = $_SESSION['lastName'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Planet Warrior</title>
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
    crossorigin="anonymous"></script>
	<meta charset="utf-8">
		<title>HTML</title>
		<style>
			.row {
			  display: flex;
			}
			.column {
			  flex: 50%;
			  padding: 16px;
			  height: 250px;
			}
		</style>
</head>

<body>
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="surveyor.html">Planet Warriors</a>

    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
        class="fas fa-bars"></i></button>

    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
      <div class="input-group">
        <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
          aria-describedby="btnNavbarSearch" />
        <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
      </div>
    </form>

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
          aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading">Location </div>
            <!-- TODO change to the Actual form of Adding Locations -->
            <a class="nav-link" href="siteList.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              View Site List
            </a>
            <a class="nav-link" href="surveyorAddLocation.html">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Add Site List
            </a>
            <a class="nav-link" href="surveyorEditLocation.html">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Edit Site List
            </a>
            <a class="nav-link" href="surveyorEditLocation.html">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Remove Site List
            </a>
          </div>
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <div class="x_content">
<div class="container">
  
  <section class="panel panel-default">
	<div class="panel-heading"> 
	<h3 class="panel-title">Panel heading</h3> 
	</div> 
	<div class="panel-body">
		  
<form action="designer-finish.html" class="form-horizontal" role="form">

<div class="form-group">
	<label for="name" class="col-sm-3 control-label">Тип заказа</label>
	<div class="col-sm-9">
		<label class="radio-inline">
	  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Внешный заказ
	</label>
	<label class="radio-inline">
	  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Внутренный заказ
	</label>
	</div>
</div> <!-- form-group // -->

   <div class="form-group">
    <label for="name" class="col-sm-3 control-label">Буюртмачи</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="name" id="name" placeholder="Исм ёки корхона номи">
    </div>
  </div> <!-- form-group // -->
  <div class="form-group">
    <label for="name" class="col-sm-3 control-label">Название продукта</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="name" id="name" placeholder="Название">
    </div>
  </div> <!-- form-group // -->
  <div class="form-group">
    <label for="about" class="col-sm-3 control-label">Описание</label>
    <div class="col-sm-9">
      <textarea class="form-control"></textarea>
    </div>
  </div> <!-- form-group // -->
  <div class="form-group">
    <label for="qty" class="col-sm-3 control-label">Количество</label>
    <div class="col-sm-3">
   <input type="text" class="form-control" name="qty" id="qty" placeholder="шт.">
    </div>
  </div> <!-- form-group // -->
  <div class="form-group">
    <label class="col-sm-3 control-label">Сроки</label>
    <div class="col-sm-3"> 
	  <label class="control-label small" for="date_start">Начало: </label>
	  <input type="text" class="form-control" name="date_start" id="date_start" placeholder="Начало">
    </div>
	<div class="col-sm-3">   
	  <label class="control-label small" for="date_finish">Конец:</label>
	  <input type="text" class="form-control" name="date_finish" id="date_finish" placeholder="Конец">
    </div>
  </div> <!-- form-group // -->
  <div class="form-group">
    <label for="name" class="col-sm-3 control-label">Загрузить</label>
    <div class="col-sm-3">
      <label class="control-label small" for="file_img">Картинка (jpg/png):</label> <input type="file" name="file_img">
    </div>
	<div class="col-sm-3">
      <label class="control-label small" for="file_img">Файлы:</label>  <input type="file" name="file_archive">
    </div>
  </div> <!-- form-group // -->
  <div class="form-group">
    <label for="tech" class="col-sm-3 control-label">Технолог</label>
    <div class="col-sm-3">
   <select class="form-control">
	<option value="">Выберите</option>
	<option value="texnolog2">Технолог 2</option>
	<option value="texnolog3">Технолог 3</option>
   </select>
    </div>
  </div> <!-- form-group // -->
  <hr>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-primary">Отправить</button>
    </div>
  </div> <!-- form-group // -->
</form>
  
</div><!-- panel-body // -->
</section><!-- panel// -->

  
</div> <!-- container// -->
						
						<form action="advsearcher.php" method="get">
    Search this website:<input align="center" type="text" name="search" />
    <input type="submit" value="Search"/> 
</form>
					</div>
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website 2021</div>
            <div>
              <a href="#">Privacy Policy</a>
              &middot;
              <a href="#">Terms &amp; Conditions</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
</body>

</html>