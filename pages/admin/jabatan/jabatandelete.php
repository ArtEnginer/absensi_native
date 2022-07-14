<?php
if (isset($_GET['id_jabatan'])) {
        $id = $_GET['id_jabatan'];
        $database = new Database();
        $db = $database->getConnection();

        $deleteSql = "DELETE FROM jabatan WHERE id_jabatan = ?";
        $stmt = $db->prepare($deleteSql);
        $stmt->bindParam(1, $_GET['id_jabatan']);
        if ($stmt->execute()) {
                $_SESSION['hasil'] = true;
                $_SESSION['pesan'] = "Berhasil dihapus";
        } else {
                $_SESSION['hasil'] = false;
                $_SESSION['pesan'] = "Gagal dihapus";
        }
        echo "<meta http-equiv='refresh' content='0;url=?page=jabatanread'>";
}
