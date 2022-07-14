<?php
if (isset($_GET['page'])) {
        $page = $_GET['page'];
        switch ($page) {
                case '':
                case 'logout':
                        file_exists('logout.php') ? include 'logout.php' : include "pages/404.php";
                        break;
                case 'home':
                        file_exists('pages/home.php') ? include 'pages/home.php' : include "pages/404.php";
                        break;
                case 'ab':
                        file_exists('pages/admin/absenpegawai/absenpg.php') ? include
                                'pages/admin/absenpegawai/absenpg.php' : include "pages/404.php";
                        break;
                case 'am':
                        file_exists('pages/admin/absenmahasiswa/absenmhs.php') ? include
                                'pages/admin/absenmahasiswa/absenmhs.php' : include "pages/404.php";
                        break;
                case 'cab':
                        file_exists('pages/admin/absenpegawai/cetakabsen.php') ? include
                                'pages/admin/absenpegawai/cetakabsen.php' : include "pages/404.php";
                        break;
                case 'cabm':
                        file_exists('pages/admin/absenmahasiswa/cetakabsen.php') ? include
                                'pages/admin/absenmahasiswa/cetakabsen.php' : include "pages/404.php";
                        break;
                case 'pimpinan':
                        file_exists('pages/admin/absenpimpinan/absenpin.php') ? include
                                'pages/admin/absenpimpinan/absenpin.php' : include "pages/404.php";
                        break;

                        // kegiatan & cetak
                case 'kgcetak':
                        file_exists('pages/admin/kegiatan/kegiatancetak.php') ? include
                                'pages/admin/kegiatan/kegiatancetak.php' : include "pages/404.php";
                        break;
                case 'kglaporan':
                        file_exists('pages/admin/kegiatan/kegiatanlaporan.php') ? include
                                'pages/admin/kegiatan/kegiatanlaporan.php' : include "pages/404.php";
                        break;
                case 'kgview':
                        file_exists('pages/admin/kegiatan/kegiatanview.php') ? include
                                'pages/admin/kegiatan/kegiatanview.php' : include "pages/404.php";
                        break;
                case 'kgdetail':
                        file_exists('pages/admin/kegiatan/kegiatandetail.php') ? include
                                'pages/admin/kegiatan/kegiatandetail.php' : include "pages/404.php";
                        break;
                        // aprove & cetak
                case 'kecetak':
                        file_exists('pages/admin/cuti/cuticetak.php') ? include
                                'pages/admin/cuti/cuticetak.php' : include "pages/404.php";
                        break;
                case 'cutilaporan':
                        file_exists('pages/admin/cuti/cutilaporan.php') ? include
                                'pages/admin/cuti/cutilaporan.php' : include "pages/404.php";
                        break;
                case 'cutiview':
                        file_exists('pages/admin/cuti/cutiview.php') ? include
                                'pages/admin/cuti/cutiview.php' : include "pages/404.php";
                        break;
                case 'tambahcuti':
                        file_exists('pages/admin/cuti/tambahcuti.php') ? include
                                'pages/admin/cuti/tambahcuti.php' : include "pages/404.php";
                        break;
                case 'cutiapprove':
                        file_exists('pages/admin/cuti/approvecuti.php') ? include
                                'pages/admin/cuti/approvecuti.php' : include "pages/404.php";
                        break;
                case 'cutidetail':
                        file_exists('pages/admin/cuti/cutidetail.php') ? include
                                'pages/admin/cuti/cutidetail.php' : include "pages/404.php";
                        break;


                        // user
                case 'userread':
                        file_exists('pages/admin/user/userread.php') ? include
                                'pages/admin/user/userread.php' : include "pages/404.php";
                        break;
                case 'userupdate':
                        file_exists('pages/admin/user/userupdate.php') ? include
                                'pages/admin/user/userupdate.php' : include "pages/404.php";
                        break;
                case 'userdelete':
                        file_exists('pages/admin/user/userdelete.php') ? include
                                'pages/admin/user/userdelete.php' : include "pages/404.php";
                        break;
                        // user mahasiswa
                case 'usermhread':
                        file_exists('pages/admin/usermh/usermhread.php') ? include
                                'pages/admin/usermh/usermhread.php' : include "pages/404.php";
                        break;
                case 'usermhupdate':
                        file_exists('pages/admin/usermh/usermhupdate.php') ? include
                                'pages/admin/usermh/usermhupdate.php' : include "pages/404.php";
                        break;
                case 'usermhdelete':
                        file_exists('pages/admin/usermh/usermhdelete.php') ? include
                                'pages/admin/usermh/usermhdelete.php' : include "pages/404.php";
                        break;


                        // cuti
                case 'cutiread':
                        file_exists('pages/admin/cuti/cutiread.php') ? include
                                'pages/admin/cuti/cutiread.php' : include "pages/404.php";
                        break;
                case 'cuticreate':
                        file_exists('pages/admin/cuti/cuticreate.php') ? include
                                'pages/admin/cuti/cuticreate.php' : include "pages/404.php";
                case 'cutiupdate':
                        file_exists('pages/admin/cuti/cutiupdate.php') ? include
                                'pages/admin/cuti/cutiupdate.php' : include "pages/404.php";
                        break;
                case 'cutidelete':
                        file_exists('pages/admin/cuti/cutidelete.php') ? include
                                'pages/admin/cuti/cutidelete.php' : include "pages/404.php";
                        break;

                        // pangkat jabatan
                case 'jabatanread':
                        file_exists('pages/admin/jabatan/jabatanread.php') ? include
                                'pages/admin/jabatan/jabatanread.php' : include "pages/404.php";
                        break;
                case 'jabatancreate':
                        file_exists('pages/admin/jabatan/jabatancreate.php') ? include
                                'pages/admin/jabatan/jabatancreate.php' : include "pages/404.php";
                        break;
                case 'jabatanupdate':
                        file_exists('pages/admin/jabatan/jabatanupdate.php') ? include
                                'pages/admin/jabatan/jabatanupdate.php' : include "pages/404.php";
                        break;
                case 'jabatandelete':
                        file_exists('pages/admin/jabatan/jabatandelete.php') ? include
                                'pages/admin/jabatan/jabatandelete.php' : include "pages/404.php";
                        break;

                        // pegawai
                case 'pegawairead':
                        file_exists('pages/admin/pegawai/pegawairead.php') ? include
                                'pages/admin/pegawai/pegawairead.php' : include "pages/404.php";
                        break;
                case 'pegawaicreate':
                        file_exists('pages/admin/pegawai/pegawaicreate.php') ? include
                                'pages/admin/pegawai/pegawaicreate.php' : include "pages/404.php";
                        break;
                case 'pegawaiupdate':
                        file_exists('pages/admin/pegawai/pegawaiupdate.php') ? include
                                'pages/admin/pegawai/pegawaiupdate.php' : include "pages/404.php";
                        break;
                case 'pegawaidelete':
                        file_exists('pages/admin/pegawai/pegawaidelete.php') ? include
                                'pages/admin/pegawai/pegawaidelete.php' : include "pages/404.php";
                        break;

                        // mahasiswa
                case 'mahasiswaread':
                        file_exists('pages/admin/mahasiswa/mahasiswaread.php') ? include
                                'pages/admin/mahasiswa/mahasiswaread.php' : include "pages/404.php";
                        break;
                case 'mahasiswacreate':
                        file_exists('pages/admin/mahasiswa/mahasiswacreate.php') ? include
                                'pages/admin/mahasiswa/mahasiswacreate.php' : include "pages/404.php";
                        break;
                case 'mahasiswaupdate':
                        file_exists('pages/admin/mahasiswa/mahasiswaupdate.php') ? include
                                'pages/admin/mahasiswa/mahasiswaupdate.php' : include "pages/404.php";
                        break;
                case 'mahasiswadelete':
                        file_exists('pages/admin/mahasiswa/mahasiswadelete.php') ? include
                                'pages/admin/mahasiswa/mahasiswadelete.php' : include "pages/404.php";
                        break;


                        // Gaji
                case 'gaji':
                        file_exists('pages/admin/gaji/index.php') ? include
                                'pages/admin/gaji/index.php' : include "pages/404.php";
                        break;
                case 'gajicreate':
                        file_exists('pages/admin/gaji/gajicreate.php') ? include
                                'pages/admin/gaji/gajicreate.php' : include "pages/404.php";
                        break;
                case 'gajidetail':
                        file_exists('pages/admin/gaji/gajidetail.php') ? include
                                'pages/admin/gaji/gajidetail.php' : include "pages/404.php";
                        break;
                case 'gajiupdate':
                        file_exists('pages/admin/gaji/gajiupdate.php') ? include
                                'pages/admin/gaji/gajiupdate.php' : include "pages/404.php";
                        break;
                case 'gajidelete':
                        file_exists('pages/admin/gaji/gajidelete.php') ? include
                                'pages/admin/gaji/gajidelete.php' : include "pages/404.php";
                        break;

                        // Gaji Mahasiswa
                case 'gajimahasiswa':
                        file_exists('pages/admin/gajimahasiswa/index.php') ? include
                                'pages/admin/gajimahasiswa/index.php' : include "pages/404.php";
                        break;
                case 'gajicreatemahasiswa':
                        file_exists('pages/admin/gajimahasiswa/gajicreate.php') ? include
                                'pages/admin/gajimahasiswa/gajicreate.php' : include "pages/404.php";
                        break;
                case 'gajidetailmahasiswa':
                        file_exists('pages/admin/gajimahasiswa/gajidetail.php') ? include
                                'pages/admin/gajimahasiswa/gajidetail.php' : include "pages/404.php";
                        break;
                case 'gajiupdatemahasiswa':
                        file_exists('pages/admin/gajimahasiswa/gajiupdate.php') ? include
                                'pages/admin/gajimahasiswa/gajiupdate.php' : include "pages/404.php";
                        break;
                case 'gajideletemahasiswa':
                        file_exists('pages/admin/gajimahasiswa/gajidelete.php') ? include
                                'pages/admin/gajimahasiswa/gajidelete.php' : include "pages/404.php";
                        break;

                        // kegiatan
                case 'kread':
                        file_exists('pages/admin/kegiatan/kegiatanread.php') ? include
                                'pages/admin/kegiatan/kegiatanread.php' : include "pages/404.php";
                        break;
                case 'kcreate':
                        file_exists('pages/admin/kegiatan/kegiatancreate.php') ? include
                                'pages/admin/kegiatan/kegiatancreate.php' : include "pages/404.php";
                        break;
                case 'kupdate':
                        file_exists('pages/admin/kegiatan/kegiatanupdate.php') ? include
                                'pages/admin/kegiatan/kegiatanupdate.php' : include "pages/404.php";
                        break;

                case 'kdelete':
                        file_exists('pages/admin/kegiatan/kegiatandelete.php') ? include
                                'pages/admin/kegiatan/kegiatandelete.php' : include "pages/404.php";
                        break;

                        // peringatan
                case 'pread':
                        file_exists('pages/admin/peringatan/peringatanread.php') ? include
                                'pages/admin/peringatan/peringatanread.php' : include "pages/404.php";
                        break;
                case 'pcreate':
                        file_exists('pages/admin/peringatan/peringatancreate.php') ? include
                                'pages/admin/peringatan/peringatancreate.php' : include "pages/404.php";
                        break;
                case 'pupdate':
                        file_exists('pages/admin/peringatan/peringatanupdate.php') ? include
                                'pages/admin/peringatan/peringatanupdate.php' : include "pages/404.php";
                        break;
                case 'pdelete':
                        file_exists('pages/admin/peringatan/peringatandelete.php') ? include
                                'pages/admin/peringatan/peringatandelete.php' : include "pages/404.php";
                        break;
                        // peringtan & cetak
                case 'pcetak':
                        file_exists('pages/admin/peringatan/peringatancetak.php') ? include
                                'pages/admin/peringatan/peringatancetak.php' : include "pages/404.php";
                        break;
                case 'plaporan':
                        file_exists('pages/admin/peringatan/peringatanlaporan.php') ? include
                                'pages/admin/peringatan/peringatanlaporan.php' : include "pages/404.php";
                        break;
                case 'pview':
                        file_exists('pages/admin/peringatan/peringatanview.php') ? include
                                'pages/admin/peringatan/peringatanview.php' : include "pages/404.php";
                        break;
                case 'pdetail':
                        file_exists('pages/admin/peringatan/peringatandetail.php') ? include
                                'pages/admin/peringatan/peringatandetail.php' : include "pages/404.php";
                        break;

                // Pindah tugas
                case 'ptugas':
                        file_exists('pages/admin/pindahtugas/index.php') ? include
                        'pages/admin/pindahtugas/index.php' : include "pages/404.php";
                        break;
                case 'ptugascreate':
                        file_exists('pages/admin/pindahtugas/pindahtugascreate.php') ? include
                        'pages/admin/pindahtugas/pindahtugascreate.php' : include "pages/404.php";
                        break;
                case 'ptugasupdate':
                        file_exists('pages/admin/pindahtugas/pindahtugasupdate.php') ? include
                        'pages/admin/pindahtugas/pindahtugasupdate.php' : include "pages/404.php";
                        break;
                case 'ptugasdelete':
                        file_exists('pages/admin/pindahtugas/pindahtugasdelete.php') ? include
                        'pages/admin/pindahtugas/pindahtugasdelete.php' : include "pages/404.php";
                        break;
                case 'ptugasdetail':
                        file_exists('pages/admin/pindahtugas/pindahtugasdetail.php') ? include
                        'pages/admin/pindahtugas/pindahtugasdetail.php' : include "pages/404.php";
                        break;


                include "pages/404.php";
        }
} else {
        include "pages/home.php";
}
