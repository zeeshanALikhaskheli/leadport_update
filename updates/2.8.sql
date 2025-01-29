-- PDF FONTS - CHINESE JAPANESE KOREAN FONTS
ALTER TABLE `settings2`
ADD `settings2_dompdf_fonts` text NULL;

UPDATE `settings2` SET `settings2_dompdf_fonts` = 'default';

-- IMPROVE TASK PERFORMANCE
ALTER TABLE `tasks`
ADD INDEX `task_position` (`task_position`),
ADD INDEX `task_status` (`task_status`),
ADD INDEX `task_calendar_reminder` (`task_calendar_reminder`),
ADD INDEX `task_date_start` (`task_date_start`),
ADD INDEX `task_date_due` (`task_date_due`),
ADD INDEX `task_previous_status` (`task_previous_status`),
ADD INDEX `task_cover_image` (`task_cover_image`),
ADD INDEX `task_priority` (`task_priority`);

ALTER TABLE `attachments`
ADD INDEX `attachmentresource_type` (`attachmentresource_type`),
ADD INDEX `attachmentresource_id` (`attachmentresource_id`),
ADD INDEX `attachment_creatorid` (`attachment_creatorid`),
ADD INDEX `attachment_clientid` (`attachment_clientid`);

ALTER TABLE `events_tracking`
ADD INDEX `eventtracking_source_id` (`eventtracking_source_id`),
ADD INDEX `eventtracking_source` (`eventtracking_source`);

ALTER TABLE `checklists`
ADD INDEX `checklist_position` (`checklist_position`);

ALTER TABLE `tasks_dependencies`
ADD INDEX `tasksdependency_creatorid` (`tasksdependency_creatorid`);

ALTER TABLE `projects`
ADD INDEX `project_calendar_reminder` (`project_calendar_reminder`);

ALTER TABLE `tasks_status`
ADD INDEX `taskstatus_system_default` (`taskstatus_system_default`),
ADD INDEX `taskstatus_position` (`taskstatus_position`),
ADD INDEX `taskstatus_creatorid` (`taskstatus_creatorid`);

ALTER TABLE `tasks_priority`
ADD INDEX `taskpriority_position` (`taskpriority_position`),
ADD INDEX `taskpriority_system_default` (`taskpriority_system_default`);

ALTER TABLE `pinned`
ADD INDEX `pinned_userid` (`pinned_userid`),
ADD INDEX `pinned_status` (`pinned_status`),
ADD INDEX `pinnedresource_type` (`pinnedresource_type`),
ADD INDEX `pinnedresource_id` (`pinnedresource_id`);

ALTER TABLE `automation_assigned`
ADD INDEX `automationassigned_resource_type` (`automationassigned_resource_type`),
ADD INDEX `automationassigned_resource_id` (`automationassigned_resource_id`),
ADD INDEX `automationassigned_userid` (`automationassigned_userid`);

ALTER TABLE `calendar_events`
ADD INDEX `calendar_event_creatorid` (`calendar_event_creatorid`),
ADD INDEX `calendar_event_all_day` (`calendar_event_all_day`),
ADD INDEX `calendar_event_reminder_sent` (`calendar_event_reminder_sent`);

-- HIDE DECIMALS
ALTER TABLE `settings`
ADD `settings_system_currency_hide_decimal` text COLLATE 'utf8_general_ci' NULL COMMENT 'yes|no' AFTER `settings_system_currency_position`;

UPDATE `settings` SET `settings_system_currency_hide_decimal` = 'no';

-- RECURRING EXPENSES
ALTER TABLE `expenses`
ADD `expense_recurring_duration` int NULL COMMENT 'e.g. 20 (for 20 days)',
ADD `expense_recurring_period` varchar(30) NULL COMMENT 'day | week | month | year' AFTER `expense_recurring_duration`,
ADD `expense_recurring_cycles` int NULL COMMENT '0 for infinity' AFTER `expense_recurring_period`,
ADD `expense_recurring_cycles_counter` int NULL COMMENT 'number of times it has been renewed' AFTER `expense_recurring_cycles`,
ADD `expense_recurring_last` datetime NULL COMMENT 'date when it was last renewed' AFTER `expense_recurring_cycles_counter`,
ADD `expense_recurring_next` datetime NULL COMMENT 'date when it will next be renewed' AFTER `expense_recurring_last`,
ADD `expense_recurring_child` varchar(5) NULL DEFAULT 'no' COMMENT 'yes|no' AFTER `expense_recurring_next`,
ADD `expense_recurring_parent_id` int NULL COMMENT 'if it was generated from a recurring invoice, the id of parent expense' AFTER `expense_recurring_child`;

ALTER TABLE `expenses`
ADD `expense_recurring` varchar(5) NULL DEFAULT 'no' COMMENT 'yes|no' AFTER `expense_billable_invoiceid`;

ALTER TABLE `expenses`
ADD `expense_cron_status` varchar(20) NULL DEFAULT 'none' COMMENT 'none|processing|completed|error  (used to prevent collisions when recurring invoiced)';

ALTER TABLE `expenses`
CHANGE `expense_recurring_cycles_counter` `expense_recurring_cycles_counter` int NULL DEFAULT '0' COMMENT 'number of times it has been renewed' AFTER `expense_recurring_cycles`;


-- COMMENT READ STATUS
ALTER TABLE `comments`
ADD `comment_client_status` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'unread' COMMENT 'read|unread' AFTER `comment_text`,
ADD `comment_team_status` varchar(20) COLLATE 'utf8_general_ci' NULL DEFAULT 'unread' COMMENT 'read|unread' AFTER `comment_client_status`;

UPDATE `comments` SET `comment_client_status` = 'read';
UPDATE `comments` SET `comment_team_status` = 'read';

-- TICKET NOTES
ALTER TABLE `ticket_replies`
ADD `ticketreply_type` varchar(10) COLLATE 'utf8_general_ci' NOT NULL DEFAULT 'reply' COMMENT 'reply|not';

--
-- Create table "modules"
--
CREATE TABLE modules (
  module_id INT(11) NOT NULL AUTO_INCREMENT,
  module_created DATETIME NOT NULL,
  module_updated DATETIME NOT NULL,
  module_name TEXT DEFAULT NULL,
  module_alias TEXT DEFAULT NULL,
  module_uniqueid TEXT DEFAULT NULL,
  module_description TEXT DEFAULT NULL,
  module_author_name TEXT DEFAULT NULL,
  module_author_url TEXT DEFAULT NULL,
  module_version TEXT DEFAULT NULL,
  module_status VARCHAR(30) DEFAULT 'disabled' COMMENT 'enabled|disabled',
  PRIMARY KEY (module_id)
)
ENGINE = MYISAM
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Alter table "roles"
--
ALTER TABLE roles
  ADD COLUMN modules LONGTEXT BINARY CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'json - permissions for all modules' AFTER role_canned_scope;

--
-- update version number
--
UPDATE settings SET settings_system_javascript_versioning = now() Where settings_id = 1;
update settings set settings_version = '2.8';

UPDATE settings SET settings_type = 'saas';