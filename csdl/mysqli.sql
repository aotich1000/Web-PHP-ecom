-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 12, 2021 lúc 03:08 AM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `mysqli`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `user_name`, `password`, `name`) VALUES
(5, 'admin', '$2y$10$EjSK3mhaP/4Goemx/zq/NuzU.TpssBWUbZuZotNRt4DYE/L.VHUka', 'admin'),
(8, 'admin1', '$2y$10$/MOr3htJKu6v9gc3q2gJyeIlSMQRXmjxQ2qTuUge1GJX6SVLoeivC', 'admin1'),
(11, 'admin2', '$2y$10$ctcFV1rfDcfd1FrTFBFWNe6sWZ.8vTKe7sg49disTOqfmU.2AwDSC', 'admin2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_chitiethoadon`
--

CREATE TABLE `tbl_chitiethoadon` (
  `id_hoadon` int(11) NOT NULL,
  `id_sanpham` int(50) NOT NULL,
  `soluongsp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_chitiethoadon`
--

INSERT INTO `tbl_chitiethoadon` (`id_hoadon`, `id_sanpham`, `soluongsp`) VALUES
(32, 12, 1),
(33, 12, 1),
(34, 14, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_chitietphieunhap`
--

CREATE TABLE `tbl_chitietphieunhap` (
  `id_phieunhap` int(11) NOT NULL,
  `id_sanpham` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `dongia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_hoadon`
--

CREATE TABLE `tbl_hoadon` (
  `id_hoadon` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `tong_tien` varchar(100) NOT NULL,
  `sdt` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `pptt` varchar(100) NOT NULL,
  `trangthai` varchar(50) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_hoadon`
--

INSERT INTO `tbl_hoadon` (`id_hoadon`, `id_user`, `diachi`, `tong_tien`, `sdt`, `date`, `pptt`, `trangthai`, `time`) VALUES
(32, 1, 'TP.HCM', '70000000', '0123456789', '2020-12-08', 'Ví điện tử', 'Chưa xử lí', '2020-12-08 10:59:56 PM'),
(33, 1, 'TP.HCM', '70000000', '0123456789', '2021-03-15', 'Ví điện tử', 'Chưa xử lí', '2020-12-08 11:00:11 PM'),
(34, 1, 'TP.HCM', '100000000', '0123456789', '2021-05-12', 'Ví điện tử', 'Chưa xử lí', '21-05-12 03:28:40 AM');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_nhacungcap`
--

CREATE TABLE `tbl_nhacungcap` (
  `id_nhacungcap` int(11) NOT NULL,
  `tenncc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_permission`
--

CREATE TABLE `tbl_permission` (
  `id_permis` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `qladmin` varchar(255) NOT NULL,
  `qluser` varchar(255) NOT NULL,
  `qlhd` varchar(255) NOT NULL,
  `qlsp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_permission`
--

INSERT INTO `tbl_permission` (`id_permis`, `name`, `qladmin`, `qluser`, `qlhd`, `qlsp`) VALUES
(1, 'admin', 'xem,them,repass,xoa,setquyen,', 'xem,them,repass,sua,', 'xem,xuli,', 'xem,them,xoa,sua,'),
(5, 'admin1', '', '', '', ''),
(8, 'admin2', '', '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_phanloaisp`
--

CREATE TABLE `tbl_phanloaisp` (
  `id_loaisp` int(11) NOT NULL,
  `ten_loaisp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_phanloaisp`
--

INSERT INTO `tbl_phanloaisp` (`id_loaisp`, `ten_loaisp`) VALUES
(1, 'Laptop ASUS\r\n'),
(2, 'Laptop ACER'),
(3, 'Laptop MSI'),
(4, 'Laptop LENOVO');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_phieunhap`
--

CREATE TABLE `tbl_phieunhap` (
  `id_phieunhap` int(11) NOT NULL,
  `id_nhacungcap` int(11) NOT NULL,
  `ngaynhap` varchar(255) NOT NULL,
  `tongtien` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_sanpham`
--

CREATE TABLE `tbl_sanpham` (
  `id_sanpham` int(11) NOT NULL,
  `ten_sanpham` varchar(255) NOT NULL,
  `loaisp` int(10) NOT NULL,
  `mota` varchar(255) NOT NULL,
  `gia` varchar(255) NOT NULL,
  `trangthai` varchar(11) NOT NULL,
  `images` varchar(255) NOT NULL,
  `soluong` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_sanpham`
--

INSERT INTO `tbl_sanpham` (`id_sanpham`, `ten_sanpham`, `loaisp`, `mota`, `gia`, `trangthai`, `images`, `soluong`) VALUES
(10, 'GE66-RAIDER-10SF-483VN-1', 1, 'laptop Asus', '50000000', '1', 'GE66-RAIDER-10SF-483VN-1-300x300.jpg', 100),
(11, 'GE66-RAIDER-10SFS-474VN', 1, 'laptop Asus', '100000000', '1', 'GE66-RAIDER-10SFS-474VN-300x300.jpg', 99),
(12, 'GE75-RAIDER-10SFS-076VN-4', 3, 'laptop MSI', '70000000', '1', 'GE75-RAIDER-10SFS-076VN-4-300x300.jpg', 95),
(13, 'NITRO-5-2020-AN515-55-55E3-4', 2, 'laptop ACER', '20000000', '1', 'NITRO-5-2020-AN515-55-55E3-4-300x300.jpg', 98),
(14, 'ZEPHYRUS-G14-GA401II-HE154T', 4, 'laptop Lenovo', '100000000', '1', 'ZEPHYRUS-G14-GA401II-HE154T-300x300.jpg', 98),
(15, 'TUF-A15-FA506IU-AL127T', 1, 'laptop ASUS', '24000000', '1', 'TUF-A15-FA506IU-AL127T-300x300.jpg', 100);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `hoten` varchar(100) NOT NULL,
  `sdt` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `hoten`, `sdt`, `email`, `user_name`, `password`) VALUES
(1, 'Ai-chan', '0123456789', 'aotich@gmail.com', 'aotich', '$2y$10$khO8G2d3hS0EAj1SrBtHq.79XoFQTu2WtCSI.maDPVindAReYY9Uu'),
(12, 'admin', '0123456789', 'aotich3@gmail.com', 'admin', '$2y$10$cx3e1uUo/bakx.9tSxyjh.CKHiREAdZ.Kj5zDAURJIoX9RZNLAiyy');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Chỉ mục cho bảng `tbl_chitiethoadon`
--
ALTER TABLE `tbl_chitiethoadon`
  ADD KEY `abc` (`id_hoadon`);

--
-- Chỉ mục cho bảng `tbl_chitietphieunhap`
--
ALTER TABLE `tbl_chitietphieunhap`
  ADD KEY `nhaphang` (`id_phieunhap`),
  ADD KEY `sanphamnhap` (`id_sanpham`);

--
-- Chỉ mục cho bảng `tbl_hoadon`
--
ALTER TABLE `tbl_hoadon`
  ADD PRIMARY KEY (`id_hoadon`),
  ADD KEY `hoadon_user` (`id_user`);

--
-- Chỉ mục cho bảng `tbl_nhacungcap`
--
ALTER TABLE `tbl_nhacungcap`
  ADD PRIMARY KEY (`id_nhacungcap`);

--
-- Chỉ mục cho bảng `tbl_permission`
--
ALTER TABLE `tbl_permission`
  ADD PRIMARY KEY (`id_permis`);

--
-- Chỉ mục cho bảng `tbl_phanloaisp`
--
ALTER TABLE `tbl_phanloaisp`
  ADD PRIMARY KEY (`id_loaisp`);

--
-- Chỉ mục cho bảng `tbl_phieunhap`
--
ALTER TABLE `tbl_phieunhap`
  ADD PRIMARY KEY (`id_phieunhap`),
  ADD KEY `cungcap` (`id_nhacungcap`);

--
-- Chỉ mục cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD PRIMARY KEY (`id_sanpham`),
  ADD KEY `sdq` (`loaisp`);

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `tbl_hoadon`
--
ALTER TABLE `tbl_hoadon`
  MODIFY `id_hoadon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `tbl_nhacungcap`
--
ALTER TABLE `tbl_nhacungcap`
  MODIFY `id_nhacungcap` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_permission`
--
ALTER TABLE `tbl_permission`
  MODIFY `id_permis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tbl_phanloaisp`
--
ALTER TABLE `tbl_phanloaisp`
  MODIFY `id_loaisp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_phieunhap`
--
ALTER TABLE `tbl_phieunhap`
  MODIFY `id_phieunhap` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  MODIFY `id_sanpham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_chitiethoadon`
--
ALTER TABLE `tbl_chitiethoadon`
  ADD CONSTRAINT `abc` FOREIGN KEY (`id_hoadon`) REFERENCES `tbl_hoadon` (`id_hoadon`);

--
-- Các ràng buộc cho bảng `tbl_chitietphieunhap`
--
ALTER TABLE `tbl_chitietphieunhap`
  ADD CONSTRAINT `nhaphang` FOREIGN KEY (`id_phieunhap`) REFERENCES `tbl_phieunhap` (`id_phieunhap`),
  ADD CONSTRAINT `sanphamnhap` FOREIGN KEY (`id_sanpham`) REFERENCES `tbl_sanpham` (`id_sanpham`);

--
-- Các ràng buộc cho bảng `tbl_hoadon`
--
ALTER TABLE `tbl_hoadon`
  ADD CONSTRAINT `hoadon_user` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`);

--
-- Các ràng buộc cho bảng `tbl_phieunhap`
--
ALTER TABLE `tbl_phieunhap`
  ADD CONSTRAINT `cungcap` FOREIGN KEY (`id_nhacungcap`) REFERENCES `tbl_nhacungcap` (`id_nhacungcap`);

--
-- Các ràng buộc cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD CONSTRAINT `sdq` FOREIGN KEY (`loaisp`) REFERENCES `tbl_phanloaisp` (`id_loaisp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
