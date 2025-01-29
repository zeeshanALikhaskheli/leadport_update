-- --------------------------------------------------------------------------------------------------------------
--  @CRM SAAS VERSION 2.4
-- ---------------------------------------------------------------------------------------------------------------

-- CUSTOM TASK PRIORITIES

DROP TABLE IF EXISTS `tasks_priority`;
CREATE TABLE `tasks_priority` (
  `taskpriority_id` int(11) NOT NULL AUTO_INCREMENT,
  `taskpriority_created` datetime DEFAULT NULL,
  `taskpriority_creatorid` int(11) DEFAULT NULL,
  `taskpriority_updated` datetime DEFAULT NULL,
  `taskpriority_title` varchar(200) NOT NULL,
  `taskpriority_position` int(11) NOT NULL,
  `taskpriority_color` varchar(100) NOT NULL DEFAULT 'default' COMMENT 'default|primary|success|info|warning|danger|lime|brown',
  `taskpriority_system_default` varchar(10) NOT NULL DEFAULT 'no' COMMENT 'yes | no',
  PRIMARY KEY (`taskpriority_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='[do not truncate]  expected to have 2 system default statuses (ID: 1 & 2) ''new'' & ''converted'' statuses ';

INSERT INTO `tasks_priority` (`taskpriority_id`, `taskpriority_created`, `taskpriority_creatorid`, `taskpriority_updated`, `taskpriority_title`, `taskpriority_position`, `taskpriority_color`, `taskpriority_system_default`) VALUES
(1,	NULL,	0,	now(),	'Normal',	1,	'lime',	'yes'),
(2,	NULL,	0,	now(),	'Low',	2,	'success',	'no'),
(3,	NULL,	0,	now(),	'High',	3,	'warning',	'no'),
(4,	NULL,	0,	now(),	'Urgent',	4,	'danger',	'no');

ALTER TABLE `tasks`
ADD `task_priority_temp` int NULL DEFAULT '1' AFTER `task_priority`;

UPDATE tasks SET task_priority_temp = 1 WHERE task_priority = 'normal';
UPDATE tasks SET task_priority_temp = 2 WHERE task_priority = 'low';
UPDATE tasks SET task_priority_temp = 3 WHERE task_priority = 'high';
UPDATE tasks SET task_priority_temp = 4 WHERE task_priority = 'urgent';

ALTER TABLE `tasks`
DROP `task_priority`;

ALTER TABLE `tasks`
CHANGE `task_priority_temp` `task_priority` int(11) NULL DEFAULT '1' AFTER `task_previous_status`;


-- MILESTONE COLOR CODING
ALTER TABLE `milestone_categories`
ADD `milestonecategory_color` varchar(100) NULL DEFAULT 'default' COMMENT 'default|primary|success|info|warning|danger|lime|brown';

ALTER TABLE `milestones`
ADD `milestone_color` varchar(50) COLLATE 'utf8_general_ci' NOT NULL DEFAULT 'default' COMMENT 'default|primary|success|info|warning|danger|lime|brown';

ALTER TABLE `settings`
ADD `settings_tasks_kanban_milestone` text COLLATE 'utf8_general_ci' NULL AFTER `settings_tasks_kanban_priority`;

UPDATE settings SET settings_tasks_kanban_milestone = 'hide';

-- CUSTOM TABLE VIEW

ALTER TABLE `tableconfig`
ENGINE='MyISAM';
ALTER TABLE `tableconfig`
ADD `tableconfig_custom_1` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_2` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_3` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_4` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_5` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_6` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_7` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_8` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_9` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_10` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_11` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_12` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_13` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_14` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_15` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_16` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_17` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_18` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_19` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_20` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_21` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_22` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_23` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_24` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_25` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_26` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_27` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_28` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_29` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_30` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_31` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_32` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_33` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_34` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_35` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_36` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_37` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_38` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_39` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_40` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_41` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_42` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_43` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_44` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_45` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_46` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_47` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_48` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_49` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_50` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_51` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_52` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_53` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_54` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_55` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_56` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_57` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_58` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_59` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_60` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_61` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_62` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_63` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_64` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_65` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_66` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_67` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_68` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_69` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed',
ADD `tableconfig_custom_70` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'hidden' COMMENT 'hidden|displayed';


-- FIX WEB FORM SENDING EMAIL TO ADMIN
INSERT INTO `email_templates` (`emailtemplate_module_unique_id`, `emailtemplate_module_name`, `emailtemplate_name`, `emailtemplate_lang`, `emailtemplate_type`, `emailtemplate_category`, `emailtemplate_subject`, `emailtemplate_body`, `emailtemplate_variables`, `emailtemplate_created`, `emailtemplate_updated`, `emailtemplate_status`, `emailtemplate_language`, `emailtemplate_real_template`, `emailtemplate_show_enabled`) VALUES
(NULL,	NULL,	'New Web Form Submitted',	'template_lang_lead_form_submitted',	'team',	'leads',	'New Form Submitted',	'<!DOCTYPE html>\r\n<html>\r\n\r\n<head>\r\n\r\n    <meta charset=\"utf-8\">\r\n    <meta http-equiv=\"x-ua-compatible\" content=\"ie=edge\">\r\n    <title>Email Confirmation</title>\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n    <style type=\"text/css\">\r\n        @media screen {\r\n            @font-face {\r\n                font-family: \'Source Sans Pro\';\r\n                font-style: normal;\r\n                font-weight: 400;\r\n                src: local(\'Source Sans Pro Regular\'), local(\'SourceSansPro-Regular\'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format(\'woff\');\r\n            }\r\n\r\n            @font-face {\r\n                font-family: \'Source Sans Pro\';\r\n                font-style: normal;\r\n                font-weight: 700;\r\n                src: local(\'Source Sans Pro Bold\'), local(\'SourceSansPro-Bold\'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format(\'woff\');\r\n            }\r\n        }\r\n\r\n        body,\r\n        table,\r\n        td,\r\n        a {\r\n            -ms-text-size-adjust: 100%;\r\n            /* 1 */\r\n            -webkit-text-size-adjust: 100%;\r\n            /* 2 */\r\n        }\r\n\r\n        img {\r\n            -ms-interpolation-mode: bicubic;\r\n        }\r\n\r\n        a[x-apple-data-detectors] {\r\n            font-family: inherit !important;\r\n            font-size: inherit !important;\r\n            font-weight: inherit !important;\r\n            line-height: inherit !important;\r\n            color: inherit !important;\r\n            text-decoration: none !important;\r\n        }\r\n\r\n        div[style*=\"margin: 16px 0;\"] {\r\n            margin: 0 !important;\r\n        }\r\n\r\n        body {\r\n            width: 100% !important;\r\n            height: 100% !important;\r\n            padding: 0 !important;\r\n            margin: 0 !important;\r\n            padding: 24px;\r\n            font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;\r\n            font-size: 16px;\r\n            background-color: #f9fafc;\r\n            color: #60676d;\r\n        }\r\n\r\n        table {\r\n            border-collapse: collapse !important;\r\n        }\r\n\r\n        a {\r\n            color: #1a82e2;\r\n        }\r\n\r\n        img {\r\n            height: auto;\r\n            line-height: 100%;\r\n            text-decoration: none;\r\n            border: 0;\r\n            outline: none;\r\n        }\r\n\r\n        .table-1 {\r\n            max-width: 600px;\r\n        }\r\n\r\n        .table-1 td {\r\n            padding: 36px 24px 40px;\r\n            text-align: center;\r\n            font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;\r\n        }\r\n\r\n        .table-1 h1 {\r\n            margin: 0;\r\n            font-size: 32px;\r\n            font-weight: 600;\r\n            letter-spacing: -1px;\r\n            line-height: 48px;\r\n            font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;\r\n        }\r\n\r\n        .table-2 {\r\n            max-width: 600px;\r\n        }\r\n\r\n        .table-2 td {\r\n            padding: 36px 24px 0;\r\n            border-top: 3px solid #d4dadf;\r\n            background-color: #ffffff;\r\n            font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;\r\n        }\r\n\r\n        .table-2 h1 {\r\n            margin: 0;\r\n            font-size: 20px;\r\n            font-weight: 600;\r\n            letter-spacing: -1px;\r\n            line-height: 48px;\r\n            font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;\r\n        }\r\n\r\n        .table-3 {\r\n            max-width: 600px;\r\n        }\r\n\r\n        .table-2 td {\r\n\r\n            background-color: #ffffff;\r\n            font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;\r\n        }\r\n\r\n        .td-1 {\r\n            padding: 24px;\r\n            font-size: 16px;\r\n            line-height: 24px;\r\n            background-color: #ffffff;\r\n            text-align: left;\r\n            padding-bottom: 10px;\r\n            padding-top: 0px;\r\n            font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;\r\n        }\r\n\r\n        .table-gray {\r\n            width: 100%;\r\n        }\r\n\r\n        .table-gray tr {\r\n            height: 24px;\r\n        }\r\n\r\n        .table-gray .td-1 {\r\n            background-color: #f1f3f7;\r\n            width: 30%;\r\n            border: solid 1px #e7e9ec;\r\n            padding-top: 5px;\r\n            padding-bottom: 5px;\r\n            font-size:16px;\r\n            font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;\r\n        }\r\n\r\n        .table-gray .td-2 {\r\n            background-color: #f1f3f7;\r\n            width: 70%;\r\n            border: solid 1px #e7e9ec;\r\n            font-size:16px;\r\n            font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;\r\n        }\r\n\r\n        .button, .button:active, .button:visited {\r\n            display: inline-block;\r\n            padding: 16px 36px;\r\n            font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;\r\n            font-size: 16px;\r\n            color: #ffffff;\r\n            text-decoration: none;\r\n            border-radius: 6px;\r\n            background-color: #1a82e2;\r\n            border-radius: 6px;\r\n        }\r\n\r\n        .signature {\r\n            padding: 24px;\r\n            font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;\r\n            font-size: 16px;\r\n            line-height: 24px;\r\n            border-bottom: 3px solid #d4dadf;\r\n            background-color: #ffffff;\r\n        }\r\n\r\n        .footer {\r\n            max-width: 600px;\r\n        }\r\n\r\n        .footer td {\r\n            padding: 12px 24px;\r\n            font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;\r\n            font-size: 14px;\r\n            line-height: 20px;\r\n            color: #666;\r\n        }\r\n\r\n        .td-button {\r\n            padding: 12px;\r\n            background-color: #ffffff;\r\n            text-align: center;\r\n            font-family: \'Source Sans Pro\', Helvetica, Arial, sans-serif;\r\n        }\r\n\r\n        .p-24 {\r\n            padding: 24px;\r\n        }\r\n    </style>\r\n\r\n</head>\r\n\r\n<body>\r\n<!-- start body -->\r\n<table style=\"height: 744px; width: 100%;\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><!-- start hero -->\r\n<tbody>\r\n<tr style=\"height: 75px;\">\r\n<td style=\"height: 75px;\" align=\"center\">\r\n<table class=\"table-1\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td align=\"left\">\r\n<h1>New Form Submitted</h1>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<!-- end hero --> <!-- start hero -->\r\n<tr style=\"height: 75px;\">\r\n<td style=\"height: 75px;\" align=\"center\">\r\n<table class=\"table-2\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td align=\"left\">\r\n<h1>Hi {first_name},</h1>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<!-- end hero --> <!-- start copy block -->\r\n<tr style=\"height: 519px;\">\r\n<td style=\"height: 519px;\" align=\"center\">\r\n<table class=\"table-3\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><!-- start copy -->\r\n<tbody>\r\n<tr>\r\n<td class=\"td-1\">\r\n<p>A new lead form has been submitted.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class=\"td-1\">\r\n<table class=\"table-gray\" cellpadding=\"5\">\r\n<tbody>\r\n<tr>\r\n<td class=\"td-1\" style=\"width: 204.3px;\"><strong>Form Name</strong></td>\r\n<td class=\"td-2\" style=\"width: 479.7px;\">{form_name}</td>\r\n</tr>\r\n<tr>\r\n<td class=\"td-1\" style=\"width: 204.3px;\"><strong>From Name</strong></td>\r\n<td class=\"td-2\" style=\"width: 479.7px;\">{submitted_by_name}</td>\r\n</tr>\r\n<tr>\r\n<td class=\"td-1\" style=\"width: 204.3px;\"><strong>From Email</strong></td>\r\n<td class=\"td-2\" style=\"width: 479.7px;\">{submitted_by_email}</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>{form_content}<br /><br />You can manage your lead via the dashboard.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\" bgcolor=\"#ffffff\">\r\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td class=\"td-button\">\r\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\"><a class=\"button\" href=\"{lead_url}\" target=\"_blank\" rel=\"noopener\">Manage Lead</a></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class=\"signature\">\r\n<p>{email_signature}</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<!-- end copy block --> <!-- start footer -->\r\n<tr style=\"height: 75px;\">\r\n<td class=\"p-24\" style=\"height: 75px;\" align=\"center\">\r\n<table class=\"footer\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><!-- start permission -->\r\n<tbody>\r\n<tr>\r\n<td align=\"center\">\r\n<p>{email_footer}</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<!-- end footer --></tbody>\r\n</table>\r\n<!-- end body -->\r\n</body>\r\n\r\n</html>',	'{first_name}, {form_name}, {submitted_by_name}, {submitted_by_email}, {form_content}, {lead_url}',	'2024-01-27 15:08:11',	'2024-01-27 15:08:11',	'enabled',	'english',	'yes',	'yes');


-- HIDE COMPLETED TASKS
ALTER TABLE `users`
ADD `pref_hide_completed_tasks` varchar(50) COLLATE 'utf8_general_ci' NULL DEFAULT 'no' COMMENT 'yes | no' AFTER `pref_filter_own_tasks`;

-- (end) update javascript and version number
update settings set settings_version = '2.4';

UPDATE settings SET settings_system_javascript_versioning = now() Where settings_id = 1;

UPDATE settings SET settings_type = 'saas';

-- --------------------------------------------------------------------------------------------------------------
--  @CRM SAAS VERSION 2.5
-- ---------------------------------------------------------------------------------------------------------------

-- SCHEDULE INVOICE AND ESTIMATE PUBLISHING
ALTER TABLE `invoices`
ADD `bill_publishing_type` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'instant' COMMENT 'instant|scheduled',
ADD `bill_publishing_scheduled_date` date NULL AFTER `bill_publishing_type`,
ADD `bill_publishing_scheduled_status` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT '' COMMENT 'pending|published|failed' AFTER `bill_publishing_scheduled_date`,
ADD `bill_publishing_scheduled_log` text COLLATE 'utf8_general_ci' NULL AFTER `bill_publishing_scheduled_status`;

ALTER TABLE `estimates`
ADD `bill_publishing_type` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'instant' COMMENT 'instant|scheduled',
ADD `bill_publishing_scheduled_date` date NULL AFTER `bill_publishing_type`,
ADD `bill_publishing_scheduled_status` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT '' COMMENT 'pending|published|failed' AFTER `bill_publishing_scheduled_date`,
ADD `bill_publishing_scheduled_log` text COLLATE 'utf8_general_ci' NULL AFTER `bill_publishing_scheduled_status`;

-- TASKS & LEADS COVER IMAGES
ALTER TABLE `tasks`
CHANGE `task_cloning_original_task_id` `task_cloning_original_task_id` text COLLATE 'utf8_general_ci' NULL AFTER `task_recurring_finished`,
ADD `task_cover_image` varchar(10) COLLATE 'utf8_general_ci' NULL DEFAULT 'no' COMMENT 'yes|no' AFTER `task_cloning_original_task_id`,
ADD `task_cover_image_uniqueid` text COLLATE 'utf8_general_ci' NULL AFTER `task_cover_image`,
ADD `task_cover_image_filename` text COLLATE 'utf8_general_ci' NULL AFTER `task_cover_image_uniqueid`,
CHANGE `task_custom_field_31` `task_custom_field_31` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_30`,
CHANGE `task_custom_field_32` `task_custom_field_32` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_31`,
CHANGE `task_custom_field_33` `task_custom_field_33` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_32`,
CHANGE `task_custom_field_34` `task_custom_field_34` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_33`,
CHANGE `task_custom_field_35` `task_custom_field_35` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_34`,
CHANGE `task_custom_field_36` `task_custom_field_36` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_35`,
CHANGE `task_custom_field_37` `task_custom_field_37` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_36`,
CHANGE `task_custom_field_38` `task_custom_field_38` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_37`,
CHANGE `task_custom_field_39` `task_custom_field_39` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_38`,
CHANGE `task_custom_field_40` `task_custom_field_40` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_39`,
CHANGE `task_custom_field_41` `task_custom_field_41` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_40`,
CHANGE `task_custom_field_42` `task_custom_field_42` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_41`,
CHANGE `task_custom_field_43` `task_custom_field_43` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_42`,
CHANGE `task_custom_field_44` `task_custom_field_44` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_43`,
CHANGE `task_custom_field_45` `task_custom_field_45` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_44`,
CHANGE `task_custom_field_46` `task_custom_field_46` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_45`,
CHANGE `task_custom_field_47` `task_custom_field_47` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_46`,
CHANGE `task_custom_field_48` `task_custom_field_48` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_47`,
CHANGE `task_custom_field_49` `task_custom_field_49` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_48`,
CHANGE `task_custom_field_50` `task_custom_field_50` text COLLATE 'utf8_general_ci' NULL AFTER `task_custom_field_49`;

ALTER TABLE `leads`
ADD `lead_cover_image` varchar(10) COLLATE 'utf8_general_ci' NULL DEFAULT 'no' COMMENT 'yes|no' AFTER `lead_visibility`,
ADD `lead_cover_image_uniqueid` text COLLATE 'utf8_general_ci' NULL AFTER `lead_cover_image`,
ADD `lead_cover_image_filename` text COLLATE 'utf8_general_ci' NULL AFTER `lead_cover_image_uniqueid`;

ALTER TABLE `leads`
CHANGE `lead_custom_field_61` `lead_custom_field_61` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_60`,
CHANGE `lead_custom_field_62` `lead_custom_field_62` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_61`,
CHANGE `lead_custom_field_63` `lead_custom_field_63` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_62`,
CHANGE `lead_custom_field_64` `lead_custom_field_64` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_63`,
CHANGE `lead_custom_field_65` `lead_custom_field_65` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_64`,
CHANGE `lead_custom_field_66` `lead_custom_field_66` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_65`,
CHANGE `lead_custom_field_67` `lead_custom_field_67` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_66`,
CHANGE `lead_custom_field_68` `lead_custom_field_68` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_67`,
CHANGE `lead_custom_field_69` `lead_custom_field_69` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_68`,
CHANGE `lead_custom_field_70` `lead_custom_field_70` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_69`,
CHANGE `lead_custom_field_71` `lead_custom_field_71` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_70`,
CHANGE `lead_custom_field_72` `lead_custom_field_72` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_71`,
CHANGE `lead_custom_field_73` `lead_custom_field_73` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_72`,
CHANGE `lead_custom_field_74` `lead_custom_field_74` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_73`,
CHANGE `lead_custom_field_75` `lead_custom_field_75` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_74`,
CHANGE `lead_custom_field_76` `lead_custom_field_76` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_75`,
CHANGE `lead_custom_field_77` `lead_custom_field_77` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_76`,
CHANGE `lead_custom_field_78` `lead_custom_field_78` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_77`,
CHANGE `lead_custom_field_79` `lead_custom_field_79` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_78`,
CHANGE `lead_custom_field_80` `lead_custom_field_80` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_79`,
CHANGE `lead_custom_field_81` `lead_custom_field_81` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_80`,
CHANGE `lead_custom_field_82` `lead_custom_field_82` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_81`,
CHANGE `lead_custom_field_83` `lead_custom_field_83` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_82`,
CHANGE `lead_custom_field_84` `lead_custom_field_84` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_83`,
CHANGE `lead_custom_field_85` `lead_custom_field_85` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_84`,
CHANGE `lead_custom_field_86` `lead_custom_field_86` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_85`,
CHANGE `lead_custom_field_87` `lead_custom_field_87` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_86`,
CHANGE `lead_custom_field_88` `lead_custom_field_88` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_87`,
CHANGE `lead_custom_field_89` `lead_custom_field_89` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_88`,
CHANGE `lead_custom_field_90` `lead_custom_field_90` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_89`,
CHANGE `lead_custom_field_91` `lead_custom_field_91` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_90`,
CHANGE `lead_custom_field_92` `lead_custom_field_92` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_91`,
CHANGE `lead_custom_field_93` `lead_custom_field_93` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_92`,
CHANGE `lead_custom_field_94` `lead_custom_field_94` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_93`,
CHANGE `lead_custom_field_95` `lead_custom_field_95` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_94`,
CHANGE `lead_custom_field_96` `lead_custom_field_96` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_95`,
CHANGE `lead_custom_field_97` `lead_custom_field_97` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_96`,
CHANGE `lead_custom_field_98` `lead_custom_field_98` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_97`,
CHANGE `lead_custom_field_99` `lead_custom_field_99` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_98`,
CHANGE `lead_custom_field_100` `lead_custom_field_100` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_99`,
CHANGE `lead_custom_field_101` `lead_custom_field_101` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_100`,
CHANGE `lead_custom_field_102` `lead_custom_field_102` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_101`,
CHANGE `lead_custom_field_103` `lead_custom_field_103` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_102`,
CHANGE `lead_custom_field_104` `lead_custom_field_104` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_103`,
CHANGE `lead_custom_field_105` `lead_custom_field_105` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_104`,
CHANGE `lead_custom_field_106` `lead_custom_field_106` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_105`,
CHANGE `lead_custom_field_107` `lead_custom_field_107` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_106`,
CHANGE `lead_custom_field_108` `lead_custom_field_108` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_107`,
CHANGE `lead_custom_field_109` `lead_custom_field_109` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_108`,
CHANGE `lead_custom_field_110` `lead_custom_field_110` text COLLATE 'utf8_general_ci' NULL AFTER `lead_custom_field_109`;


ALTER TABLE `tasks_priority`
ADD INDEX `taskpriority_creatorid` (`taskpriority_creatorid`);

-- CANNED RESPONSES
ALTER TABLE `roles`
ADD `role_canned` varchar(20) COLLATE 'utf8_general_ci' NOT NULL DEFAULT 'no' COMMENT 'yes|no',
ADD `role_canned_scope` varchar(20) COLLATE 'utf8_general_ci' NOT NULL DEFAULT 'own' COMMENT 'own|global' AFTER `role_canned`;

UPDATE roles SET role_canned = 'yes' WHERE role_id = 1;
UPDATE roles SET role_canned_scope = 'global' WHERE role_id = 1;

DROP TABLE IF EXISTS `canned`;
CREATE TABLE `canned` (
  `canned_id` int(11) NOT NULL AUTO_INCREMENT,
  `canned_created` datetime NOT NULL,
  `canned_updated` datetime NOT NULL,
  `canned_creatorid` int(11) DEFAULT NULL,
  `canned_categoryid` int(11) DEFAULT NULL,
  `canned_title` varchar(250) DEFAULT NULL,
  `canned_message` text DEFAULT NULL,
  `canned_visibility` varchar(20) DEFAULT 'public' COMMENT 'public|private',
  PRIMARY KEY (`canned_id`),
  KEY `canned_categoryid` (`canned_categoryid`),
  KEY `canned_creatorid` (`canned_creatorid`),
  KEY `canned_visibility` (`canned_visibility`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `canned_recently_used`;
CREATE TABLE `canned_recently_used` (
  `cannedrecent_id` int(11) NOT NULL AUTO_INCREMENT,
  `cannedrecent_created` datetime NOT NULL,
  `cannedrecent_updated` datetime NOT NULL,
  `cannedrecent_userid` int(11) NOT NULL,
  `cannedrecent_cannedid` int(11) NOT NULL,
  PRIMARY KEY (`cannedrecent_id`),
  KEY `cannedrecent_userid` (`cannedrecent_userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `categories` (`category_id`, `category_created`, `category_updated`, `category_creatorid`, `category_name`, `category_description`, `category_system_default`, `category_visibility`, `category_icon`, `category_type`, `category_slug`)
VALUES ('-1', now(), now(), '0', 'General', 'General canned responses', 'yes', 'everyone', 'sl-icon-docs', 'canned', '');

ALTER TABLE `categories`
COMMENT='[do not truncate][system defaults] - 1=project,2=client,3lead,4=invoice,5=estimate,6=contract,7=expense,8=item,9=ticket, 10=knowledgebase, 11=proposa, -1=cannedl';

ALTER TABLE `categories`
ADD `category_uniqueid` varchar(100) NOT NULL AFTER `category_id`;

UPDATE categories
SET category_uniqueid = CONCAT(
    LPAD(FLOOR(RAND() * 100000000), 8, '0'),
    '.',
    LPAD(FLOOR(RAND() * 100000000), 8, '0')
);


-- SEARCH
ALTER TABLE `settings2`
ADD `settings2_search_category_limit` int NULL DEFAULT '5' AFTER `settings2_file_bulk_download`;

UPDATE settings2 SET settings2_tickets_replying_interface = 'inline';

update settings set settings_version = '2.5';

UPDATE settings SET settings_system_javascript_versioning = now() Where settings_id = 1;

-- END
UPDATE settings SET settings_type = 'saas';