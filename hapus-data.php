<?php include "koneksi.php";?>

<?php
$errors = array();
$sukses = false;

$ada_error = false;
$result = '';

$id = (isset($_GET['id_grup'])) ? trim($_GET['id_grup']) : '';

if(!$id) {
	$ada_error = 'Maaf, data tidak dapat diproses.';
} else {
	$query = $pdo->prepare('SELECT id_grup FROM grupc WHERE id_grup = :id_grup');
	$query->execute(array('id_grup' => $id));
	$result = $query->fetch();
	
	if(empty($result)) {
		$ada_error = 'Maaf, data tidak dapat diproses.';
	} else {
		
		$handle = $pdo->prepare('DELETE FROM grupc WHERE id_grup = :id_grup');				
		$handle->execute(array(
			'id_grup' => $result['id_grup']
		));
		
	}
}
?>
	<!-- Custom fonts for this template-->
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  	<!-- Custom styles for this template-->
  	<link href="css/sb-admin-2.min.css" rel="stylesheet">


	<div class="main-content-row">
	<div class="container clearfix">
	
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
		  
			<div class="msg-box">
			  <p>Data berhasil dihapus</p>
			</div>	
			
		  <?php elseif($ada_error): ?>
			
			<p><?php echo $ada_error; ?></p>
		  
		  <?php else: ?>
			<div class="card mb-10">
                                <div class="card-header bg-danger text-white">
                                    Data berhasil di hapus
                                </div>
                                <div class="card-body">
                                    Klik Tombol "OK" untuk kembali ke halaman utama
                                </div>
								<div class="card-body"><a href="supplier.php"><button class="btn btn-primary">Ok</button></a> </div>
                            </div>
			<?php endif; ?>
			
		</div>
	
	</div><!-- .container -->
	</div><!-- .main-content-row -->