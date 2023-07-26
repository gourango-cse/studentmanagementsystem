<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* E-mail Messages */

// Account verification
$lang['sms_email_verification_subject'] = 'Vérification de Compte';
$lang['sms_email_verification_code'] = 'Votre code de vérification est: ';
$lang['sms_email_verification_text'] = " Vous pouvez également cliquer sur (ou copier coller) le lien suivant.\n\n";

// Password reset
$lang['sms_email_reset_subject'] = 'Réinitialiser le mot de passe';
$lang['sms_email_reset_text'] = "Pour réinitialiser votre mot de passe cliquez sur (ou copiez collez dans la barre d'adresse de votre navigateur) le lien ci-dessous:\n\n";

// Password reset success
$lang['sms_email_reset_success_subject'] = "Réinitialisation de mot de passe réussie";
$lang['sms_email_reset_success_new_password'] = "Votre mot de passe a été réinitialisé avec succès. Votre nouveau mot de passe est: ";


/* Error Messages */

// Account creation errors
$lang['sms_error_email_exists'] = "Cette adresse email est déjà utilisée. Si vous avez oublié votre mot de passe cliquez sur le lien ci-dessous.";
$lang['sms_error_username_exists'] = "Un compte avec ce nom d'utilisateur existe déjà. Merci de renseigner un nom d'utilisateur différent. Si vous avez oublié votre mot de passe cliquez sur le lien ci-dessous.";
$lang['sms_error_email_invalid'] = "Adresse email invalide";
$lang['sms_error_password_invalid'] = "Mot de passe invalide";
$lang['sms_error_username_invalid'] = "Nom d'utilisateur invalide";
$lang['sms_error_username_required'] = "Nom d'utilisateur requis";
$lang['sms_error_totp_code_required'] = "Code TOTP requis";
$lang['sms_error_totp_code_invalid'] = "Code TOTP invalide";


// Account update errors
$lang['sms_error_update_email_exists'] = "Cette adresse email est déjà utilisée. Merci de renseigner une adresse email différente.";
$lang['sms_error_update_username_exists'] = "Ce nom d'utilisateur est déjà utilisé. Merci de renseigner un nom d'utilisateur différent.";


// Access errors
$lang['sms_error_no_access'] = "Désolé, vous n'avez pas accès à cette ressource.";
$lang['sms_error_login_failed_email'] = "L'adresse email et le mot de passe ne correspondent pas.";
$lang['sms_error_login_failed_name'] = "Le nom d'utilisateur et le mot de passe ne correspondent pas.";
$lang['sms_error_login_failed_all'] = "L'adresse email, le nom d'utilisateur ou le mot de passe ne correspondent pas.";
$lang['sms_error_login_attempts_exceeded'] = "Vous avez dépassé le nombre de tentatives de connexion autorisées, votre compte a été bloqué.";
$lang['sms_error_recaptcha_not_correct'] = 'Désolé, le texte renseigné pour le reCAPTCHA est incorrect.';

// Misc. errors
$lang['sms_error_no_user'] = "L'utilisateur n'existe pas.";
$lang['sms_error_account_not_verified'] = "Votre compte n'a pas été confirmé. Merci de vérifier vos email et de confirmer votre compte.";
$lang['sms_error_no_group'] = "Le groupe n'existe pas";
$lang['sms_error_self_pm'] = "Il impossible de vous envoyer un message à vous-même.";
$lang['sms_error_no_pm'] = "Message privé introuvable";


/* Info messages */
$lang['sms_info_already_member'] = "L'utilisateur est déjà membre de ce groupe";
$lang['sms_info_group_exists'] = "Ce nom de groupe existe déjà";
$lang['sms_info_perm_exists'] = "Ce nom de permission existe déjà";
