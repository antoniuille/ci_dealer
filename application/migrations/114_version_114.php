<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Version_114 extends CI_Migration
{
    function __construct()
    {
        parent::__construct();
    }

    public function up()
    {
        $this->db->query("UPDATE `tbl_config` SET `value` = '1.4' WHERE `tbl_config`.`config_key` = 'version';");
        $this->db->query("CREATE TABLE IF NOT EXISTS `tbl_pinaction` (`pinaction_id` int(11) NOT NULL AUTO_INCREMENT,`user_id` int(11) NOT NULL,`module_id` int(11) NOT NULL,`module_name` varchar(30) DEFAULT NULL,PRIMARY KEY (`pinaction_id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

        $this->db->query("DROP TABLE tbl_project");
        $this->db->query("CREATE TABLE IF NOT EXISTS `tbl_project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(100) NOT NULL,
  `client_id` int(11) NOT NULL,
  `progress` varchar(50) NOT NULL,
  `calculate_progress` varchar(50) DEFAULT NULL,
  `start_date` varchar(20) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  `project_cost` decimal(18,2) NOT NULL DEFAULT '0.00',
  `demo_url` varchar(100) NOT NULL,
  `project_status` varchar(20) NOT NULL,
  `description` varchar(500) NOT NULL,
  `notify_client` enum('Yes','No') NOT NULL,
  `timer_status` enum('on','off') DEFAULT NULL,
  `timer_started_by` int(11) DEFAULT NULL,
  `start_time` int(11) DEFAULT NULL,
  `logged_time` int(11) DEFAULT NULL,
  `permission` text,
  `notes` text,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hourly_rate` varchar(200) DEFAULT NULL,
  `fixed_rate` varchar(200) DEFAULT NULL,
  `project_settings` text,
  `with_tasks` enum('yes','no') NOT NULL DEFAULT 'no',
  `estimate_hours` varchar(50) DEFAULT NULL,
  `billing_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

        $this->db->query("CREATE TABLE IF NOT EXISTS `tbl_project_settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `settings` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
        $this->db->query("INSERT INTO `tbl_project_settings` (`settings_id`, `settings`, `description`) VALUES
(1, 'show_team_members', 'view team members'),
(2, 'show_milestones', 'view project milestones'),
(5, 'show_project_tasks', 'view project tasks'),
(6, 'show_project_attachments', 'view project attachments'),
(7, 'show_timesheets', 'view project timesheets'),
(8, 'show_project_bugs', 'view project bugs'),
(9, 'show_project_history', 'view project history'),
(10, 'show_project_calendar', 'view project calendars'),
(11, 'show_project_comments', 'view project comments'),
(13, 'show_gantt_chart', 'view Gantt chart'),
(14, 'show_project_hours', 'view project hours'),
(15, 'comment_on_project_tasks', 'access To comment on project tasks'),
(16, 'show_project_tasks_attachments', 'view task attachments'),
(20, 'show_tasks_hours', 'show_tasks_hours'),
(21, 'show_finance_overview', 'show_finance_overview');");

        $this->db->query("INSERT INTO `tbl_languages` (`code`, `name`, `icon`, `active`) VALUES
        ('cs', 'czech', 'cz', 1),
        ('da', 'danish', 'dk', 1),
        ('el', 'greek', 'cy', 1),
        ('es', 'spanish', 'ar', 1),
        ('gu', 'gujarati', 'in', 1),
        ('hi', 'hindi', 'in', 1),
        ('id', 'indonesian', 'id', 1),
        ('ja', 'japanese', 'jp', 1),
        ('no', 'norwegian', 'no', 1),
        ('pl', 'polish', 'pl', 1),
        ('pt', 'portuguese', 'br', 1),
        ('ro', 'romanian', 'md', 1),
        ('ru', 'russian', 'ru', 1),
        ('zh', 'chinese', 'cn', 1)");

        $this->db->query("ALTER TABLE `tbl_estimates` ADD (project_id int(11) NULL DEFAULT '0')");
        $this->db->query("ALTER TABLE `tbl_tickets` ADD (project_id int(11) NULL DEFAULT '0')");
        $this->db->query("DROP TABLE tbl_task");
        $this->db->query("CREATE TABLE IF NOT EXISTS `tbl_task` (
  `task_id` int(5) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `milestones_id` int(11) DEFAULT NULL,
  `opportunities_id` int(11) DEFAULT NULL,
  `goal_tracking_id` int(11) DEFAULT NULL,
  `task_name` varchar(200) NOT NULL,
  `task_description` text NOT NULL,
  `task_start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `task_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `task_status` varchar(30) DEFAULT NULL,
  `task_progress` int(2) NOT NULL,
  `task_hour` varchar(10) NOT NULL,
  `tasks_notes` text,
  `timer_status` enum('on','off') NOT NULL DEFAULT 'off',
  `timer_started_by` int(11) DEFAULT NULL,
  `start_time` int(11) DEFAULT NULL,
  `logged_time` int(11) NOT NULL DEFAULT '0',
  `leads_id` int(11) DEFAULT NULL,
  `bug_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `permission` text,
  `client_visible` varchar(5) DEFAULT NULL,
  `custom_date` text,
  `hourly_rate` decimal(18,2) DEFAULT '0.00',
  `billable` varchar(20) NOT NULL DEFAULT 'No',
  `index_no` int(10) NOT NULL,
  `milestones_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8");
        $this->db->query("CREATE TABLE IF NOT EXISTS `tbl_migrations` (`version` bigint(20) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
        $this->db->query("INSERT INTO `tbl_migrations` (`version`) VALUES(114);");
        $this->db->query("ALTER TABLE `tbl_invoices` ADD (client_visible ENUM('Yes','No') NULL DEFAULT 'No')");

        $this->db->query("CREATE TABLE IF NOT EXISTS `tbl_sessions` (`id` varchar(40) NOT NULL,`ip_address` varchar(45) NOT NULL,`timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',`data` blob NOT NULL,PRIMARY KEY (`id`),KEY `ci_sessions_timestamp` (`timestamp`));");
        $this->db->query("ALTER TABLE `tbl_task_comment` ADD (comments_attachment text NULL)");
        $this->db->query("ALTER TABLE `tbl_leads` ADD (index_no int(11) NULL DEFAULT 0)");
        $this->db->query("ALTER TABLE `tbl_lead_status` ADD (order_no int(11) NULL DEFAULT 0)");

        $this->db->query("ALTER TABLE `tbl_client` ADD (latitude varchar(100) NULL,longitude varchar(100) NULL,customer_group_id int(11) NULL DEFAULT 0,active varchar(100) NULL)");

        $this->db->query("CREATE TABLE IF NOT EXISTS `tbl_customer_group` (`customer_group_id` int(11) NOT NULL AUTO_INCREMENT,`customer_group` varchar(200) NOT NULL,`description` varchar(200) NOT NULL,PRIMARY KEY (`customer_group_id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8");
        $this->db->query("CREATE TABLE IF NOT EXISTS `tbl_client_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(20) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `icon` varchar(50) NOT NULL,
  `parent` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sort` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;");

        $this->db->query("INSERT INTO `tbl_client_menu` (`menu_id`, `label`, `link`, `icon`, `parent`, `time`, `sort`, `status`) VALUES
(1, 'projects', 'client/projects', 'fa fa-folder-open-o', 0, '2017-04-19 20:18:26', 3, 0),
(2, 'bugs', 'client/bugs', 'fa fa-bug', 0, '2017-04-19 20:18:39', 4, 0),
(3, 'invoices', 'client/invoice/manage_invoice', 'fa fa-shopping-cart', 0, '2017-04-19 20:18:42', 5, 0),
(4, 'estimates', 'client/estimates', 'fa fa-tachometer', 0, '2017-04-19 20:18:45', 6, 0),
(5, 'payments', 'client/invoice/all_payments', 'fa fa-money', 0, '2017-04-19 20:18:48', 7, 0),
(6, 'tickets', 'client/tickets', 'fa fa-ticket', 0, '2017-06-14 19:59:00', 8, 0),
(7, 'quotations', 'client/quotations', 'fa fa-paste', 0, '2017-04-19 20:18:56', 9, 0),
(8, 'users', 'client/user/user_list', 'fa fa-users', 0, '2017-04-19 20:18:59', 10, 0),
(9, 'settings', 'client/settings', 'fa fa-cogs', 0, '2017-04-19 20:19:03', 11, 0),
(17, 'dashboard', 'client/dashboard', 'icon-speedometer', 0, '2017-04-19 20:17:21', 1, 0),
(18, 'mailbox', 'client/mailbox', 'fa fa-envelope', 0, '2017-04-19 20:17:21', 2, 0),
(19, 'private_chat', 'client/message', 'fa fa-envelope', 0, '2017-04-19 20:19:25', 12, 0),
(20, 'filemanager', 'client/filemanager', 'fa fa-file', 0, '2017-06-03 08:08:23', 2, 1)");

        $this->db->query("CREATE TABLE IF NOT EXISTS `tbl_client_role` (
  `client_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`client_role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

        $this->db->query("ALTER TABLE `tbl_user_role` ADD (view int(11) NULL DEFAULT 0,created int(11) NULL DEFAULT 0,edited int(11) NULL DEFAULT 0,deleted int(11) NULL DEFAULT 0)");

        $this->db->query("DROP TABLE tbl_menu");
        $this->db->query("CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT '1' COMMENT '1= active 0=inactive',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8");
        $this->db->query("INSERT INTO `tbl_menu` (`menu_id`, `label`, `link`, `icon`, `parent`, `sort`, `time`, `status`) VALUES
(1, 'dashboard', 'admin/dashboard', 'fa fa-dashboard', 0, 0, '2017-04-22 18:09:36', 1),
(2, 'calendar', 'admin/calendar', 'fa fa-calendar', 0, 2, '2017-06-18 20:58:02', 1),
(4, 'client', 'admin/client/manage_client', 'fa fa-users', 0, 9, '2017-06-18 22:33:57', 1),
(5, 'mailbox', 'admin/mailbox', 'fa fa-envelope-o', 0, 1, '2017-06-18 20:58:02', 1),
(6, 'tickets', '#', 'fa fa-ticket', 0, 11, '2017-06-18 22:34:27', 1),
(7, 'all_tickets', 'admin/tickets', 'fa fa-ticket', 6, 4, '2016-05-30 01:20:22', 1),
(8, 'answered', 'admin/tickets/answered', 'fa fa-circle-o', 6, 0, '2016-05-30 01:20:22', 1),
(9, 'open', 'admin/tickets/open', 'fa fa-circle-o', 6, 1, '2016-05-30 01:20:22', 1),
(10, 'in_progress', 'admin/tickets/in_progress', 'fa fa-circle-o', 6, 2, '2016-05-30 01:20:22', 1),
(11, 'closed', 'admin/tickets/closed', 'fa fa-circle-o', 6, 3, '2016-05-30 01:20:22', 1),
(12, 'sales', '#', 'fa fa-shopping-cart', 0, 10, '2017-06-18 22:33:57', 1),
(13, 'invoice', 'admin/invoice/manage_invoice', 'fa fa-circle-o', 12, 0, '2017-04-23 12:27:23', 1),
(14, 'estimates', 'admin/estimates', 'fa fa-circle-o', 12, 1, '2017-06-10 06:32:05', 1),
(15, 'payments_received', 'admin/invoice/all_payments', 'fa fa-circle-o', 12, 3, '2017-04-23 12:27:24', 1),
(16, 'tax_rates', 'admin/invoice/tax_rates', 'fa fa-circle-o', 12, 4, '2017-04-23 12:27:24', 1),
(21, 'quotations', '#', 'fa fa-paste', 12, 6, '2017-06-10 06:35:47', 1),
(22, 'quotations_list', 'admin/quotations', 'fa fa-circle-o', 21, 0, '2017-05-18 09:19:03', 1),
(23, 'quotations_form', 'admin/quotations/quotations_form', 'fa fa-circle-o', 21, 1, '2016-05-30 01:20:23', 1),
(24, 'user', 'admin/user/user_list', 'fa fa-users', 0, 14, '2017-06-18 22:34:27', 1),
(25, 'settings', 'admin/settings', 'fa fa-cogs', 0, 15, '2017-06-18 22:34:27', 1),
(26, 'database_backup', 'admin/settings/database_backup', 'fa fa-database', 0, 16, '2017-06-18 22:34:27', 1),
(39, 'items', 'admin/items/items_list', 'fa fa-cube', 12, 5, '2017-06-10 06:35:47', 1),
(42, 'report', '#', 'fa fa-bar-chart', 0, 12, '2017-06-18 22:34:27', 1),
(51, 'recurring_invoice', 'admin/invoice/recurring_invoice', 'fa fa-circle-o', 12, 2, '2017-06-10 06:32:05', 1),
(54, 'tasks', 'admin/tasks/all_task', 'fa fa-tasks', 0, 5, '2017-06-18 20:58:02', 1),
(55, 'leads', 'admin/leads', 'fa fa-rocket', 0, 7, '2017-06-18 20:58:02', 1),
(56, 'opportunities', 'admin/opportunities', 'fa fa-filter', 0, 8, '2017-06-18 22:33:57', 1),
(57, 'projects', 'admin/projects', 'fa fa-folder-open-o', 0, 4, '2017-06-18 20:58:02', 1),
(58, 'bugs', 'admin/bugs', 'fa fa-bug', 0, 6, '2017-06-18 20:58:02', 1),
(59, 'project', '#', 'fa fa-folder-open-o', 42, 0, '2016-05-30 01:20:22', 1),
(60, 'tasks_report', 'admin/report/tasks_report', 'fa fa-circle-o', 42, 1, '2016-05-30 01:20:22', 1),
(61, 'bugs_report', 'admin/report/bugs_report', 'fa fa-circle-o', 42, 2, '2016-05-30 01:20:22', 1),
(62, 'tickets_report', 'admin/report/tickets_report', 'fa fa-circle-o', 42, 3, '2016-05-30 01:20:22', 1),
(63, 'client_report', 'admin/report/client_report', 'fa fa-circle-o', 42, 4, '2016-05-30 01:20:23', 1),
(66, 'tasks_assignment', 'admin/report/tasks_assignment', 'fa fa-dot-circle-o', 59, 0, '2016-05-30 01:25:02', 1),
(67, 'bugs_assignment', 'admin/report/bugs_assignment', 'fa fa-dot-circle-o', 59, 1, '2016-05-30 01:25:02', 1),
(68, 'project_report', 'admin/report/project_report', 'fa fa-dot-circle-o', 59, 2, '2016-05-30 01:25:02', 1),
(70, 'departments', 'admin/departments', 'fa fa-user-secret', 0, 13, '2017-06-18 22:34:27', 1),
(109, 'pull-down', '', '', 0, 11, '2017-06-18 22:34:28', 0),
(110, 'filemanager', 'admin/filemanager', 'fa fa-file', 0, 3, '2017-06-18 20:58:02', 1),
(111, 'company_details', 'admin/settings', 'fa fa-fw fa-info-circle', 25, 1, '2017-04-25 09:38:46', 2),
(112, 'system_settings', 'admin/settings/system', 'fa fa-fw fa-desktop', 25, 2, '2017-04-25 09:38:46', 2),
(113, 'email_settings', 'admin/settings/email', 'fa fa-fw fa-envelope', 25, 3, '2017-04-25 09:38:46', 2),
(114, 'email_templates', 'admin/settings/templates', 'fa fa-fw fa-pencil-square', 25, 4, '2017-04-25 09:38:46', 2),
(115, 'email_integration', 'admin/settings/email_integration', 'fa fa-fw fa-envelope-o', 25, 5, '2017-04-25 09:38:46', 2),
(116, 'payment_settings', 'admin/settings/payments', 'fa fa-fw fa-dollar', 25, 6, '2017-04-25 09:38:46', 2),
(117, 'invoice_settings', 'admin/settings/invoice', 'fa fa-fw fa-money', 25, 0, '2017-04-25 09:38:46', 2),
(118, 'estimate_settings', 'admin/settings/estimate', 'fa fa-fw fa-file-o', 25, 0, '2017-04-25 09:38:46', 2),
(119, 'tickets_leads_settings', 'admin/settings/tickets', 'fa fa-fw fa-ticket', 25, 0, '2017-04-25 09:38:46', 2),
(120, 'theme_settings', 'admin/settings/theme', 'fa fa-fw fa-code', 25, 0, '2017-04-25 09:38:46', 2),
(121, 'working_days', 'admin/settings/working_days', 'fa fa-fw fa-calendar', 25, 0, '2017-04-25 09:43:41', 2),
(125, 'customer_group', 'admin/settings/customer_group', 'fa fa-fw fa-users', 25, 0, '2017-04-25 09:43:41', 2),
(127, 'lead_status', 'admin/settings/lead_status', 'fa fa-fw fa-list-ul', 25, 0, '2017-04-25 09:43:41', 2),
(128, 'lead_source', 'admin/settings/lead_source', 'fa fa-fw fa-arrow-down', 25, 0, '2017-04-25 09:43:41', 2),
(129, 'opportunities_state_reason', 'admin/settings/opportunities_state_reason', 'fa fa-fw fa-dot-circle-o', 25, 0, '2017-04-25 09:43:41', 2),
(130, 'custom_field', 'admin/settings/custom_field', 'fa fa-fw fa-star-o', 25, 0, '2017-04-25 09:43:41', 2),
(131, 'payment_method', 'admin/settings/payment_method', 'fa fa-fw fa-money', 25, 0, '2017-04-25 09:43:41', 2),
(132, 'cronjob', 'admin/settings/cronjob', 'fa fa-fw fa-contao', 25, 0, '2017-04-25 09:46:20', 2),
(133, 'menu_allocation', 'admin/settings/menu_allocation', 'fa fa-fw fa fa-compass', 25, 0, '2017-04-25 09:46:20', 2),
(134, 'notification', 'admin/settings/notification', 'fa fa-fw fa-bell-o', 25, 0, '2017-04-25 09:46:20', 2),
(136, 'database_backup', 'admin/settings/database_backup', 'fa fa-fw fa-database', 25, 0, '2017-04-25 09:46:20', 2),
(137, 'translations', 'admin/settings/translations', 'fa fa-fw fa-language', 25, 0, '2017-04-25 09:46:20', 2),
(138, 'system_update', 'admin/settings/system_update', 'fa fa-fw fa-pencil-square-o', 25, 0, '2017-04-25 09:46:20', 2),
(139, 'private_chat', 'admin/message', 'fa fa-envelope', 0, 17, '2017-06-18 22:34:27', 1);");

        $this->db->query("DROP TABLE tbl_account_details;");

        $this->db->query("CREATE TABLE IF NOT EXISTS `tbl_account_details` (
  `account_details_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `employment_id` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'en_US',
  `address` varchar(64) COLLATE utf8_unicode_ci DEFAULT '-',
  `phone` varchar(32) COLLATE utf8_unicode_ci DEFAULT '-',
  `mobile` varchar(32) COLLATE utf8_unicode_ci DEFAULT '',
  `skype` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `language` varchar(40) COLLATE utf8_unicode_ci DEFAULT 'english',
  `designations_id` int(11) DEFAULT '0',
  `avatar` varchar(200) COLLATE utf8_unicode_ci DEFAULT 'uploads/default_avatar.jpg',
  `joining_date` date DEFAULT NULL,
  `present_address` text COLLATE utf8_unicode_ci,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maratial_status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`account_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;");

        $this->db->query("DROP TABLE tbl_users;");
        $this->db->query("CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2',
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(4) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `online_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = online 0 = offline ',
  `permission` text COLLATE utf8_unicode_ci,
  `active_email` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_email_type` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_encription` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_action` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_host_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_port` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smtp_additional_flag` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_postmaster_run` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `media_path_slug` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
    }
}