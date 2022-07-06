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
                case 'jabatantdelete':
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
                        include "pages/404.php";
        }
} else {
        include "pages/home.php";
}
