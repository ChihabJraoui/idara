<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 10/10/2015
 * Time: 10:49 PM
 */

class Res
{
	private static $icons = [
		//-- A --
		"actives" =>"header-icons/active.gif",
		"add-file" => "icons/add-file.png",
		"admin" =>"header-icons/admin.png",
		"archive" =>"header-icons/archive.gif",
		"about_icon" =>"icons/about.png",
		"addfav" =>"icons/addfav.png",

		//-- B --

		//-- C --
		"chat" =>"header-icons/chat.gif",
		"close_popup" =>"icons/close-popup.png",

		//-- D --
		"delete" => "icons/delete.png",
		"details" =>"header-icons/details.png",

		//-- E --
		"edit-file" => "icons/edit-file.png",
		"envelope" => "icons/envelope.png",

		//-- F --
		"female_icon" =>"icons/female.png",
		"folder" => "folders/folder.png",
		"folder_archived" =>"folders/folder_archived.gif",
		"folder_closed" =>"folders/folder_closed.gif",
		"folder_closed_topic" =>"folders/folder_closed_topic.gif",
		"folder_delete" =>"folders/folder_delete.gif",
		"folder_hold" =>"folders/folder_hold.gif",
		"folder_hot" =>"folders/folder_hot.gif",
		"folder_locked" =>"folders/folder_locked.gif",
		"folder_moderate" =>"folders/folder_moderate.gif",
		"folder_new" =>"folders/folder_new.png",
		"folder_new_delete" =>"folders/folder_new_delete.gif",
		"folder_new_edit" =>"folders/folder_new_edit.gif",
		"folder_new_hot" =>"folders/folder_new_hot.gif",
		"folder_new_locked" =>"folders/folder_new_locked.gif",
		"folder_new_unlocked" =>"folders/folder_new_unlocked.gif",
		"folder_new_sticky" =>"folders/folder_new_sticky.gif",
		"folder_new_sticky_locked" =>"folders/folder_new_sticky_locked.gif",
		"folder_new_topic" =>"folders/folder_new_topic.gif",
		"folder_open" =>"folders/folder_open.gif",
		"folder_open_topic" =>"folders/folder_open_topic.gif",
		"folder_edit" =>"folders/folder_edit.gif",
		"folder_order" =>"folders/folder_order.gif",
		"folder_new_order" =>"folders/folder_new_order.gif",
		"folder_sticky" =>"folders/folder_sticky.gif",
		"folder_sticky_locked" =>"folders/folder_sticky_locked.gif",
		"folder_topic_sticky" =>"folders/folder_topic_sticky.gif",
		"folder_topic_unsticky" =>"folders/folder_topic_unsticky.gif",
		"folder_unlocked" =>"folders/folder_unlocked.gif",
		"folder_unmoderated" =>"folders/folder_unmoderated.gif",
		"folder_other_cat" =>"folders/folder_other_cat.gif",
		"folder_other_forum" =>"folders/folder_other_forum.gif",
		//-- G --
		"gecko" =>"logos/gecko.png",
		"green_star" =>"stars/star_green.gif",
		"group_categories" =>"folders/group_categories.gif",

		//-- H --
		"Home" =>"header-icons/home.png",

		//-- I --
		"icon" =>"icons/icon.gif",
		"icon_unarchived" =>"icons/icon_archived.gif",
		"icon_archived" =>"icons/icon_unarchived.gif",
		"icon_closed_topic" =>"icons/icon_closed_topic.gif",
		"icon_complain" =>"icons/icon_complain.gif",
		"icon_complain_member" =>"icon_complain_member.gif",
		"icon_complain_members" =>"icon_complain_members.gif",
		"icon_complaint_not_solved" =>"icons/icon_complaint_not_solved.gif",
		"icon_complaint_reply" =>"icons/icon_complaint_reply.gif",
		"icon_complaint_solved" =>"icons/icon_complaint_solved.gif",
		"icon_complaint_topic" =>"icons/icon_complaint_topic.gif",
		"icon_contract" =>"icons/icon_contract.gif",
		"icon_expand" =>"icons/icon_expand.gif",
		"icon_delete_reply" =>"icons/icon_delete_reply.gif",
		"icon_edit" =>"icons/icon_edit.gif",
		"icon_moderation" =>"icons/icon_edit_moderator.gif",
		"icon_edit_topic" =>"icons/icon_edit_topic.gif",
		"icon_email" =>"icons/icon_email.gif",
		"icon_folder_archive" =>"icons/icon_folder_archive.gif",
		"icon_go_down" =>"icons/icon_go_down.gif",
		"icon_go_left" =>"icons/icon_go_left.gif",
		"icon_go_right" =>"icons/icon_go_right.gif",
		"icon_go_up" =>"icons/icon_go_up.gif",
		"icon_group" =>"icons/icon_group.gif",
		"icon_hidden" =>"icons/icon_hidden.gif",
		"icon_ip" =>"icons/icon_ip.gif",
		"icon_lastpost" =>"icons/icon_lastpost.gif",
		"icon_lock" =>"folders/lock.png",
		"icon_minus" =>"icons/icon_minus.gif",
		"icon_online" =>"icons/icon_online.gif",
		"icon_photo_none" =>"icons/icon_photo_none.gif",
		"icon_posticon_hold" =>"icons/icon_posticon_hold.gif",
		"icon_print" =>"icons/print.png",
		"icon_private_add" =>"icons/icon_private_add.gif",
		"icon_private_addall" =>"icons/icon_private_addall.gif",
		"icon_private_message" =>"icons/icon_private_message.gif",
		"icon_private_remall" =>"icons/icon_private_remall.gif",
		"icon_private_remove" =>"icons/icon_private_remove.gif",
		"icon_profile" =>"icons/icon_profile.gif",
		"icon_profile_locked" =>"icons/icon_profile_locked.gif",
		"icon_read_message" =>"icons/icon_read_message.gif",
		"icon_reply_topic" =>"icons/icon_reply_topic.gif",
		"icon_send_topic" =>"icons/icon_send_topic.gif",
		"icon_single" =>"icons/icon_single.gif",
		"icon_subscribe" =>"icons/icon_subscribe.gif",
		"icon_survey" =>"icons/icon_survey.gif",
		"icon_top_topic" =>"icons/icon_top_topic.gif",
		"icon_trash" =>"icons/icon_trash.gif",
		"icon_unhidden" =>"icons/icon_unhidden.gif",
		"icon_unlock" =>"icons/icon_unlock.gif",
		"icon_unread_message" =>"icons/icon_unread_message.gif",
		"icon_url" =>"icons/icon_url.gif",
		"icon_yahoo" =>"icons/icon_yahoo.gif",
		"icon_camera" =>"icons/icons_camera.gif",
		"icon_blank" =>"icons/icon_blank.gif",
		"icon_question" =>"icons/icon_question.gif",
		"icon_pb" =>"icons/icon_pb.gif",
		"icon_pbw" =>"icons/icon_pbw.gif",
		"icon_poll" =>"icons/icon_poll.gif",
		"icon_lock_poll" =>"icons/icon_lock_poll.gif",
		"icon_trash_poll" =>"icons/icon_trash_poll.gif",
		"icon_who_poll" =>"icons/icon_who_poll.gif",
		"icon_arrowdown" =>"icons/icon_arrowdown.gif",
		"icon_arrowup" =>"icons/icon_arrowup.gif",
		"icon_hold" =>"icons/icon_hold.gif",
		"icon_stats" =>"icons/icon_stats.gif",
		"icon_msg_red" =>"icons/icon_msg_red.gif",
		"icon_close" =>"icons/close.gif",

		"exit" =>"header-icons/exit.png",
		"help" =>"header-icons/help.png",

		"favorite" =>"header-icons/favorite.png",
		"search" =>"header-icons/search.png",
		"signin" =>"header-icons/signin.png",
		"register" =>"header-icons/register.png",


		//-- L --
		"logo" =>"logos/logo.png",

		//-- M --
		"male_icon" =>"icons/male.png",
		"message_icon" =>"icons/message.png",
		"members" =>"header-icons/members.png",
		"messages" =>"header-icons/messages.png",
		//-- N --
		"notification" =>"icons/notification.png",
		//-- P --
		"pencil" => "icons/pencil.png",
		"pin" => "icons/pin.png",
		"print" => "icons/print.png",
		//-- Q --
		"question" =>"icons/question.png",
		//-- R --
		"red_star" =>"stars/star_red.gif",
		"remove" => "icons/remove.png",
		//-- S --
		"searchicon64" =>"icons/searchicon64.png",
		"searchicon32" =>"icons/searchicon32.png",
		"searchicon24" =>"icons/searchicon24.png",
		"settings_icon" =>"icons/settings.png",
		"star-alt" => "icons/star-alt.png",
		"success" =>"icons/success.png",
		//-- U --
		//-- W --
		"warning" =>"icons/warning.png",
		"winner_ribbon" =>"icons/winner_ribbon.gif",
		//-- X --
		//-- Y --
		"yourposts" =>"header-icons/yourposts.png",
		"yourtopics" =>"header-icons/yourtopics.png"
		//-- Z --
	];



	/*
	 *
	 * Functions
	 *
	 */
	public static function getIcon($name)
	{
		return Config::ImagesFolder . self::$icons[$name];
	}
}