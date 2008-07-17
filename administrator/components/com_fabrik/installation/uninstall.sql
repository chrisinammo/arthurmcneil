DELETE FROM `#__fabrik_jsactions`;
DROP TABLE  `#__fabrik_jsactions`;
DELETE FROM `#__fabrik_joins`;
DROP TABLE `#__fabrik_joins`;
DELETE FROM `#__fabrik_connections`;
DROP TABLE `#__fabrik_connections`;
DELETE FROM `#__fabrik_tables`;
DROP TABLE `#__fabrik_tables`;
DELETE FROM `#__fabrik_validations`;
DROP TABLE `#__fabrik_validations`;
DELETE FROM `#__fabrik_forms`;
DROP TABLE `#__fabrik_forms`;
DELETE FROM `#__fabrik_elements`;
DROP TABLE `#__fabrik_elements`;
DELETE FROM `#__fabrik_plugins`;
DROP TABLE `#__fabrik_plugins`;
DELETE FROM `#__fabrik_formgroup`;
DROP TABLE `#__fabrik_formgroup`;
DELETE FROM `#__fabrik_groups`;
DROP TABLE `#__fabrik_groups`;

DELETE FROM `#__fabrik_calendar_events`;
DROP TABLE `#__fabrik_calendar_events`;
DELETE FROM `#__fabrik_packages`;
DROP TABLE `#__fabrik_packages`;
DELETE FROM `#__fabrik_visualizations`;
DROP TABLE `#__fabrik_visualizations`;

DELETE FROM `#__components` WHERE `option` LIKE 'com_fabrik';