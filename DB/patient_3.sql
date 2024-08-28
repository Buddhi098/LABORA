-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2024 at 08:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `patient_3`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `Id` int(11) NOT NULL,
  `Ref_No` varchar(255) NOT NULL,
  `Test_Type` varchar(255) NOT NULL,
  `Appointment_Date` date NOT NULL,
  `Appointment_Time` time NOT NULL,
  `Appointment_Duration` time NOT NULL,
  `Appointment_Status` text NOT NULL COMMENT 'Pending / Approved / Rejected / Completed/ Expired / Canceled',
  `Appointment_Notes` text NOT NULL,
  `patient_email` varchar(255) NOT NULL,
  `payment_method` varchar(20) NOT NULL COMMENT '0-online 1-onsite',
  `payment_status` varchar(20) NOT NULL COMMENT '0-paid 1-unpaid 2-refunded',
  `cost` float NOT NULL,
  `prescription` varchar(100) NOT NULL,
  `refund_code` varchar(50) NOT NULL,
  `refund_status` varchar(20) NOT NULL COMMENT 'pending / refunded',
  `pass_code` varchar(100) NOT NULL COMMENT 'this use for QR code',
  `active_status` int(11) NOT NULL DEFAULT 1,
  `date` date NOT NULL,
  `test_type_id` int(11) NOT NULL,
  `mlt_active` int(11) NOT NULL DEFAULT 1,
  `reject_note` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`Id`, `Ref_No`, `Test_Type`, `Appointment_Date`, `Appointment_Time`, `Appointment_Duration`, `Appointment_Status`, `Appointment_Notes`, `patient_email`, `payment_method`, `payment_status`, `cost`, `prescription`, `refund_code`, `refund_status`, `pass_code`, `active_status`, `date`, `test_type_id`, `mlt_active`, `reject_note`) VALUES
(1, 'LB-0001', 'Complete Blood Count (CBC)', '2024-04-30', '10:00:00', '00:20:00', 'Rejected', 'No Special Note', 'buddhinadeeshan97@gmail.com', 'onsite', 'unpaid', 1200, 'PR-1.png', '', '', '', 1, '2024-04-29', 1, 1, ''),
(2, 'LB-0002', 'Comprehensive Metabolic Panel', '2024-04-30', '09:15:00', '00:15:00', 'Rejected', 'Velit corporis conse', 'buddhinadeeshan97@gmail.com', 'onsite', 'unpaid', 200, '', '', '', '', 1, '2024-04-29', 3, 1, ''),
(3, 'LB-0003', 'Lipid Panel', '2024-04-30', '11:40:00', '00:20:00', 'Canceled', 'Reprehenderit veniam', 'buddhinadeeshan97@gmail.com', 'online', 'paid', 300, '', '', 'pending', '', 1, '2024-04-29', 5, 1, ''),
(4, 'LB-0004', 'Basic Metabolic Panel', '2024-04-30', '08:00:00', '00:15:00', 'Canceled', 'Est dolorem et volup', 'buddhinadeeshan97@gmail.com', 'online', 'paid', 800, '', '', 'pending', '', 1, '2024-04-29', 2, 1, ''),
(5, 'LB-0005', 'Lipid Panel', '2024-04-30', '01:40:00', '00:20:00', 'Canceled', 'Sequi eum dolores ip', 'buddhinadeeshan97@gmail.com', 'online', 'paid', 300, '', '', 'pending', '', 1, '2024-04-29', 5, 1, ''),
(6, 'LB-0006', 'Thyroid Function Tests', '2024-04-30', '08:35:00', '00:10:00', 'Canceled', 'Deleniti magni qui u', 'buddhinadeeshan97@gmail.com', 'online', 'paid', 300, '', '', 'pending', '', 1, '2024-04-29', 6, 1, ''),
(7, 'LB-0007', 'Lipid Panel', '2024-04-30', '08:45:00', '00:20:00', 'Completed', 'Quasi accusamus duci', 'buddhinadeeshan97@gmail.com', 'online', 'paid', 300, '', '', '', 'kgcQmCNqhzPSoQaQCETS', 1, '2024-03-13', 5, 1, ''),
(8, 'LB-0008', 'Thyroid Function Tests', '2024-04-30', '09:40:00', '00:10:00', 'Completed', 'Dolor voluptates nes', 'buddhinadeeshan97@gmail.com', 'online', 'paid', 300, '', '', '', 'jxvgannF2xhgGlS6aUaN', 1, '2024-01-17', 6, 1, ''),
(9, 'LB-0009', 'Complete Blood Count (CBC)', '2024-04-30', '01:00:00', '00:20:00', 'Approved', 'Veniam qui officia', 'buddhinadeeshan97@gmail.com', 'online', 'paid', 1200, '', '', '', '', 1, '2024-04-29', 1, 1, ''),
(10, 'LB-0010', 'Lipid Panel', '2024-04-30', '03:00:00', '00:20:00', 'Rejected', 'Dolorem tempore est', 'birigov756@buzblox.com', 'onsite', 'unpaid', 300, '', '', '', '', 1, '2024-04-29', 5, 1, ''),
(11, 'LB-0011', 'Lipid Panel', '2024-05-01', '08:00:00', '00:20:00', 'Approved', 'Ut dicta molestias d', 'birigov756@buzblox.com', 'onsite', 'unpaid', 300, '', '', '', '', 1, '2024-04-29', 5, 1, ''),
(12, 'LB-0012', 'Basic Metabolic Panel', '2024-04-30', '11:05:00', '00:15:00', 'Pending', 'Aliquip nemo aliquam', 'buddhinadeeshan97@gmail.com', 'onsite', 'unpaid', 800, '', '', '', '', 1, '2024-04-29', 2, 1, ''),
(13, 'LB-0013', 'Thyroid Function Tests', '2024-04-30', '08:15:00', '00:10:00', 'Rejected', 'Qui omnis temporibus', 'buddhinadeeshan97@gmail.com', 'onsite', 'unpaid', 300, '', '', '', '', 1, '2024-04-29', 6, 1, 'asds'),
(14, 'LB-0014', 'Lipid Panel', '2024-05-03', '08:00:00', '00:20:00', 'Rejected', 'Ut pariatur Et quam', 'buddhinadeeshan97@gmail.com', 'online', 'paid', 300, '', '', '', '', 1, '2024-04-29', 5, 1, ''),
(15, 'LB-0015', 'Lipid Panel', '2024-05-03', '08:20:00', '00:20:00', 'Completed', 'Fugiat consequat Er', 'buddhinadeeshan97@gmail.com', 'onsite', 'paid', 300, '', '', '', '8LuWbJosertUYDc3W9Qa', 1, '2024-01-18', 5, 1, ''),
(16, 'LB-0016', 'Comprehensive Metabolic Panel', '2024-06-05', '08:00:00', '00:15:00', 'Pending', 'Quia tenetur eligend', 'buddhinadeeshan97@gmail.com', 'onsite', 'unpaid', 200, '', '', '', '', 1, '2024-04-29', 3, 1, ''),
(17, 'LB-0017', 'Lipid Panel', '2024-02-01', '08:20:00', '00:20:00', 'Pending', '', 'fogekol593@funvane.com', 'online', 'paid', 300, '', '', '', '', 1, '2024-04-29', 5, 1, ''),
(18, 'LB-0018', 'Metabolic Panel', '2024-01-01', '08:40:00', '00:15:00', 'Pending', '', 'fogekol593@funvane.com', 'online', 'paid', 200, '', '', '', '', 1, '2024-04-29', 3, 1, ''),
(19, 'LB-0019', 'Basic Metabolic Panel', '2024-03-03', '09:25:00', '00:15:00', 'Pending', '', 'fogekol593@funvane.com', 'online', 'paid', 800, '', '', '', '', 1, '2024-04-29', 2, 1, ''),
(20, 'LB-0020', 'Basic Metabolic Panel', '2024-05-06', '08:00:00', '00:15:00', 'Pending', '', 'fogekol593@funvane.com', 'online', 'paid', 800, '', '', '', '', 1, '2024-04-29', 2, 1, ''),
(21, 'LB-0021', 'Thyroid Function Tests', '2024-02-11', '09:10:00', '00:10:00', 'Pending', '', 'fogekol593@funvane.com', 'online', 'paid', 300, '', '', '', '', 1, '2024-04-29', 6, 1, ''),
(22, 'LB-0022', 'Basic Metabolic Panel', '2024-05-10', '08:30:00', '00:15:00', 'Pending', '', 'sofeya7375@dxice.com', 'online', 'paid', 800, '', '', '', '', 1, '2024-04-29', 2, 1, ''),
(23, 'LB-0023', 'Metabolic Panel', '2024-04-26', '09:15:00', '00:15:00', 'Completed', '', 'sofeya7375@dxice.com', 'online', 'unpaid', 200, '', '', '', '', 1, '2024-04-29', 3, 1, ''),
(24, 'LB-0024', 'Thyroid Function Tests', '2024-04-27', '08:45:00', '00:10:00', 'Completed', '', 'sofeya7375@dxice.com', 'online', 'paid', 300, '', '', '', '', 1, '2024-04-29', 6, 1, ''),
(25, 'LB-0025', 'Metabolic Panel', '2024-04-24', '08:50:00', '00:15:00', 'Completed', '', 'sofeya7375@dxice.com', 'online', 'paid', 200, '', '', '', '', 1, '2024-04-29', 3, 1, ''),
(26, 'LB-0026', 'Metabolic Panel', '2024-05-04', '08:30:00', '00:15:00', 'Pending', '', 'sofeya7375@dxice.com', 'online', 'paid', 200, '', '', '', '', 1, '2024-04-29', 3, 1, ''),
(27, 'LB-0027', 'Basic Metabolic Panel', '2024-04-23', '08:30:00', '00:15:00', 'Completed', '', 'sofeya7375@dxice.com', 'online', 'paid', 800, '', '', '', '', 1, '2024-04-29', 2, 1, ''),
(28, 'LB-0028', 'Lipid Panel', '2024-04-25', '10:40:00', '00:20:00', 'Completed', '', 'sofeya7375@dxice.com', 'online', 'paid', 300, '', '', '', '', 1, '2024-04-29', 5, 1, ''),
(29, 'LB-0029', 'Metabolic Panel', '2024-04-28', '09:00:00', '00:15:00', 'Completed', '', 'sofeya7375@dxice.com', 'onsite', 'paid', 200, '', '', '', '', 1, '2024-04-30', 3, 1, ''),
(30, 'LB-0030', 'Basic Metabolic Panel', '2024-04-28', '08:00:00', '00:15:00', 'Completed', '', 'sofeya7375@dxice.com', 'onsite', 'paid', 800, '', '', '', '', 1, '2024-04-30', 2, 1, ''),
(31, 'LB-0031', 'Lipid Panel', '2024-05-29', '09:20:00', '00:20:00', 'Completed', '', 'sofeya7375@dxice.com', 'onsite', 'paid', 300, '', '', '', '', 1, '2024-04-30', 5, 1, ''),
(32, 'LB-0032', 'Basic Metabolic Panel', '2024-02-27', '10:00:00', '00:15:00', 'Completed', '', 'sofeya7375@dxice.com', 'onsite', 'paid', 800, '', '', '', '', 1, '2024-04-30', 2, 1, ''),
(33, 'LB-0033', 'Basic Metabolic Panel', '2024-05-22', '10:00:00', '00:15:00', 'Pending', '', 'sofeya7375@dxice.com', 'onsite', 'unpaid', 800, '', '', '', '', 1, '2024-04-30', 2, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` int(20) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(100) NOT NULL,
  `reply` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

CREATE TABLE `emp` (
  `empid` int(255) NOT NULL,
  `empname` varchar(255) NOT NULL,
  `empemail` varchar(255) NOT NULL,
  `emppwd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `full_name`, `email`, `phone`, `dob`, `address`, `gender`, `role`, `password`) VALUES
(0, 'Ashen', 'admin@123', '123', '2023-11-07', 'no', 'male', 'admin', '123'),
(1, 'Avidu', 'lab@123', '12345', '2023-12-05', '123', 'male', 'lab_assistant', '123'),
(2, 'Ashen', 'rep@123', '1234567890', '2024-01-16', 'no', 'male', 'receptionist', '123'),
(3, 'Ashen', 'mlt@123', '1234567890', '2023-11-14', 'no', 'male', 'MLT', '123'),
(4, 'Praveena', 'inv@123', '1234567890', '2024-02-16', '123', 'male', 'inventory_manager', '123'),
(5, 'Avidu', 'sup@123', '12345', '2023-12-05', '123', 'male', 'supplier', '123'),
(6, 'Nimali', 'ss@d', '0703212456', '1998-06-25', 'No 23', 'female', 'supplier', '$2y$10$o0qWIN9djHR4iolvmTrW7.Tygxp9NCMTahsoivsZXx8EGyVuuhG2q'),
(7, 'saman', 'sup@ddd', '0723212456', '1996-06-30', 'No 45', 'male', 'supplier', '$2y$10$qWcy3fwjHWdhr/21bnMxSOVXNASVEyH5tXWdDgDB4C5kPbmm95936');

-- --------------------------------------------------------

--
-- Table structure for table `holiday_calendar`
--

CREATE TABLE `holiday_calendar` (
  `id` int(11) NOT NULL,
  `holiday` date NOT NULL,
  `reason` varchar(200) NOT NULL,
  `delete_status` int(11) NOT NULL COMMENT '0-delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `holiday_calendar`
--

INSERT INTO `holiday_calendar` (`id`, `holiday`, `reason`, `delete_status`) VALUES
(2, '2024-05-09', 'Poya day', 1),
(3, '2024-04-30', 'Closed', 1),
(4, '2024-05-03', 'New Holiday', 1),
(5, '2024-05-01', 'New Holiday2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventorychemical`
--

CREATE TABLE `inventorychemical` (
  `Item_Id` int(11) NOT NULL,
  `Item_Name` varchar(255) DEFAULT NULL,
  `Reorder_Level` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_items`
--

CREATE TABLE `inventory_items` (
  `id` int(11) NOT NULL,
  `Item_name` varchar(40) NOT NULL,
  `reorder_limit` int(11) NOT NULL,
  `description` text NOT NULL,
  `manufacturer` varchar(30) DEFAULT NULL,
  `unit_of_measure` varchar(50) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `is_removed` int(11) NOT NULL DEFAULT 0 COMMENT 'removed - 1 / default-0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_items`
--

INSERT INTO `inventory_items` (`id`, `Item_name`, `reorder_limit`, `description`, `manufacturer`, `unit_of_measure`, `quantity`, `is_removed`) VALUES
(1, 'Ethanol', 3000, 'Pure ethanol for lab use', 'Sigma Aldrich', 'ml', 0, 0),
(2, 'Hydrochloric Acid', 4000, 'Concentrated HCl for chemical testing', 'Fisher', 'ml', 0, 0),
(3, 'Sodium Hydroxide', 2500, 'NaOH pellets for solution preparation', 'Merck', 'g', 0, 0),
(4, 'Acetone', 2000, 'Laboratory grade acetone', 'VWR', 'ml', 0, 0),
(5, 'Glacial Acetic Acid', 3000, '99.9% pure acetic acid', 'ThermoFisher', 'ml', 0, 0),
(6, 'Benzene', 3000, 'Analytical grade benzene', 'Sigma Aldrich', 'ml', 0, 0),
(7, 'Potassium Permanganate', 1000, 'KMnO4 for titration purposes', 'Fisher', 'g', 0, 0),
(8, 'Methanol', 2000, 'High purity methanol for chromatography', 'Merck', 'ml', 0, 0),
(9, 'Sulfuric Acid', 2000, 'Concentrated H2SO4 for laboratory use', 'VWR', 'ml', 0, 0),
(10, 'Calcium Chloride', 1000, 'Anhydrous CaCl2 for drying agents', 'ThermoFisher', 'g', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lab_order`
--

CREATE TABLE `lab_order` (
  `id` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `delivered_date` date NOT NULL,
  `status` varchar(20) NOT NULL COMMENT 'Pending / Approved / Canceled , Denied',
  `note` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lab_order`
--

INSERT INTO `lab_order` (`id`, `request_date`, `delivered_date`, `status`, `note`) VALUES
(1, '2024-04-29', '0000-00-00', 'Pending', 'Need within a week'),
(2, '2024-04-29', '0000-00-00', 'Pending', 'need within 10 days'),
(3, '2024-04-29', '0000-00-00', 'Pending', 'needed within 2 weeks'),
(4, '2024-04-29', '0000-00-00', 'Pending', 'need within a week');

-- --------------------------------------------------------

--
-- Table structure for table `lab_order_item`
--

CREATE TABLE `lab_order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `note` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lab_order_item`
--

INSERT INTO `lab_order_item` (`id`, `order_id`, `item_id`, `item_name`, `quantity`, `note`) VALUES
(1, 1, 10, 'Calcium Chloride', 30, '50ml bottles'),
(2, 1, 1, 'Ethanol', 20, '20ml bottles'),
(3, 2, 4, 'Acetone', 50, '15ml bottels'),
(4, 2, 5, 'Glacial Acetic Acid', 45, '25ml bottels'),
(5, 2, 6, 'Benzene', 30, '25ml bottels'),
(6, 3, 8, 'Methanol', 60, 'Neatly covered package bottels'),
(7, 3, 3, 'Sodium Hydroxide', 35, 'Dark gray bottled'),
(8, 4, 7, 'Potassium Permanganate', 50, 'need as cubes'),
(9, 4, 9, 'Sulfuric Acid', 25, 'Follow the special procedures needed in bottles'),
(10, 4, 2, 'Hydrochloric Acid', 10, '20ml bottles');

-- --------------------------------------------------------

--
-- Table structure for table `medical_report`
--

CREATE TABLE `medical_report` (
  `id` int(11) NOT NULL,
  `ref_no` varchar(255) NOT NULL,
  `test_type` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `message` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active_status` int(11) NOT NULL,
  `test_type_id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `mlt_id` int(11) NOT NULL,
  `reject_note` varchar(200) NOT NULL,
  `report_status` varchar(20) NOT NULL COMMENT 'Pending / Created / Review By MLT / Completed / Rejected / Approved',
  `mlt_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_report`
--

INSERT INTO `medical_report` (`id`, `ref_no`, `test_type`, `date`, `message`, `path`, `email`, `active_status`, `test_type_id`, `lab_id`, `mlt_id`, `reject_note`, `report_status`, `mlt_active`) VALUES
(1, 'LB-0015', 'Lipid Panel', '2024-04-29', '', '', 'buddhinadeeshan97@gmail.com', 1, 5, 0, 0, '', 'Completed', 1),
(2, 'LB-0007', 'Lipid Panel', '2024-04-29', '', '', 'buddhinadeeshan97@gmail.com', 1, 5, 0, 0, '', 'Completed', 1),
(3, 'LB-0008', 'Thyroid Function Tests', '2024-04-29', '', '', 'buddhinadeeshan97@gmail.com', 1, 6, 0, 0, '', 'Review By MLT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_tbl`
--

CREATE TABLE `orders_tbl` (
  `id` int(11) NOT NULL,
  `invmng_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `expected_date` date NOT NULL,
  `status` varchar(20) NOT NULL COMMENT '0-Placed Order\r\n1 - Send Invoice\r\n2-Approved\r\n3-Completed\r\n4 - Cancelled\r\n5-Delete',
  `invoice_id` int(11) DEFAULT NULL,
  `suplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_tbl`
--

INSERT INTO `orders_tbl` (`id`, `invmng_id`, `order_date`, `expected_date`, `status`, `invoice_id`, `suplier_id`) VALUES
(1, 4, '2024-04-30', '2024-05-10', 'Placed Order', NULL, 5),
(2, 4, '2024-04-30', '2024-04-29', 'Send Invoice', 1, 5),
(3, 4, '2024-04-30', '2024-05-11', 'Placed Order', NULL, 5),
(4, 4, '2024-04-30', '2024-05-08', 'Placed Order', NULL, 5),
(5, 4, '2024-04-30', '2024-05-11', 'Placed Order', NULL, 5),
(6, 4, '2024-04-30', '2024-05-16', 'Placed Order', NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `order_invoice_tbl`
--

CREATE TABLE `order_invoice_tbl` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `inv_id` int(11) NOT NULL,
  `invoice_date` date NOT NULL,
  `status` varchar(30) NOT NULL COMMENT '0-pending\r\n1-accept\r\n2-declined\r\n3-delete',
  `notes` text NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_invoice_tbl`
--

INSERT INTO `order_invoice_tbl` (`id`, `supplier_id`, `inv_id`, `invoice_date`, `status`, `notes`, `order_id`) VALUES
(1, 5, 4, '2024-04-30', 'Send Invoice', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_name` varchar(40) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float DEFAULT NULL,
  `note` text NOT NULL,
  `expire_date` date DEFAULT NULL,
  `is_removed` int(11) NOT NULL DEFAULT 0 COMMENT 'removed- 1 / default-0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `item_id`, `item_name`, `quantity`, `price`, `note`, `expire_date`, `is_removed`) VALUES
(1, 1, 1, 'Ethanol', 5000, NULL, '', NULL, 0),
(2, 1, 2, 'Hydrochloric Acid', 5000, NULL, '', NULL, 0),
(3, 1, 3, 'Sodium Hydroxide', 7000, NULL, '', NULL, 0),
(4, 2, 5, 'Glacial Acetic Acid', 4000, 8000, '', '2024-04-04', 0),
(5, 2, 2, 'Hydrochloric Acid', 3000, 9000, '', '2024-04-17', 0),
(6, 2, 1, 'Ethanol', 2000, 4000, '', '2024-04-17', 0),
(7, 3, 2, 'Hydrochloric Acid', 3500, NULL, '', NULL, 0),
(8, 3, 3, 'Sodium Hydroxide', 2000, NULL, '', NULL, 0),
(9, 4, 4, 'Acetone', 4000, NULL, '', NULL, 0),
(10, 5, 2, 'Hydrochloric Acid', 1500, NULL, '', NULL, 0),
(11, 5, 4, 'Acetone', 3000, NULL, '', NULL, 0),
(12, 6, 5, 'Glacial Acetic Acid', 1200, NULL, '', NULL, 0),
(13, 6, 1, 'Ethanol', 3000, NULL, '', NULL, 0),
(14, 6, 2, 'Hydrochloric Acid', 3500, NULL, '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `otptable`
--

CREATE TABLE `otptable` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_data`
--

CREATE TABLE `patient_data` (
  `patient_id` int(11) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `patient_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `patient_phone` varchar(255) NOT NULL,
  `patient_dob` varchar(255) NOT NULL,
  `patient_gender` varchar(255) NOT NULL,
  `patient_address` varchar(255) NOT NULL,
  `profile_img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_data`
--

INSERT INTO `patient_data` (`patient_id`, `patient_name`, `patient_email`, `password`, `patient_phone`, `patient_dob`, `patient_gender`, `patient_address`, `profile_img`) VALUES
(1, 'John Doe', 'birigov756@buzblox.com', '$2y$10$GrRmJHuFOR3IA1dBf5W8k.P2bhlulqsBrEoDten672MwfeDK.AYUW', '0783546345', '2004-02-02', 'Female', '123 Main Street, Springfield, IL 62701, USA', ''),
(2, 'Gihan Prasad', 'vopoj59583@funvane.com', '$2y$10$xceCUgQwEtX0FUPDtUuA0.hiYPWM/DfYERMC4sOSls/XU24UCPkI.', '0783456789', '1997-03-03', 'Male', '456 Oak Avenue, Toronto, ON M5V 2E8, Canada', ''),
(3, 'Chathura Alwis', 'kehisor186@buzblox.com', '$2y$10$vgUcd1aS8z3sFKUan9WgWuxgp8KAR7B7ES7drgooDCWGzoGp01IM2', '0783947567', '2000-03-23', 'Male', '23', ''),
(4, 'Buddhi', 'buddhinadeeshan97@gmail.com', '$2y$10$rhfT4xojGeZel6FENDcnyeXzSiQiz/JIX.E.H9RNbVzJAWWS5xvMK', '0784567234', '2000-05-03', 'Male', '101 Pine Road, Sydney, NSW 2000, Australia', 'PP-4.jpg'),
(5, 'saman', 'fogekol593@funvane.com', '$2y$10$jkMvuU6Lefs6/whN/dSBweCWGNfYdUK5nMPFfIQyvTKT2FuFtdGD.', '070332256', '2000-03-12', 'Female', 'Kalutara', ''),
(6, 'Lakmali', 'sofeya7375@dxice.com', '$2y$10$Po/IQG5PmUw1cQs.fDMRcOvdVtfThzRE476EiO84GxLn7JHQBxWR6', '709228822', '2000-02-12', 'Male', 'no 23', '');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `patient_name` varchar(255) DEFAULT NULL,
  `patient_address` varchar(255) DEFAULT NULL,
  `patient_email` varchar(255) DEFAULT NULL,
  `patient_phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requested_items`
--

CREATE TABLE `requested_items` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supply_requests`
--

CREATE TABLE `supply_requests` (
  `request_id` int(11) NOT NULL,
  `requested_by` varchar(255) NOT NULL,
  `request_date` date NOT NULL,
  `requested_delivery_date` date DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending' CHECK (`status` in ('pending','approved','fulfilled','denied')),
  `approved_date` date DEFAULT NULL,
  `fulfilled_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_prescription`
--

CREATE TABLE `temp_prescription` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp_prescription`
--

INSERT INTO `temp_prescription` (`id`, `email`) VALUES
(1, 'buddhinadeeshan97@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `test_form`
--

CREATE TABLE `test_form` (
  `id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `input_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_form`
--

INSERT INTO `test_form` (`id`, `test_id`, `label`, `input_type`) VALUES
(1, 1, 'White Blood Cell Count (WBC)', 'number'),
(2, 1, 'Red Blood Cell Count (RBC)', 'number'),
(3, 1, 'Hemoglobin (Hgb)', 'text'),
(4, 1, 'Hematocrit (Hct)', 'number'),
(5, 1, 'Mean Corpuscular Volume (MCV)', 'number'),
(6, 1, 'MCH', 'number'),
(7, 1, 'MCHC', 'number'),
(8, 1, 'Platelet Count', 'number'),
(9, 1, 'Red Cell Distribution Width (RDW)', 'number'),
(10, 1, '', 'text'),
(11, 1, 'Neutrophils', 'text'),
(12, 1, 'Reticulocyte Count', 'text'),
(13, 1, 'Mean Platelet Volume (MPV)', 'text'),
(14, 1, 'PDW', 'text'),
(15, 1, 'Platelet Count', 'text'),
(16, 2, 'Sodium (Na)', 'number'),
(17, 2, 'Potassium (K)', 'number'),
(18, 2, 'Chloride (Cl)', 'number'),
(19, 2, 'Bicarbonate (HCO3-)', 'number'),
(20, 2, 'Blood Urea Nitrogen (BUN)', 'number'),
(21, 2, 'Creatinine', 'number'),
(22, 2, 'Glucose', 'number'),
(23, 2, 'Phosphorus (Phos)', 'number'),
(24, 2, 'Magnesium (Mg)', 'number'),
(25, 2, 'Calcium (Ca)', 'number'),
(26, 2, 'Hemoglobin (Hgb)', 'number'),
(27, 2, 'Platelet Count', 'text'),
(28, 2, 'Red Blood Cell Count (RBC)', 'text'),
(29, 2, 'RDW', 'text'),
(30, 3, 'Glucose', 'number'),
(31, 3, 'Calcium (Ca)', 'number'),
(32, 3, 'Sodium (Na)', 'number'),
(33, 3, 'Potassium (K)', 'number'),
(34, 3, 'Chloride (Cl)', 'number'),
(35, 3, 'Bicarbonate (HCO3-)', 'number'),
(36, 3, 'Blood Urea Nitrogen (BUN)', 'number'),
(37, 3, 'Creatinine', 'number'),
(38, 3, 'Albumin', 'number'),
(39, 3, 'Total Protein', 'number'),
(40, 3, 'Alanine Aminotransferase (ALT)', 'number'),
(41, 3, 'Aspartate Aminotransferase (AST)', 'number'),
(42, 3, 'Alkaline Phosphatase (ALP)', 'number'),
(43, 3, 'Bilirubin (Total and Direct)', 'number'),
(44, 3, 'Phosphorus (Phos)', 'number'),
(45, 3, 'Magnesium (Mg)', 'number'),
(46, 5, 'Total Cholesterol', 'number'),
(47, 5, 'Low-Density Lipoprotein (LDL)', 'number'),
(48, 5, 'High-Density Lipoprotein (HDL)', 'number'),
(49, 5, 'Triglycerides', 'number'),
(50, 5, 'Non-HDL Cholesterol', 'number'),
(51, 5, 'LDL/HDL Ratio', 'number'),
(52, 5, 'Phosphorus (Phos)', 'number'),
(53, 5, 'Magnesium (Mg)', 'number'),
(54, 5, 'Total Protein', 'number'),
(55, 5, 'Alkaline Phosphatase (ALP)', 'number'),
(56, 5, 'Chloride (Cl)', 'number'),
(57, 5, 'Chloride (Cl)', 'number'),
(58, 5, 'Potassium (K)', 'number'),
(59, 5, 'Albumin', 'number'),
(60, 5, 'Blood Urea Nitrogen (BUN)', 'number'),
(61, 5, 'Bilirubin ', 'number'),
(62, 6, ' TSH', 'number'),
(63, 6, 'Free Thyroxine (FT4)', 'number'),
(64, 6, 'Total Thyroxine (T4)', 'number'),
(65, 6, 'Free Triiodothyronine (FT3)', 'number'),
(66, 6, 'TPOAb', 'number'),
(67, 6, 'TgAb', 'number'),
(68, 6, 'LDL/HDL Ratio', 'number'),
(69, 6, 'Non-HDL Cholesterol', 'number'),
(70, 6, 'Magnesium (Mg)', 'number'),
(71, 6, 'Phosphorus (Phos)', 'number'),
(72, 6, 'Total Protein', 'number'),
(73, 6, 'Chloride (Cl)', 'number'),
(74, 6, 'Sodium (Na)', 'number'),
(75, 6, 'Glucose', 'number'),
(76, 6, 'Creatinine', 'number'),
(77, 6, 'Total Protein', 'number');

-- --------------------------------------------------------

--
-- Table structure for table `test_preparation`
--

CREATE TABLE `test_preparation` (
  `id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `preparation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_preparation`
--

INSERT INTO `test_preparation` (`id`, `test_id`, `preparation`) VALUES
(1, 1, 'Diagnostic tests such as electrocardiograms (ECGs)'),
(2, 1, ' echocardiograms, stress tests'),
(3, 1, 'cardiac catheterization'),
(4, 1, ''),
(5, 1, ''),
(6, 1, ''),
(7, 2, 'Fasting for 8 to 12 hours may be required for accurate glucose measurement'),
(8, 2, ''),
(9, 2, ''),
(10, 2, ''),
(11, 2, ''),
(12, 2, ''),
(13, 3, 'Fasting for 8 to 12 hours may be required for accurate glucose measuremen'),
(14, 3, ' Fasting for 9 to 12 hours is usually required for accurate results'),
(15, 3, ' Some tests may require fasting, while others may not'),
(16, 3, ''),
(17, 3, ''),
(18, 3, ''),
(19, 4, 'Fasting for 9 to 12 hours is usually required for accurate results.'),
(20, 4, ''),
(21, 4, ''),
(22, 4, ''),
(23, 4, ''),
(24, 4, ''),
(25, 5, ' Fasting for 9 to 12 hours is usually required for accurate results.'),
(26, 5, ''),
(27, 5, ''),
(28, 5, ''),
(29, 5, ''),
(30, 5, ''),
(31, 6, 'Some tests may require fasting'),
(32, 6, ' Fasting for 9 to 12 hours is usually required for accurate results'),
(33, 6, ''),
(34, 6, ''),
(35, 6, ''),
(36, 6, '');

-- --------------------------------------------------------

--
-- Table structure for table `test_type`
--

CREATE TABLE `test_type` (
  `id` int(11) NOT NULL,
  `Test_type` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Time_duration` time NOT NULL,
  `price` float DEFAULT NULL,
  `active_status` int(11) NOT NULL,
  `availability` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_type`
--

INSERT INTO `test_type` (`id`, `Test_type`, `Description`, `Time_duration`, `price`, `active_status`, `availability`) VALUES
(1, 'CBC', 'CBC measures various components of the blood, including red blood cells (RBCs), white blood cells (WBCs), platelets, hemoglobin, and hematocrit.', '00:20:00', 1200, 1, 0),
(2, 'Basic Metabolic Panel', 'BMP measures electrolytes (such as sodium, potassium, and calcium), glucose, and kidney function markers (such as blood urea nitrogen and creatinine).', '00:15:00', 800, 1, 1),
(3, 'Metabolic Panel', 'CMP includes all the tests in BMP along with additional liver function tests (such as liver enzymes and bilirubin).', '00:15:00', 200, 1, 1),
(4, 'Lipid Panel', 'Lipid panel measures levels of cholesterol, triglycerides, high-density lipoprotein (HDL), and low-density lipoprotein (LDL) in the blood.', '00:20:00', 300, 0, 1),
(5, 'Lipid Panel', ' Lipid panel measures levels of cholesterol, triglycerides, high-density lipoprotein (HDL), and low-density lipoprotein (LDL) in the blood.', '00:20:00', 300, 1, 1),
(6, 'Thyroid Function Tests', 'TFTs measure levels of thyroid hormones (TSH, T3, T4) to assess thyroid function and detect thyroid disorders.', '00:10:00', 300, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_test_id` (`test_type_id`),
  ADD KEY `fk_user` (`patient_email`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp`
--
ALTER TABLE `emp`
  ADD PRIMARY KEY (`empid`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holiday_calendar`
--
ALTER TABLE `holiday_calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventorychemical`
--
ALTER TABLE `inventorychemical`
  ADD PRIMARY KEY (`Item_Id`);

--
-- Indexes for table `inventory_items`
--
ALTER TABLE `inventory_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_order`
--
ALTER TABLE `lab_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_order_item`
--
ALTER TABLE `lab_order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lab_order` (`order_id`),
  ADD KEY `fk_lab_order_item` (`item_id`);

--
-- Indexes for table `medical_report`
--
ALTER TABLE `medical_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_reports` (`test_type_id`),
  ADD KEY `fk_lab` (`lab_id`),
  ADD KEY `fk_mlt` (`mlt_id`),
  ADD KEY `fk_report` (`email`);

--
-- Indexes for table `orders_tbl`
--
ALTER TABLE `orders_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_invoice` (`invoice_id`),
  ADD KEY `fk_inv` (`invmng_id`),
  ADD KEY `fk_supplier` (`suplier_id`);

--
-- Indexes for table `order_invoice_tbl`
--
ALTER TABLE `order_invoice_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sup_id` (`supplier_id`),
  ADD KEY `fk_inv_id` (`inv_id`),
  ADD KEY `fk_order` (`order_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_id` (`order_id`),
  ADD KEY `fk_item` (`item_id`);

--
-- Indexes for table `otptable`
--
ALTER TABLE `otptable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_data`
--
ALTER TABLE `patient_data`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `fk_email` (`patient_email`);

--
-- Indexes for table `requested_items`
--
ALTER TABLE `requested_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`),
  ADD KEY `item_fk` (`item_id`);

--
-- Indexes for table `supply_requests`
--
ALTER TABLE `supply_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `temp_prescription`
--
ALTER TABLE `temp_prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_form`
--
ALTER TABLE `test_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_test_form` (`test_id`);

--
-- Indexes for table `test_preparation`
--
ALTER TABLE `test_preparation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_test` (`test_id`);

--
-- Indexes for table `test_type`
--
ALTER TABLE `test_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holiday_calendar`
--
ALTER TABLE `holiday_calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inventorychemical`
--
ALTER TABLE `inventorychemical`
  MODIFY `Item_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_items`
--
ALTER TABLE `inventory_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lab_order`
--
ALTER TABLE `lab_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lab_order_item`
--
ALTER TABLE `lab_order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `medical_report`
--
ALTER TABLE `medical_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders_tbl`
--
ALTER TABLE `orders_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_invoice_tbl`
--
ALTER TABLE `order_invoice_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `otptable`
--
ALTER TABLE `otptable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requested_items`
--
ALTER TABLE `requested_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supply_requests`
--
ALTER TABLE `supply_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_prescription`
--
ALTER TABLE `temp_prescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `test_form`
--
ALTER TABLE `test_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `test_preparation`
--
ALTER TABLE `test_preparation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `fk_test_id` FOREIGN KEY (`test_type_id`) REFERENCES `test_type` (`id`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`patient_email`) REFERENCES `patient_data` (`patient_email`) ON DELETE CASCADE;

--
-- Constraints for table `lab_order_item`
--
ALTER TABLE `lab_order_item`
  ADD CONSTRAINT `fk_lab_order` FOREIGN KEY (`order_id`) REFERENCES `lab_order` (`id`),
  ADD CONSTRAINT `fk_lab_order_item` FOREIGN KEY (`item_id`) REFERENCES `inventory_items` (`id`);

--
-- Constraints for table `medical_report`
--
ALTER TABLE `medical_report`
  ADD CONSTRAINT `FK_reports` FOREIGN KEY (`test_type_id`) REFERENCES `test_type` (`id`),
  ADD CONSTRAINT `fk_lab` FOREIGN KEY (`lab_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `fk_mlt` FOREIGN KEY (`mlt_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `fk_report` FOREIGN KEY (`email`) REFERENCES `patient_data` (`patient_email`);

--
-- Constraints for table `orders_tbl`
--
ALTER TABLE `orders_tbl`
  ADD CONSTRAINT `fk_inv` FOREIGN KEY (`invmng_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_invmng` FOREIGN KEY (`invmng_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `fk_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `order_invoice_tbl` (`id`),
  ADD CONSTRAINT `fk_supplier` FOREIGN KEY (`suplier_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `order_invoice_tbl`
--
ALTER TABLE `order_invoice_tbl`
  ADD CONSTRAINT `fk_inv_id` FOREIGN KEY (`inv_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `fk_order` FOREIGN KEY (`order_id`) REFERENCES `orders_tbl` (`id`),
  ADD CONSTRAINT `fk_sup_id` FOREIGN KEY (`supplier_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `fk_item` FOREIGN KEY (`item_id`) REFERENCES `inventory_items` (`id`),
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders_tbl` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requested_items`
--
ALTER TABLE `requested_items`
  ADD CONSTRAINT `item_fk` FOREIGN KEY (`item_id`) REFERENCES `inventory_items` (`id`),
  ADD CONSTRAINT `requested_items_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `supply_requests` (`request_id`);

--
-- Constraints for table `test_form`
--
ALTER TABLE `test_form`
  ADD CONSTRAINT `fk_test_form` FOREIGN KEY (`test_id`) REFERENCES `test_type` (`id`);

--
-- Constraints for table `test_preparation`
--
ALTER TABLE `test_preparation`
  ADD CONSTRAINT `fk_test` FOREIGN KEY (`test_id`) REFERENCES `test_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
