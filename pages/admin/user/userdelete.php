<?php 
if (isset($_GET['id_user'])) {
        $id = $_GET['id_user'];
        $database = new Database();
        $db = $database->getConnection();

        $deleteSql = "DELETE FROM user WHERE id_user = ?";
        $stmt = $db->prepare($deleteSql);
        $stmt->bindParam(1, $_GET['id_user']);
        if($stmt->execute()){
                $_SESSION['hasil'] = true;
                $_SESSION['pesan'] = "Berhasil dihapus";
        }else{
                $_SESSION['hasil'] = false; 
                $_SESSION['pesan'] = "Gagal dihapus";
        }
        echo "<meta http-equiv='refresh' content='0;url=?page=userread'>";
}
