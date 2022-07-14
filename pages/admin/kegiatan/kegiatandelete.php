<?php
if (isset($_GET['id_kegiatan'])) {
        $id = $_GET['id_kegiatan'];
        $database = new Database();
        $db = $database->getConnection();

        $deleteSql = "DELETE FROM kegiatan WHERE id_kegiatan = ?";
        $stmt = $db->prepare($deleteSql);
        $stmt->bindParam(1, $_GET['id_kegiatan']);
        if ($stmt->execute()) {
                $_SESSION['hasil'] = true;
                $_SESSION['pesan'] = "Berhasil dihapus";
        } else {
                $_SESSION['hasil'] = false;
                $_SESSION['pesan'] = "Gagal dihapus";
        }
        echo "<meta http-equiv='refresh' content='0;url=?page=kread'>";
}
