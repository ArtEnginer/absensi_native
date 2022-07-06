<?php 
if (isset($_GET['id_cuti'])) {
        $id = $_GET['id_cuti'];
        $database = new Database();
        $db = $database->getConnection();

        $deleteSql = "DELETE FROM surat_cuti WHERE id_cuti = ?";
        $stmt = $db->prepare($deleteSql);
        $stmt->bindParam(1, $_GET['id_cuti']);
        if($stmt->execute()){
                $_SESSION['hasil'] = true;
                $_SESSION['pesan'] = "Berhasil dihapus";
        }else{
                $_SESSION['hasil'] = false; 
                $_SESSION['pesan'] = "Gagal dihapus";
        }
        echo "<meta http-equiv='refresh' content='0;url=?page=cutiread'>";
}
