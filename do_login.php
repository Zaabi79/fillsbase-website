<?php
/**
 * Custom login handler — avoids WHMCS double-init issue with dologin.php
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /login');
    exit;
}

require_once __DIR__ . '/init.php';

$username   = trim($_POST['username'] ?? '');
$password   = $_POST['password'] ?? '';
$rememberme = !empty($_POST['rememberme']) ? 'on' : '';

if (!$username || !$password) {
    header('Location: /login?error=missing');
    exit;
}

// Try WHMCS localAPI first, fall back to direct DB check
$result = localAPI('ValidateLogin', [
    'email'    => $username,
    'password' => $password,
]);

$userId = 0;
if (!empty($result['result']) && $result['result'] === 'success') {
    $userId = (int)$result['userid'];
} else {
    // Fallback: direct DB authentication (handles Inactive accounts or missing tblusers)
    $client = \WHMCS\Database\Capsule::table('tblclients')
        ->where('email', $username)
        ->first();
    if ($client && password_verify($password, $client->password)) {
        // Activate if Inactive
        if ($client->status === 'Inactive') {
            \WHMCS\Database\Capsule::table('tblclients')
                ->where('id', $client->id)
                ->update(['status' => 'Active']);
        }
        $userId = (int)$client->id;
    }
}

if ($userId > 0) {

    // Use WHMCS SSO token so WHMCS handles session setup properly
    $sso = localAPI('CreateSsoToken', ['client_id' => $userId]);
    if (!empty($sso['access_token'])) {
        $goto = $_POST['goto'] ?? '';
        $after = ($goto && strpos($goto, '/') === 0) ? $goto : '/clientarea.php';
        header('Location: /oauth/singlesignon.php?access_token=' . urlencode($sso['access_token']) . '&redirect=' . urlencode($after));
        exit;
    }

    // Fallback: manual session (may not work with all WHMCS versions)
    \WHMCS\Session::set('uid',      $userId);
    \WHMCS\Session::set('upw',      md5($password));
    \WHMCS\Session::set('loggedin', true);
    \WHMCS\Session::set('username', $username);

    $goto = $_POST['goto'] ?? '';
    $redirect = ($goto && strpos($goto, '/') === 0) ? $goto : '/clientarea.php';
    header('Location: ' . $redirect);
    exit;
} else {
    $apiMsg = $result['message'] ?? 'no_message';
    header('Location: /login?error=invalid&debug=' . urlencode($apiMsg));
    exit;
}
