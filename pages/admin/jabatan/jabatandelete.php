<?php 
if (isset($_GET['id_pangkat'])) {
        $id = $_GET['id_pangkat'];
        $database = new Database();
        $db = $database->getConnection();

        $deleteSql = "DELETE FROM pangkat WHERE id_pangkat = ?";
        $stmt = $db->prepare($deleteSql);
        $stmt->bindParam(1, $_GET['id_pangkat']);
        if($stmt->execute()){
                $_SESSION['hasil'] = true;
                $_SESSION['pesan'] = "Berhasil dihapus";
        }else{
                $_SESSION['hasil'] = false; 
                $_SESSION['pesan'] = "Gagal dihapus";
        }
        echo "<meta http-equiv='refresh' content='0;url=?page=pangkatread'>";
}
