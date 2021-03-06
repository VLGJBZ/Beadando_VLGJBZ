<?php 
if(!array_key_exists('P', $_GET) || empty($_GET['P']))
	$_GET['P'] = 'home';

switch ($_GET['P']) {
	case 'home': require_once PROTECTED_DIR.'normal/home.php'; break;
	case 'test': require_once PROTECTED_DIR.'normal/permission_test.php'; break;

	case 'search': require_once PROTECTED_DIR.'felulet/search.php'; break;

	case 'edit_theme': require_once PROTECTED_DIR.'felulet/edit_theme.php'; break;

	case 'add_theme': require_once PROTECTED_DIR.'felulet/add_theme.php'; break;

	case 'flist': require_once PROTECTED_DIR.'felulet/theme_list.php'; break;

	case 'forum_theme': require_once PROTECTED_DIR.'felulet/forum_theme.php'; break;

	case 'user': require_once PROTECTED_DIR.'user/profile.php'; break;

	case 'worker': require_once PROTECTED_DIR.'worker/profile.php'; break;

	case 'add_worker': IsUserLoggedIn() ? require_once PROTECTED_DIR.'worker/add.php' : header('Location: index.php'); break;

	case 'edit_worker': IsUserLoggedIn() ? require_once PROTECTED_DIR.'worker/edit.php' : header('Location: index.php'); break;

	case 'list_worker': IsUserLoggedIn() ? require_once PROTECTED_DIR.'worker/list.php' : header('Location: index.php'); break;

	case 'login': !IsUserLoggedIn() ? require_once PROTECTED_DIR.'user/login.php' : header('Location: index.php'); break;

	case 'register': !IsUserLoggedIn() ? require_once PROTECTED_DIR.'user/register.php' : header('Location: index.php'); break;

	case 'logout': IsUserLoggedIn() ? UserLogout() : header('Location: index.php'); break;

	case 'users': IsUserLoggedIn() ? require_once PROTECTED_DIR.'user/user_list.php' : header('Location: index.php'); break;

	default: require_once PROTECTED_DIR.'normal/404.php'; break;
}

?>