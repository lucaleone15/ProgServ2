<?php
require __DIR__ . '/../../src/utils/autoloader.php';
require __DIR__ . '/../../src/i18n/load-translation.php';
require __DIR__ . '/../../src/auth/auth-middleware.php';

// Protéger la page - nécessite d'être admin
requireRole('admin', '../index.php');

use Auth\UserManager;

$userManager = new UserManager();
$currentUserId = getCurrentUserId();
$currentUsername = getCurrentUsername();

// Traitement du changement de rôle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['new_role'])) {
    $userId = (int) $_POST['user_id'];
    $newRole = $_POST['new_role'];

    if ($userId !== $currentUserId) {
        $user = $userManager->getUserById($userId);
        if ($user) {
            $user->setRole($newRole);
            $userManager->updateUser($userId, $user);
            $success = __t('admin.role_updated');
        }
    } else {
        $error = __t('admin.cannot_edit_self_role');
    }
}

// Traitement suppression
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user_id'])) {
    $userId = (int) $_POST['delete_user_id'];

    if ($userId !== $currentUserId) {
        $userManager->deleteUser($userId);
        $success = __t('admin.user_deleted');
    } else {
        $error = __t('admin.cannot_delete_self');
    }
}

// Récupération utilisateurs
$users = $userManager->getAllUsers();
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

    <title><?= __t('admin.title') ?></title>

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

        <div class="user-info">
            <?= __t('home.logged_in_as') ?> <strong><?= htmlspecialchars($currentUsername) ?></strong>
            <span style="color: var(--pico-primary);">(Admin)</span>
            —
            <a href="../auth/logout.php"><?= __t('logout.logout') ?></a>
        </div>

        <h1><?= __t('admin.h1') ?></h1>

        <p>
            <a href="../index.php"><?= __t('index.breadcrumb.home') ?></a> >
            <?= __t('admin.breadcrumb') ?>
        </p>

        <?php if (isset($success)): ?>
            <article style="background-color: var(--pico-ins-color); padding: 1rem; margin: 1rem 0;">
                <p><strong>✓ <?= __t('admin.success') ?> :</strong> <?= htmlspecialchars($success) ?></p>
            </article>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <article style="background-color: var(--pico-del-color); padding: 1rem; margin: 1rem 0;">
                <p><strong>✗ <?= __t('admin.error') ?> :</strong> <?= htmlspecialchars($error) ?></p>
            </article>
        <?php endif; ?>

        <h2><?= __t('admin.user_list') ?> (<?= count($users) ?>)</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th><?= __t('admin.username') ?></th>
                    <th><?= __t('admin.email') ?></th>
                    <th><?= __t('admin.role') ?></th>
                    <th><?= __t('admin.actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user->getId() ?></td>
                        <td>
                            <strong><?= htmlspecialchars($user->getUsername()) ?></strong>
                            <?php if ($user->getId() === $currentUserId): ?>
                                <span style="color: var(--pico-primary);">(<?= __t('admin.you') ?>)</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($user->getEmail()) ?></td>
                        <td>
                            <span class="role-badge role-<?= $user->getRole() ?>">
                                <?= $user->getRole() === 'admin'
                                    ? __t('admin.role_admin')
                                    : __t('admin.role_user') ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <?php if ($user->getId() !== $currentUserId): ?>
                                    <!-- Changer rôle -->
                                    <form method="post">
                                        <input type="hidden" name="user_id" value="<?= $user->getId() ?>">
                                        <select name="new_role" onchange="this.form.submit()">
                                            <option value=""><?= __t('admin.change_role') ?></option>
                                            <option value="user" <?= $user->getRole() === 'user' ? 'disabled' : '' ?>>
                                                <?= __t('admin.role_user') ?>
                                            </option>
                                            <option value="admin" <?= $user->getRole() === 'admin' ? 'disabled' : '' ?>>
                                                <?= __t('admin.role_admin') ?>
                                            </option>
                                        </select>
                                    </form>

                                    <!-- Supprimer -->
                                    <form method="post"
                                        onsubmit="return confirm('<?= __t('admin.confirm_delete') ?>');">
                                        <input type="hidden" name="delete_user_id" value="<?= $user->getId() ?>">
                                        <button type="submit" class="secondary" style="padding: 0.5rem;"><?= __t('admin.delete') ?>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <span style="color: var(--pico-muted-color); font-size: 0.875rem;">
                                        <?= __t('admin.cannot_modify_self') ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p style="margin-top: 2rem;">
            <a href="../tasks/index.php">
                <button type="button">← <?= __t('admin.back_to_tasks') ?></button>
            </a>
        </p>

    </main>
</body>

</html>