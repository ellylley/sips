-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Nov 2024 pada 07.33
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sips`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `activity` text DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `activity_log`
--

INSERT INTO `activity_log` (`id`, `id_user`, `activity`, `timestamp`) VALUES
(1840, 1, 'Mengakses halaman log aktivitas', '2024-10-31 01:28:58'),
(1841, 1, 'Mengakses halaman setting', '2024-10-31 01:29:01'),
(1842, 1, 'Mengakses halaman log aktivitas', '2024-10-31 01:29:03'),
(1843, 1, 'Mengakses halaman pemberitahuan', '2024-10-31 01:29:04'),
(1844, 1, 'Mengakses halaman log aktivitas', '2024-10-31 01:29:06'),
(1845, 1, 'Mengakses halaman manajemen pengumuman', '2024-10-31 01:29:14'),
(1846, 1, 'Mengakses halaman log aktivitas', '2024-10-31 01:29:16'),
(1847, 1, 'Mengakses halaman log aktivitas', '2024-10-31 01:31:27'),
(1848, 1, 'Mengakses halaman pengumuman', '2024-10-31 01:31:35'),
(1849, 1, 'Mengakses halaman log aktivitas', '2024-10-31 01:31:37'),
(1850, 1, 'Mengakses halaman log aktivitas', '2024-10-31 01:32:37'),
(1851, 1, 'Mengakses halaman log aktivitas', '2024-10-31 01:32:55'),
(1852, 1, 'Mengakses halaman log aktivitas', '2024-10-31 01:33:01'),
(1853, 1, 'Mengakses halaman restore user', '2024-10-31 01:33:10'),
(1854, 1, 'Mengakses halaman pengumuman', '2024-10-31 01:33:15'),
(1855, 1, 'Mengakses halaman pemberitahuan', '2024-10-31 01:33:18'),
(1856, 1, 'Mengakses halaman pengumuman', '2024-10-31 01:33:24'),
(1857, 1, 'Mengakses halaman pemberitahuan', '2024-10-31 01:33:56'),
(1858, 1, 'Mengakses halaman pengumuman', '2024-10-31 01:34:14'),
(1859, 1, 'Mengakses halaman pemberitahuan', '2024-10-31 01:42:21'),
(1860, 1, 'Mengakses halaman pengumuman', '2024-10-31 01:42:28'),
(1861, 1, 'Mengakses halaman user', '2024-10-31 01:42:34'),
(1862, 1, 'Mengakses halaman pengumuman', '2024-10-31 01:43:23'),
(1863, 1, 'Mengakses halaman pengumuman', '2024-10-31 01:43:41'),
(1864, 1, 'Mengakses halaman pengumuman', '2024-10-31 01:43:57'),
(1865, 1, 'Mengakses halaman pemberitahuan', '2024-10-31 01:44:02'),
(1866, 1, 'Mengakses halaman pemberitahuan', '2024-10-31 01:44:16'),
(1867, 1, 'Mengakses halaman setting', '2024-10-31 01:44:20'),
(1868, 1, 'Mengakses halaman setting', '2024-10-31 01:44:33'),
(1869, 1, 'Mengakses halaman log aktivitas', '2024-10-31 01:44:34'),
(1870, 1, 'Mengakses halaman log aktivitas', '2024-10-31 01:44:48'),
(1871, 1, 'Mengakses halaman restore user', '2024-10-31 01:45:45'),
(1872, 1, 'Mengakses halaman setting', '2024-10-31 01:45:53'),
(1873, 1, 'Mengakses halaman setting', '2024-10-31 01:46:07'),
(1874, 1, 'Mengakses halaman profile', '2024-10-31 01:46:41'),
(1875, 1, 'Mengakses halaman profile', '2024-10-31 01:46:51'),
(1876, 1, 'Mengakses halaman profile', '2024-10-31 01:47:16'),
(1877, 1, 'Mengakses halaman setting', '2024-10-31 01:47:38'),
(1878, 1, 'Mengakses halaman dashboard', '2024-10-31 01:47:45'),
(1879, 1, 'Mengakses halaman user', '2024-10-31 01:47:47'),
(1880, 1, 'Mengakses halaman kelas', '2024-10-31 01:47:52'),
(1881, 1, 'Mengakses halaman pengumuman', '2024-10-31 01:47:54'),
(1882, 1, 'Mengakses halaman pemberitahuan', '2024-10-31 01:47:57'),
(1883, 1, 'Mengakses halaman setting', '2024-10-31 01:48:06'),
(1884, 1, 'Mengakses halaman log aktivitas', '2024-10-31 01:48:07'),
(1885, 1, 'Mengakses halaman restore user', '2024-10-31 01:48:11'),
(1886, 1, 'Mengakses halaman restore kelas', '2024-10-31 01:48:13'),
(1887, 1, 'Mengakses halaman restore user', '2024-10-31 01:48:17'),
(1888, 1, 'Mengakses halaman restore pengumuman', '2024-10-31 01:48:19'),
(1889, 1, 'Mengakses halaman pengumuman', '2024-10-31 01:48:34'),
(1890, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:04:22'),
(1891, 1, 'Membagikan pengumuman', '2024-10-31 02:04:42'),
(1892, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:04:45'),
(1893, 1, 'Membagikan pengumuman', '2024-10-31 02:05:17'),
(1894, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:05:22'),
(1895, 1, 'Membagikan pengumuman', '2024-10-31 02:07:16'),
(1896, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:07:26'),
(1897, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:10:29'),
(1898, 1, 'Membagikan pengumuman', '2024-10-31 02:10:37'),
(1899, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:10:41'),
(1900, 1, 'Membagikan pengumuman', '2024-10-31 02:12:17'),
(1901, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:12:22'),
(1902, 1, 'Membagikan pengumuman', '2024-10-31 02:16:09'),
(1903, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:16:15'),
(1904, 1, 'Membagikan pengumuman', '2024-10-31 02:18:09'),
(1905, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:18:14'),
(1906, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:18:50'),
(1907, 1, 'Membagikan pengumuman', '2024-10-31 02:18:57'),
(1908, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:19:24'),
(1909, 1, 'Membagikan pengumuman', '2024-10-31 02:19:31'),
(1910, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:19:37'),
(1911, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:22:04'),
(1912, 1, 'Membagikan pengumuman', '2024-10-31 02:22:11'),
(1913, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:22:18'),
(1914, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:30:17'),
(1915, 1, 'Membagikan pengumuman', '2024-10-31 02:31:07'),
(1916, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:31:11'),
(1917, 1, 'Membagikan pengumuman', '2024-10-31 02:33:29'),
(1918, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:33:34'),
(1919, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:40:25'),
(1920, 1, 'Membagikan pengumuman', '2024-10-31 02:40:31'),
(1921, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:40:35'),
(1922, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:43:45'),
(1923, 1, 'Membagikan pengumuman', '2024-10-31 02:43:52'),
(1924, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:43:57'),
(1925, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:48:33'),
(1926, 1, 'Membagikan pengumuman', '2024-10-31 02:48:40'),
(1927, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:48:43'),
(1928, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:52:38'),
(1929, 1, 'Membagikan pengumuman', '2024-10-31 02:52:44'),
(1930, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:52:48'),
(1931, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:54:37'),
(1932, 1, 'Membagikan pengumuman', '2024-10-31 02:54:44'),
(1933, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:54:47'),
(1934, 1, 'Membagikan pengumuman', '2024-10-31 02:57:51'),
(1935, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:58:04'),
(1936, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:59:33'),
(1937, 1, 'Membagikan pengumuman', '2024-10-31 02:59:44'),
(1938, 1, 'Mengakses halaman pengumuman', '2024-10-31 02:59:50'),
(1939, 1, 'Mengakses halaman dashboard', '2024-10-31 03:35:36'),
(1940, 1, 'Mengakses halaman user', '2024-10-31 03:36:42'),
(1941, 1, 'Mengakses halaman kelas', '2024-10-31 03:37:08'),
(1942, 1, 'Mengakses halaman pengumuman', '2024-10-31 03:37:37'),
(1943, 1, 'Mengakses halaman pemberitahuan', '2024-10-31 03:37:53'),
(1944, 1, 'Mengakses halaman setting', '2024-10-31 03:38:24'),
(1945, 1, 'Mengakses halaman log aktivitas', '2024-10-31 03:38:45'),
(1946, 1, 'Mengakses halaman restore user', '2024-10-31 03:39:07'),
(1947, 1, 'Mengakses halaman dashboard', '2024-10-31 03:52:16'),
(1948, 23, 'Mengakses halaman dashboard', '2024-10-31 03:53:21'),
(1949, 23, 'Mengakses halaman pemberitahuan', '2024-10-31 03:55:00'),
(1950, 23, 'Mengakses halaman pengumuman', '2024-10-31 03:55:04'),
(1951, 23, 'Mengakses halaman pemberitahuan', '2024-10-31 03:55:13'),
(1952, 27, 'Mengakses halaman dashboard', '2024-10-31 03:56:07'),
(1953, 27, 'Mengakses halaman pemberitahuan', '2024-10-31 03:56:11'),
(1954, 27, 'Mengakses halaman dashboard', '2024-10-31 03:56:12'),
(1955, 1, 'Mengakses halaman dashboard', '2024-10-31 03:56:55'),
(1956, 1, 'Mengakses halaman profile', '2024-10-31 03:58:04'),
(1957, 1, 'Mengakses halaman user', '2024-10-31 03:59:42'),
(1958, 1, 'Mengakses halaman profile', '2024-10-31 03:59:50'),
(1959, 1, 'Mengakses halaman profile', '2024-10-31 04:03:30'),
(1960, 1, 'mengubah password profile', '2024-10-31 04:03:36'),
(1961, 1, 'Mengakses halaman profile', '2024-10-31 04:03:37'),
(1962, 1, 'mengubah password profile', '2024-10-31 04:04:01'),
(1963, 1, 'Mengakses halaman profile', '2024-10-31 04:04:01'),
(1964, 1, 'mengubah password profile', '2024-10-31 04:04:11'),
(1965, 1, 'Mengakses halaman profile', '2024-10-31 04:04:12'),
(1966, 1, 'mengubah password profile', '2024-10-31 04:04:21'),
(1967, 1, 'Mengakses halaman profile', '2024-10-31 04:04:22'),
(1968, 1, 'Mengakses halaman user', '2024-10-31 04:05:08'),
(1969, 1, 'Mengubah data user', '2024-10-31 04:06:38'),
(1970, 1, 'Mengakses halaman user', '2024-10-31 04:06:39'),
(1971, 1, 'Merestore user yang diedit', '2024-10-31 04:06:50'),
(1972, 1, 'Mengakses halaman user', '2024-10-31 04:06:51'),
(1973, 1, 'Mengakses halaman kelas', '2024-10-31 04:07:15'),
(1974, 1, 'Mengubah data kelas', '2024-10-31 04:08:35'),
(1975, 1, 'Mengakses halaman kelas', '2024-10-31 04:08:36'),
(1976, 1, 'Merestore kelas yang diedit', '2024-10-31 04:08:46'),
(1977, 1, 'Mengakses halaman kelas', '2024-10-31 04:08:47'),
(1978, 1, 'Mengakses halaman pengumuman', '2024-10-31 04:09:07'),
(1979, 1, 'Mengubah data pengumuman', '2024-10-31 04:10:14'),
(1980, 1, 'Mengakses halaman pengumuman', '2024-10-31 04:10:14'),
(1981, 1, 'Merestore pengumuman yang diedit', '2024-10-31 04:10:25'),
(1982, 1, 'Mengakses halaman pengumuman', '2024-10-31 04:10:25'),
(1983, 1, 'Mengakses halaman pemberitahuan', '2024-10-31 04:10:51'),
(1984, 1, 'Mengakses halaman setting', '2024-10-31 04:12:20'),
(1985, 1, 'Mengakses halaman log aktivitas', '2024-10-31 04:12:49'),
(1986, 1, 'Mengakses halaman user', '2024-10-31 04:13:53'),
(1987, 1, 'Menghapus data user', '2024-10-31 04:13:57'),
(1988, 1, 'Mengakses halaman user', '2024-10-31 04:13:58'),
(1989, 1, 'Mengakses halaman kelas', '2024-10-31 04:13:59'),
(1990, 1, 'Menghapus data kelas', '2024-10-31 04:14:02'),
(1991, 1, 'Mengakses halaman kelas', '2024-10-31 04:14:03'),
(1992, 1, 'Mengakses halaman pengumuman', '2024-10-31 04:14:04'),
(1993, 1, 'Menghapus data pengumuman', '2024-10-31 04:14:08'),
(1994, 1, 'Mengakses halaman pengumuman', '2024-10-31 04:14:09'),
(1995, 1, 'Mengakses halaman restore user', '2024-10-31 04:14:12'),
(1996, 1, 'Merestore user', '2024-10-31 04:14:29'),
(1997, 1, 'Mengakses halaman restore user', '2024-10-31 04:14:30'),
(1998, 1, 'Mengakses halaman restore kelas', '2024-10-31 04:14:32'),
(1999, 1, 'Mengakses halaman restore pengumuman', '2024-10-31 04:14:45'),
(2000, 1, 'Merestore pengumuman', '2024-10-31 04:15:02'),
(2001, 1, 'Mengakses halaman restore pengumuman', '2024-10-31 04:15:03'),
(2002, 1, 'Mengakses halaman restore kelas', '2024-10-31 04:15:05'),
(2003, 1, 'Merestore kelas', '2024-10-31 04:15:08'),
(2004, 1, 'Mengakses halaman restore kelas', '2024-10-31 04:15:08'),
(2005, 1, 'Mengakses halaman dashboard', '2024-11-01 17:55:03'),
(2006, 1, 'Mengakses halaman dashboard', '2024-11-01 17:55:56'),
(2007, 1, 'Mengakses halaman user', '2024-11-01 17:56:05'),
(2008, 1, 'Menambah user', '2024-11-01 17:56:58'),
(2009, 1, 'Mengakses halaman user', '2024-11-01 17:56:59'),
(2010, 1, 'Mengubah data user', '2024-11-01 17:57:37'),
(2011, 1, 'Mengakses halaman user', '2024-11-01 17:57:38'),
(2012, 1, 'Merestore user yang diedit', '2024-11-01 17:58:06'),
(2013, 1, 'Mengakses halaman user', '2024-11-01 17:58:07'),
(2014, 1, 'Mengubah data user', '2024-11-01 17:58:15'),
(2015, 1, 'Mengakses halaman user', '2024-11-01 17:58:16'),
(2016, 1, 'Mengubah data user', '2024-11-01 17:58:24'),
(2017, 1, 'Mengakses halaman user', '2024-11-01 17:58:25'),
(2018, 1, 'Merestore user yang diedit', '2024-11-01 17:58:30'),
(2019, 1, 'Mengakses halaman user', '2024-11-01 17:58:31'),
(2020, 1, 'Mereset password user', '2024-11-01 17:58:37'),
(2021, 1, 'Mengakses halaman user', '2024-11-01 17:58:38'),
(2022, 1, 'Menghapus data user', '2024-11-01 17:58:53'),
(2023, 1, 'Mengakses halaman user', '2024-11-01 17:58:58'),
(2024, 1, 'Mengakses halaman kelas', '2024-11-01 17:59:04'),
(2025, 1, 'Menambah data kelas', '2024-11-01 17:59:20'),
(2026, 1, 'Mengakses halaman kelas', '2024-11-01 17:59:21'),
(2027, 1, 'Mengubah data kelas', '2024-11-01 17:59:29'),
(2028, 1, 'Mengakses halaman kelas', '2024-11-01 17:59:30'),
(2029, 1, 'Merestore kelas yang diedit', '2024-11-01 17:59:36'),
(2030, 1, 'Mengakses halaman kelas', '2024-11-01 17:59:37'),
(2031, 1, 'Mengubah data kelas', '2024-11-01 17:59:45'),
(2032, 1, 'Mengakses halaman kelas', '2024-11-01 17:59:46'),
(2033, 1, 'Menghapus data kelas', '2024-11-01 17:59:52'),
(2034, 1, 'Mengakses halaman kelas', '2024-11-01 17:59:54'),
(2035, 1, 'Mengakses halaman pengumuman', '2024-11-01 17:59:56'),
(2036, 1, 'Mengakses halaman kelas', '2024-11-01 17:59:59'),
(2037, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:00:10'),
(2038, 1, 'Menambah data pengumuman', '2024-11-01 18:00:29'),
(2039, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:00:30'),
(2040, 1, 'Mengubah data pengumuman', '2024-11-01 18:00:53'),
(2041, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:00:54'),
(2042, 1, 'Membagikan pengumuman', '2024-11-01 18:01:40'),
(2043, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:01:49'),
(2044, 1, 'Membagikan pengumuman', '2024-11-01 18:02:39'),
(2045, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:02:45'),
(2046, 1, 'Mengakses halaman pemberitahuan', '2024-11-01 18:03:46'),
(2047, 1, 'Mengakses halaman setting', '2024-11-01 18:03:59'),
(2048, 1, 'Mengubah data setting', '2024-11-01 18:04:04'),
(2049, 1, 'Mengakses halaman setting', '2024-11-01 18:04:05'),
(2050, 1, 'Mengubah data setting', '2024-11-01 18:04:08'),
(2051, 1, 'Mengakses halaman setting', '2024-11-01 18:04:09'),
(2052, 1, 'Mengakses halaman log aktivitas', '2024-11-01 18:04:12'),
(2053, 1, 'Mengakses halaman restore user', '2024-11-01 18:04:17'),
(2054, 1, 'Merestore user', '2024-11-01 18:04:21'),
(2055, 1, 'Mengakses halaman restore user', '2024-11-01 18:04:22'),
(2056, 1, 'Mengakses halaman restore kelas', '2024-11-01 18:04:25'),
(2057, 1, 'Merestore kelas', '2024-11-01 18:04:28'),
(2058, 1, 'Mengakses halaman restore kelas', '2024-11-01 18:04:29'),
(2059, 1, 'Mengakses halaman restore pengumuman', '2024-11-01 18:04:32'),
(2060, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:04:38'),
(2061, 1, 'Mengakses halaman profile', '2024-11-01 18:04:42'),
(2062, 1, 'Mengubah data profile', '2024-11-01 18:04:50'),
(2063, 1, 'Mengakses halaman profile', '2024-11-01 18:04:51'),
(2064, 1, 'Mengubah data profile', '2024-11-01 18:05:00'),
(2065, 1, 'Mengakses halaman profile', '2024-11-01 18:05:01'),
(2066, 1, 'Mengakses halaman user', '2024-11-01 18:05:12'),
(2067, 1, 'Mengakses halaman kelas', '2024-11-01 18:05:42'),
(2068, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:06:06'),
(2069, 1, 'Membagikan pengumuman', '2024-11-01 18:06:16'),
(2070, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:06:25'),
(2071, 1, 'Membagikan pengumuman', '2024-11-01 18:06:57'),
(2072, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:07:03'),
(2073, 1, 'Membagikan pengumuman', '2024-11-01 18:07:30'),
(2074, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:07:42'),
(2075, 1, 'Membagikan pengumuman', '2024-11-01 18:08:23'),
(2076, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:08:24'),
(2077, 1, 'Membagikan pengumuman', '2024-11-01 18:08:59'),
(2078, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:09:05'),
(2079, 1, 'Membagikan pengumuman', '2024-11-01 18:09:25'),
(2080, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:09:31'),
(2081, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:12:54'),
(2082, 1, 'Membagikan pengumuman', '2024-11-01 18:13:57'),
(2083, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:14:07'),
(2084, 1, 'Membagikan pengumuman', '2024-11-01 18:14:18'),
(2085, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:14:25'),
(2086, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:15:15'),
(2087, 1, 'Membagikan pengumuman', '2024-11-01 18:15:24'),
(2088, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:15:31'),
(2089, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:20:57'),
(2090, 1, 'Membagikan pengumuman', '2024-11-01 18:21:10'),
(2091, 1, 'Mengakses halaman pengumuman', '2024-11-01 18:21:15'),
(2092, 25, 'Mengakses halaman dashboard', '2024-11-01 18:22:19'),
(2093, 25, 'Mengakses halaman dashboard', '2024-11-01 18:22:22'),
(2094, 25, 'Mengakses halaman pengumuman', '2024-11-01 18:22:24'),
(2095, 25, 'Mengakses halaman pengumuman', '2024-11-01 18:22:25'),
(2096, 25, 'Mengakses halaman pemberitahuan', '2024-11-01 18:22:32'),
(2097, 25, 'Mengakses halaman pengumuman', '2024-11-01 18:22:35'),
(2098, 27, 'Mengakses halaman dashboard', '2024-11-01 18:23:35'),
(2099, 27, 'Mengakses halaman pemberitahuan', '2024-11-01 18:24:05'),
(2100, 27, 'Mengakses halaman profile', '2024-11-01 18:24:26'),
(2101, 27, 'Mengakses halaman dashboard', '2024-11-01 18:24:32'),
(2102, 27, 'Mengakses halaman pemberitahuan', '2024-11-01 18:24:37'),
(2103, 27, 'Mengakses halaman dashboard', '2024-11-01 18:25:09'),
(2104, 26, 'Mengakses halaman dashboard', '2024-11-01 18:26:46'),
(2105, 26, 'Mengakses halaman pemberitahuan', '2024-11-01 18:26:49'),
(2106, 26, 'Mengakses halaman pengumuman', '2024-11-01 18:27:38'),
(2107, 26, 'Menambah data pengumuman', '2024-11-01 18:27:55'),
(2108, 26, 'Mengakses halaman pengumuman', '2024-11-01 18:27:56'),
(2109, 26, 'Membagikan pengumuman', '2024-11-01 18:29:31'),
(2110, 26, 'Mengakses halaman pengumuman', '2024-11-01 18:29:36'),
(2111, 26, 'Membagikan pengumuman', '2024-11-01 18:30:06'),
(2112, 26, 'Mengakses halaman pengumuman', '2024-11-01 18:30:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `backup_kelas`
--

CREATE TABLE `backup_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(255) DEFAULT NULL,
  `jurusan` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `isdelete` int(11) NOT NULL,
  `jenjang` varchar(255) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `backup_kelas`
--

INSERT INTO `backup_kelas` (`id_kelas`, `nama_kelas`, `jurusan`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `isdelete`, `jenjang`, `id_user`) VALUES
(16, 'XII B', 'RPL', '2024-10-21 09:42:11', NULL, NULL, 1, NULL, NULL, 0, 'SMK', 15),
(22, 'XI', 'RPL', '2024-10-22 01:01:32', '2024-10-22 01:02:27', NULL, 1, 1, NULL, 0, 'SMK', 15),
(23, 'X', '', '2024-10-22 01:04:42', NULL, NULL, 1, NULL, NULL, 0, 'SMK', 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `backup_pengumuman`
--

CREATE TABLE `backup_pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `judul` text DEFAULT NULL,
  `isi_pengumuman` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `isdelete` int(11) NOT NULL,
  `file` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `backup_pengumuman`
--

INSERT INTO `backup_pengumuman` (`id_pengumuman`, `judul`, `isi_pengumuman`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `isdelete`, `file`) VALUES
(19, 'tes', 'tes\r\ntes\r\n:\r\nwewe\r\nee', '2024-11-02 01:00:29', 1, NULL, NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `backup_user`
--

CREATE TABLE `backup_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(255) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `id_kelas` varchar(255) DEFAULT NULL,
  `nohp` varchar(255) DEFAULT NULL,
  `jk` varchar(255) DEFAULT NULL,
  `tgl_lhr` date DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `isdelete` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `nis` varchar(255) DEFAULT NULL,
  `nisn` varchar(255) DEFAULT NULL,
  `nuptk` varchar(255) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `backup_user`
--

INSERT INTO `backup_user` (`id_user`, `nama_user`, `email`, `password`, `level`, `id_kelas`, `nohp`, `jk`, `tgl_lhr`, `foto`, `isdelete`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `nis`, `nisn`, `nuptk`, `nik`) VALUES
(1, 'adminn', 'admin@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, NULL, '628888888888', NULL, NULL, 'default.jpg', 0, NULL, NULL, 1, '2024-11-02 01:04:50', NULL, NULL, NULL, NULL, '', ''),
(14, 'pak dedi', 'ellygou1223@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 5, '1', '62895340404752', 'Laki-laki', '2024-10-21', 'default.jpg', 0, NULL, '2024-10-21 07:58:24', 1, '2024-10-21 08:33:04', NULL, NULL, NULL, NULL, '', ''),
(16, 'bu sim', '', 'd41d8cd98f00b204e9800998ecf8427e', 5, NULL, '62', '', '0000-00-00', 'default.jpg', 0, 1, '2024-10-21 09:54:11', NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(17, 'rpl', 'ellygou1223@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 6, '16', '62', '', '0000-00-00', 'default.jpg', 0, 1, '2024-10-22 00:41:58', 1, '2024-10-22 01:11:39', NULL, NULL, NULL, NULL, '', ''),
(19, 'siswa2', 'Dinaoktapia76@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 6, '17', '62', '', '0000-00-00', 'default.jpg', 0, 1, '2024-10-22 01:10:11', NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(20, 'siswa3', 'Imjeno0042@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 6, '24', '62', '', '0000-00-00', 'default.jpg', 0, 1, '2024-10-22 01:10:37', NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(27, 'siswaa', 'ellygou1223@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 6, NULL, '62555555555555', 'Perempuan', '2024-10-25', 'default.jpg', 0, 1, '2024-10-25 10:54:58', 1, '2024-10-28 01:14:48', NULL, NULL, '1', '1', NULL, NULL),
(29, '', '', 'd41d8cd98f00b204e9800998ecf8427e', 6, '1', '62', '', '0000-00-00', 'default.jpg', 0, 1, '2024-10-28 01:15:50', NULL, NULL, NULL, NULL, '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(255) DEFAULT NULL,
  `jurusan` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `isdelete` int(11) NOT NULL,
  `jenjang` varchar(255) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `jurusan`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `isdelete`, `jenjang`, `id_user`) VALUES
(1, 'XII A', 'RPL', '2024-10-15 01:34:23', '2024-10-25 11:02:39', NULL, 1, 1, NULL, 0, 'SMK', 26),
(26, 'XII  B', 'RPL', '2024-10-28 01:16:22', NULL, NULL, 1, NULL, NULL, 0, 'SMK', 26);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `judul` text DEFAULT NULL,
  `isi_pengumuman` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `isdelete` int(11) NOT NULL,
  `file` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `judul`, `isi_pengumuman`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `isdelete`, `file`) VALUES
(9, 'KEGIATAN HARI KAMIS 2024-10-24', 'Selamat sore semua, menginformasikan besok kita menggunakan waktu P5:\n- Sesi 1:\n07.30 - 08.18\n- Sesi 2:\n08.18 - 09.06\n- Istirahat\n09.06 - 09.36\n- Sesi 3\n09.36 - 10.24\n- Sesi 4\n10.24 - 11.12\n- Sesi 5\n11.12 - 12.00\n- Istirahat\n12.00 - 12.30\n- P5\n12.30 - 15.10\n\nInfo:\n• Kegiatan P5 digunakan untuk latihan kegiatan Pentas Seni Sekolah Permata Harapan\n\n\nTerima kasih', '2024-10-16 10:04:05', NULL, '2024-10-25 11:05:39', 1, NULL, NULL, 0, ''),
(18, 'Asesmen Bakat Minat SMK', 'Asesmen Bakat Minat Pada Hari Senin 4 November 2024', '2024-10-28 01:45:55', 1, '2024-10-29 01:05:48', 1, NULL, NULL, 0, 'pdf/DaftarHadir_smk3102_undefinedundefined_20241025143044.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(11) NOT NULL,
  `nama_setting` varchar(255) DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nama_sekolah` text DEFAULT NULL,
  `nohp` varchar(255) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`id_setting`, `nama_setting`, `logo`, `alamat`, `nama_sekolah`, `nohp`, `updated_by`, `updated_at`) VALUES
(1, 'SIPS', 'logo_sph.png', 'Komp.Batu Batam Mas, Jl. Gajah Mada Blok D & E No.1,2,3, Baloi Indah, Kec. Lubuk Baja, Kota Batam, Kepulauan Riau 29444', 'SEKOLAH PERMATA HARAPAN', '(0778) 431318', 1, '2024-11-02 01:04:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(255) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `id_kelas` varchar(255) DEFAULT NULL,
  `nohp` varchar(255) DEFAULT NULL,
  `jk` varchar(255) DEFAULT NULL,
  `tgl_lhr` date DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `isdelete` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `nis` varchar(255) DEFAULT NULL,
  `nisn` varchar(255) DEFAULT NULL,
  `nuptk` varchar(255) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email`, `password`, `level`, `id_kelas`, `nohp`, `jk`, `tgl_lhr`, `foto`, `isdelete`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`, `nis`, `nisn`, `nuptk`, `nik`) VALUES
(1, 'admin', 'admin@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, NULL, '62', NULL, NULL, 'default.jpg', 0, NULL, NULL, 1, '2024-11-02 01:05:00', NULL, NULL, NULL, NULL, '', ''),
(23, 'kepala sekolah', 'kepalasekolah@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 2, NULL, '62111111111111', 'Laki-laki', '2024-10-25', 'default.jpg', 0, 1, '2024-10-25 10:53:02', NULL, NULL, NULL, NULL, '', '', '1', '1'),
(24, 'wakil kepala sekolah', 'wakilkepalasekolah@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 3, NULL, '62222222222222', 'Laki-laki', '2024-10-25', 'default.jpg', 0, 1, '2024-10-25 10:53:35', NULL, NULL, NULL, NULL, '', '', '1', '1'),
(25, 'kesiswaan', 'kesiswaan@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 4, NULL, '62333333333333', 'Laki-laki', '2024-10-25', 'default.jpg', 0, 1, '2024-10-25 10:54:03', NULL, NULL, NULL, NULL, '', '', '1', '1'),
(26, 'guru', 'guru@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 5, NULL, '62444444444444', 'Laki-laki', '2024-10-25', 'default.jpg', 0, 1, '2024-10-25 10:54:30', NULL, NULL, NULL, NULL, '', '', '1', '1'),
(27, 'siswa', 'ellygou1223@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 6, '1', '6282171810404', 'Perempuan', '2024-10-25', 'default.jpg', 0, 1, '2024-10-25 10:54:58', 1, '2024-10-28 01:17:36', NULL, NULL, '1', '1', NULL, NULL),
(28, 'orang tua', 'gouhendragou@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 7, '26', '62895340404752', 'Perempuan', '2024-10-25', 'default.jpg', 0, 1, '2024-10-25 10:55:26', NULL, NULL, NULL, NULL, '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `backup_kelas`
--
ALTER TABLE `backup_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `backup_pengumuman`
--
ALTER TABLE `backup_pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indeks untuk tabel `backup_user`
--
ALTER TABLE `backup_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indeks untuk tabel `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2113;

--
-- AUTO_INCREMENT untuk tabel `backup_kelas`
--
ALTER TABLE `backup_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `backup_pengumuman`
--
ALTER TABLE `backup_pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `backup_user`
--
ALTER TABLE `backup_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
