
<?php include "koneksi.php";?>

<!DOCTYPE html>
<html lang="en">
<?php 

$errors = array();
$sukses = false;

$ada_error = false;
$result = '';

$id = (isset($_GET['id_grup'])) ? trim($_GET['id_grup']) : '';
if(!$id) {
	$ada_error = 'Maaf, data tidak dapat diproses.';
} else {
	$query = $pdo->prepare('SELECT * FROM grupc WHERE id_grup = :id_grup');
	$query->execute(array('id_grup' => $id));
	$result = $query->fetch();
	
	if(empty($result)) {
		$ada_error = 'Maaf, data tidak dapat diproses.';
	}

	$id = (isset($result['id_grup'])) ? trim($result['id_grup']) : '';
	$tim = (isset($result['tim'])) ? trim($result['tim']) : '';
	$menang = (isset($result['menang'])) ? trim($result['menang']) : '';
	$seri = (isset($result['seri'])) ? trim($result['seri']) : '';
  $kalah = (isset($result['kalah'])) ? trim($result['kalah']) :'';
  $point = (isset($result['point'])) ? trim($result['point']) : '';
}

if(isset($_POST['submit'])):	
	
	$id = (isset($_POST['id_grup'])) ? trim($_POST['id_grup']) : '';
	$tim = (isset($_POST['tim'])) ? trim($_POST['tim']) : '';
	$menang = (isset($_POST['menang'])) ? trim($_POST['menang']) : '';
    $seri = (isset($_POST['seri'])) ? trim($_POST['seri']) :'';
    $kalah = (isset($_POST['kalah'])) ? trim($_POST['kalah']) : '';
	$point = (isset($_POST['point'])) ? trim($_POST['point']) : '';
	
	// Validasi ID Supplier
	if(!$id) {
		$errors[] = 'data tidak ada';
	}
	// Validasi
	if(!$tim) {
		$errors[] = 'data tidak boleh kosong';
	}
    if(!$menang) {
		$errors[] = 'data tidak boleh kosong';
	}
    if(!$seri) {
		$errors[] = 'data tidak boleh kosong';
	}
    if(!$kalah) {
		$errors[] = 'data tidak boleh kosong';
	}
    if(!$point) {
		$errors[] = 'data tidak boleh kosong';
	}

	// Jika lolos validasi lakukan hal di bawah ini
	if(empty($errors)):
		
		$prepare_query = 'UPDATE grupc 
        SET tim = :tim,
        menang = :menang,
        seri = :seri,
        kalah = :kalah,
        point = :point
        WHERE id_grup = :id_grup';
		$data = array(
			'tim' => $tim,
			'menang' => $menang,
            'seri' => $seri,
			'kalah' => $kalah,
            'point' => $point,
			'id_grup' => $id,
		);		
		$handle = $pdo->prepare($prepare_query);		
		$sukses = $handle->execute($data);
	
	endif;

endif;
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Edit Supplier</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Menu</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-book"></i>
          <span>Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data :</h6>
            <a class="collapse-item" href="grupc.php">Grup C</a>
          </div>
        </div>
      </li>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0 bg-dark" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <div class="sidebar-brand-text mx-2"><h5>Klasmen Eropa Grup C</h5></div>
          
          <!-- Search -->

          <!-- End Search -->

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->

        <?php if(!empty($errors)): ?>
			
          <div class="msg-box warning-box">
            <p><strong>Error:</strong></p>
            <ul>
              <?php foreach($errors as $error): ?>
                <li><?php echo $error; ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
          
        <?php endif; ?>
        
        <?php if($sukses): ?>
        
          <div class="card mb-10">
            <div class="card-header bg-success text-white">
                Data berhasil Diubah
            </div>
            <div class="card-body">
                Klik Tombol "Lihat" untuk kembali ke halaman utama
            </div>
						<div class="card-body">
              <a href="supplier.php"><button class="btn btn-primary">Lihat</button></a> 
            </div>
        </div>	
          
        <?php elseif($ada_error): ?>
          
          <p><?php echo $ada_error; ?></p>
        
        <?php else: ?>

        <form action="edit-supplier.php?id=<?php echo $id_grup; ?>" method="post">
            <table class="table">
                  <thead class="thead-dark">
                    <tr>				
                      <th colspan="3">EDIT DATA</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td>TIM</td>
                        <td><input type="text" name="tim" value="<?php echo $tim; ?>"></td>
                      </tr>
                      <tr>
                        <td>MENANG</td>
                        <td><input type="text" name="menang" value="<?php echo $menang; ?>"></td>
                      </tr>
                      <tr>
                        <td>SERI</td>
                        <td><input type="text" name="seri" value="<?php echo $seri; ?>"></td>
                      </tr>							
                      <tr>
                        <td>KALAH</td>
                        <td><input type="text" name="kalah" value="<?php echo $kalah; ?>"></td>
                      </tr>
                      <tr>
                        <td>POINT</td>
                        <td><input type="text" name="point" value="<?php echo $point; ?>"></td>
                      </tr>
                  </tbody>                        
            </table>
            <table>
                  <td>
                      <td colspan="2">
                          <td><a href="tambah-data.php"><button type="submit" name="submit" value="submit" class="btn btn-success">Simpan Perubahan</button></td>
                      </td>
                  </td>                       
            </table>
				</form>

        <?php endif; ?>
              <!-- /.container-fluid -->

            <!-- End of Main Content -->


      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Khurotul Nuraini</span><br><br>
            <span><?php echo date("l, d F Y")."<br/>"; ?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin pergi?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Silahakan Klik tombol LogOut jika suda yakin ingin pergi</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
