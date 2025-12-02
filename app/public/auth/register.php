<?php
require __DIR__ . '/../../src/utils/autoloader.php';
require __DIR__ . '/../../src/i18n/load-translation.php';

use Auth\UserManager;
use Auth\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

const MAIL_CONFIGURATION_FILE = __DIR__ . '/../../src/config/mail.ini';

session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $error = __t('register.error_mandatory');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = __t('register.error_invalid_email');
    } elseif ($password !== $confirmPassword) {
        $error = __t('register.error_incorrect');
    } elseif (strlen($password) < 8) {
        $error = __t('register.error_password_length');
    } else {
        try {
            $userManager = new UserManager();

            if ($userManager->usernameExists($username)) {
                $error = __t('register.error_taken');
            } elseif ($userManager->emailExists($email)) {
                $error = __t('register.error_email_taken');
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $user = new User(null, $username, $email, $hashedPassword, 'user');

                $userId = $userManager->createUser($user);

                if ($userId) {
                    $emailSent = false;
                    try {
                        $config = parse_ini_file(MAIL_CONFIGURATION_FILE, true);

                        if (!$config) {
                            throw new Exception(__t('register.error_mail_config'));
                        }

                        $host = $config['host'];
                        $port = filter_var($config['port'], FILTER_VALIDATE_INT);
                        $authentication = filter_var($config['authentication'], FILTER_VALIDATE_BOOLEAN);
                        $mail_username = $config['username'];
                        $mail_password = $config['password'];
                        $from_email = $config['from_email'];
                        $from_name = $config['from_name'];

                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host = $host;
                        $mail->Port = $port;
                        $mail->SMTPAuth = $authentication;

                        if ($authentication) {
                            $mail->Username = $mail_username;
                            $mail->Password = $mail_password;
                        }

                        if ($port == 465) {
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                        } else if ($port == 587) {
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        }

                        $mail->CharSet = "UTF-8";
                        $mail->Encoding = "base64";

                        $mail->setFrom($from_email, $from_name);
                        $mail->addAddress($email, $username);

                        $mail->isHTML(true);
                        $mail->Subject = __t('register.email_subject');
                        $mail->Body = sprintf(__t('register.email_body_html'), htmlspecialchars($username));
                        $mail->AltBody = sprintf(__t('register.email_body_text'), $username);

                        $mail->send();
                        $emailSent = true;
                    } catch (Exception $e) {
                        error_log("Erreur d'envoi d'email : {$e->getMessage()}");
                    }

                    if ($emailSent) {
                        $success = __t('register.success_creation_with_email');
                    } else {
                        $success = __t('register.success_creation');
                    }
                } else {
                    $error = __t('register.error_creation');
                }
            }
        } catch (\InvalidArgumentException $e) {
            $error = $e->getMessage();
        } catch (Exception $e) {
            $error = __t('register.error_creation') . ' ' . htmlspecialchars($e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars(__lang()) ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/digitallytailored/classless.css/classless.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <title><?= __t('register.title') ?></title>

    <style>
        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
            padding-top: 1rem;
        }

        .logo-container img {
            max-width: 200px;
            height: auto;
        }

        .user-info {
            text-align: right;
            margin-bottom: 1rem;
            padding: 0.5rem;
            background-color: var(--pico-background-color);
            border-radius: 0.25rem;
        }
    </style>
</head>

<body>
    <main class="container">

        <div class="logo-container">
            <a href="../tasks/index.php">
                <img src="../assets/img/taskboard.png" alt="Taskboard Logo">
            </a>
        </div>

        <h1><?= __t('register.h1') ?></h1>

        <?php if ($error): ?>
            <article style="background-color: var(--pico-del-color); padding: 1rem; margin: 1rem 0;">
                <p><strong><?= __t('register.error') ?></strong> <?= htmlspecialchars($error) ?></p>
            </article>
        <?php endif; ?>

        <?php if ($success): ?>
            <article style="background-color: var(--pico-ins-color); padding: 1rem; margin: 1rem 0;">
                <p><strong><?= __t('register.success') ?></strong> <?= htmlspecialchars($success) ?></p>
                <p><a href="login.php" style="font-weight: bold;"><?= __t('register.connect') ?></a></p>
            </article>
        <?php else: ?>
            <form method="post">
                <label for="username">
                    <?= __t('register.username') ?>
                    <input type="text" id="username" name="username"
                        value="<?= htmlspecialchars($username ?? '') ?>"
                        required autofocus minlength="3" maxlength="50"
                        placeholder="<?= __t('register.placeholder_username') ?>">
                </label>

                <label for="email">
                    <?= __t('register.email') ?>
                    <input type="email" id="email" name="email"
                        value="<?= htmlspecialchars($email ?? '') ?>"
                        required maxlength="255"
                        placeholder="<?= __t('register.placeholder_email') ?>">
                </label>

                <label for="password">
                    <?= __t('register.password') ?>
                    <input type="password" id="password" name="password"
                        required minlength="8"
                        placeholder="<?= __t('register.placeholder_password') ?>">
                </label>

                <label for="confirm_password">
                    <?= __t('register.confirm_password') ?>
                    <input type="password" id="confirm_password" name="confirm_password"
                        required minlength="8"
                        placeholder="<?= __t('register.placeholder_confirm') ?>">
                </label>

                <button type="submit"><?= __t('register.submit') ?></button>
            </form>
        <?php endif; ?>

        <p><?= __t('register.to_login') ?> <a href="login.php"><?= __t('register.connect') ?></a></p>
        <p><a href="../index.php"><?= __t('register.return_home') ?></a></p>
    </main>
</body>

</html>