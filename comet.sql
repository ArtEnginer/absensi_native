-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jul 2022 pada 13.12
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comet`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji`
--

CREATE TABLE `gaji` (
  `id` int(10) UNSIGNED NOT NULL,
  `rekening_no` varchar(32) NOT NULL,
  `rekening_bank` varchar(16) NOT NULL,
  `kehadiran` int(11) NOT NULL,
  `gaji_pokok` int(10) UNSIGNED NOT NULL,
  `gaji_bonus` int(10) UNSIGNED NOT NULL,
  `gaji_lembur` int(10) UNSIGNED NOT NULL,
  `bpjs_kesehatan` int(10) UNSIGNED NOT NULL,
  `bpjs_tenaker` int(10) UNSIGNED NOT NULL,
  `pinjaman` int(10) UNSIGNED NOT NULL,
  `biaya_transfer` int(10) UNSIGNED NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT NULL,
  `id_mahasiswa` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nm_jabatan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nm_jabatan`) VALUES
(1, 'Kepala Cabang Kantor'),
(2, 'Bag. Adminitrasi'),
(5, 'Penata Madya Pelayanan Umum'),
(6, 'Account Representative'),
(7, 'Penata Madya Keuangan'),
(8, 'Outsourcing'),
(9, 'internship/mahasiswa/siswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(11) NOT NULL,
  `nomor` varchar(23) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `lokasi` varchar(250) NOT NULL,
  `waktu` date NOT NULL,
  `dana` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `nomor`, `judul`, `id_pegawai`, `lokasi`, `waktu`, `dana`) VALUES
(22, 'K-0002', 'Rapat ke desa Pulang Pisau 2', 1, 'Banjarmasin', '2022-07-12', 'Uang Anggaran 1'),
(24, 'K-0003', 'Ulang Tahun BPJS Ketenagakerjaan', 5, 'Kuala Kapuas ', '2022-07-01', 'Uang Anggaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(12) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `jk` varchar(12) NOT NULL,
  `nim` int(11) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `id_user` int(12) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `nm_pegawai` varchar(250) NOT NULL,
  `jk` varchar(100) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `agama` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `id_jabatan`, `nip`, `nm_pegawai`, `jk`, `alamat`, `agama`, `no_hp`, `email`, `id_user`) VALUES
(4, 2, '028373873', 'Fikry', 'L', 'Kuala Kapuas', 'islam', '08366362662', 'fikry@gmail.com', 12),
(5, 1, '3298392', 'Agus stojo', 'L', 'Kuala Kapuas ', 'Isalam', '082234546754', 'Agusstojo@gmail.com', 13),
(6, 5, '329839212', 'Masfirmansyah', 'L', 'Kuala Kapuas ', 'Isalam', '082234546732', 'Masfirman@gmail.com', 14),
(7, 9, '45453544', 'Mahasiswa Nama Demo', 'P', 'dhdjhds', 'Budha', '4535454', 'demo@comet.com', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_cuti`
--

CREATE TABLE `surat_cuti` (
  `id_cuti` int(11) NOT NULL,
  `awal_cuti` date NOT NULL,
  `akhir_cuti` date NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `file` varchar(250) NOT NULL,
  `status1` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `surat_cuti`
--

INSERT INTO `surat_cuti` (`id_cuti`, `awal_cuti`, `akhir_cuti`, `id_pegawai`, `keterangan`, `file`, `status1`) VALUES
(5, '2022-06-01', '2022-06-01', 1, 'Bepergian jauh', '153-18630048.pdf', 'Disetujui'),
(6, '2022-07-01', '2022-07-05', 2, 'Orang tua sakit', '318-Article Text-1354-1-10-20200513.pdf', 'Ditolak'),
(7, '2022-07-01', '2022-07-05', 6, 'Izin', 'Surat bpjs.pdf', 'Disetujui');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_absen`
--

CREATE TABLE `tb_absen` (
  `id_absen` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tanggal` text NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_absenmhs`
--

CREATE TABLE `tb_absenmhs` (
  `id_absenmhs` int(12) NOT NULL,
  `id_mahasiswa` int(12) NOT NULL,
  `tanggal` text NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_absenpin`
--

CREATE TABLE `tb_absenpin` (
  `id_absenpin` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `tanggal` text NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peringatan`
--

CREATE TABLE `tb_peringatan` (
  `id_sp` int(11) NOT NULL,
  `tgl_surat` date NOT NULL,
  `sp` varchar(50) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `pelanggaran` text NOT NULL,
  `id_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_peringatan`
--

INSERT INTO `tb_peringatan` (`id_sp`, `tgl_surat`, `sp`, `no_surat`, `pelanggaran`, `id_pegawai`) VALUES
(9, '2022-07-05', 'SP/01', 'PGT-0001', 'Lama Libur', 0),
(10, '2022-07-14', 'demo', 'PGT-0000', 'demo', 0),
(11, '2022-02-22', 'demo', 'PGT-0000', 'demo', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pindahtugas`
--

CREATE TABLE `tb_pindahtugas` (
  `id_pindah` int(12) NOT NULL,
  `id_pegawai` int(12) NOT NULL,
  `alasan` varchar(100) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `no_surat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `peran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `peran`) VALUES
(12, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(13, 'pimpinan', '90973652b88fe07d05a4304f0a945de8', 'pimpinan'),
(14, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user'),
(23, 'angga', '8479c86c7afcb56631104f5ce5d6de62', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `surat_cuti`
--
ALTER TABLE `surat_cuti`
  ADD PRIMARY KEY (`id_cuti`);

--
-- Indeks untuk tabel `tb_absen`
--
ALTER TABLE `tb_absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indeks untuk tabel `tb_absenmhs`
--
ALTER TABLE `tb_absenmhs`
  ADD PRIMARY KEY (`id_absenmhs`);

--
-- Indeks untuk tabel `tb_absenpin`
--
ALTER TABLE `tb_absenpin`
  ADD PRIMARY KEY (`id_absenpin`);

--
-- Indeks untuk tabel `tb_peringatan`
--
ALTER TABLE `tb_peringatan`
  ADD PRIMARY KEY (`id_sp`);

--
-- Indeks untuk tabel `tb_pindahtugas`
--
ALTER TABLE `tb_pindahtugas`
  ADD PRIMARY KEY (`id_pindah`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `surat_cuti`
--
ALTER TABLE `surat_cuti`
  MODIFY `id_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_absen`
--
ALTER TABLE `tb_absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_absenmhs`
--
ALTER TABLE `tb_absenmhs`
  MODIFY `id_absenmhs` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_absenpin`
--
ALTER TABLE `tb_absenpin`
  MODIFY `id_absenpin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_peringatan`
--
ALTER TABLE `tb_peringatan`
  MODIFY `id_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_pindahtugas`
--
ALTER TABLE `tb_pindahtugas`
  MODIFY `id_pindah` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
