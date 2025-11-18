<?php
/**
 * Script de réinitialisation complète de la base de données
 * ⚠️ ATTENTION : Ce script supprime toutes les données !
 * Accès : http://localhost/public/reset-database.php
 */

// Sécurité : demander confirmation
$confirmed = isset($_POST['confirm']) && $_POST['confirm'] === 'yes';

if (!$confirmed) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>⚠️ Réinitialiser la base de données</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
        <style>
            .warning-box {
                background-color: #fff3cd;
                border: 2px solid #ffc107;
                padding: 1.5rem;
                border-radius: 0.5rem;
                margin: 2rem 0;
            }
            .danger-button {
                background-color: #dc3545 !important;
            }
        </style>
    </head>
    <body>
        <main class="container">
            <h1>⚠️ Réinitialiser la base de données</h1>
            
            <div class="warning-box">
                <h2>🚨 ATTENTION - Action dangereuse !</h2>
                <p><strong>Cette action va :</strong></p>
                <ul>
                    <li>❌ Supprimer complètement la base de données</li>
                    <li>❌ Effacer tous les utilisateurs</li>
                    <li>❌ Effacer toutes les tâches</li>
                    <li>✅ Recréer une base de données vierge</li>
                    <li>✅ Créer les tables users et tasks</li>
                </ul>
                <p><strong style="color: red;">Toutes les données seront perdues définitivement !</strong></p>
            </div>

            <form method="POST">
                <label>
                    <input type="checkbox" name="understand" required>
                    Je comprends que toutes les données seront supprimées
                </label>

                <input type="hidden" name="confirm" value="yes">
                
                <button type="submit" class="danger-button">🗑️ Supprimer et réinitialiser la base de données</button>
            </form>

            <p><a href="index.php" role="button" class="secondary">← Annuler et retourner à l'accueil</a></p>
        </main>
    </body>
    </html>
    <?php
    exit;
}

// Si confirmé, procéder à la réinitialisation
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de la base de données</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <style>
        .success { color: green; }
        .error { color: red; }
        .info { color: blue; }
        pre { background: #f5f5f5; padding: 1rem; border-radius: 0.25rem; }
    </style>
</head>
<body>
    <main class="container">
        <h1>🔄 Réinitialisation de la base de données</h1>
        
        <?php
        try {
            // Charger la configuration
            $config = parse_ini_file(__DIR__ . '/../src/config/database.ini', true);

            if (!$config) {
                throw new Exception("Impossible de charger le fichier de configuration database.ini");
            }

            $host = $config['host'];
            $port = $config['port'];
            $database = $config['database'];
            $username = $config['username'];
            $password = $config['password'];

            echo "<h2>📋 Configuration</h2>";
            echo "<ul>";
            echo "<li><strong>Hôte :</strong> {$host}:{$port}</li>";
            echo "<li><strong>Base de données :</strong> {$database}</li>";
            echo "<li><strong>Utilisateur :</strong> {$username}</li>";
            echo "</ul>";

            // Connexion au serveur MySQL (sans sélectionner de base de données)
            echo "<p class='info'>🔌 Connexion au serveur MySQL...</p>";
            $pdo = new PDO("mysql:host=$host;port=$port;charset=utf8mb4", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<p class='success'>✅ Connexion réussie</p>";

            // Supprimer la base de données si elle existe
            echo "<p class='info'>🗑️ Suppression de la base de données '{$database}'...</p>";
            $pdo->exec("DROP DATABASE IF EXISTS `$database`");
            echo "<p class='success'>✅ Base de données supprimée</p>";

            // Créer la base de données
            echo "<p class='info'>➕ Création de la base de données '{$database}'...</p>";
            $pdo->exec("CREATE DATABASE `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
            echo "<p class='success'>✅ Base de données créée</p>";

            // Sélectionner la base de données
            echo "<p class='info'>📂 Sélection de la base de données...</p>";
            $pdo->exec("USE `$database`");
            echo "<p class='success'>✅ Base de données sélectionnée</p>";

            // Créer la table users
            echo "<p class='info'>👥 Création de la table 'users'...</p>";
            $sql = "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) NOT NULL UNIQUE,
                email VARCHAR(255) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                role VARCHAR(20) NOT NULL DEFAULT 'user',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
            $pdo->exec($sql);
            echo "<p class='success'>✅ Table 'users' créée</p>";

            // Créer la table tasks
            echo "<p class='info'>📝 Création de la table 'tasks'...</p>";
            $sql = "CREATE TABLE tasks (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                name VARCHAR(100) NOT NULL,
                description VARCHAR(200),
                status TEXT NOT NULL,
                priority TEXT NOT NULL,
                end_date DATE NOT NULL,
                category TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                CONSTRAINT fk_tasks_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                UNIQUE KEY unique_user_task (user_id, name)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
            $pdo->exec($sql);
            echo "<p class='success'>✅ Table 'tasks' créée</p>";

            // Créer un utilisateur de test (optionnel)
            echo "<p class='info'>👤 Création d'un utilisateur de test...</p>";
            $testPassword = password_hash('test123', PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES ('test', 'test@example.com', :password, 'user')");
            $stmt->execute(['password' => $testPassword]);
            echo "<p class='success'>✅ Utilisateur de test créé</p>";
            echo "<p><strong>Identifiants de test :</strong></p>";
            echo "<ul>";
            echo "<li><strong>Nom d'utilisateur :</strong> test</li>";
            echo "<li><strong>Email :</strong> test@example.com</li>";
            echo "<li><strong>Mot de passe :</strong> test123</li>";
            echo "</ul>";

            // Vérifier les tables créées
            echo "<h2>📊 Vérification</h2>";
            $stmt = $pdo->query("SHOW TABLES");
            $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
            echo "<p class='success'>✅ Tables créées : " . implode(', ', $tables) . "</p>";

            // Afficher la structure de la table users
            echo "<h3>Structure de la table 'users' :</h3>";
            $stmt = $pdo->query("DESCRIBE users");
            $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "<table>";
            echo "<thead><tr><th>Colonne</th><th>Type</th><th>Null</th><th>Clé</th><th>Défaut</th></tr></thead>";
            echo "<tbody>";
            foreach ($columns as $col) {
                echo "<tr>";
                echo "<td><code>{$col['Field']}</code></td>";
                echo "<td>{$col['Type']}</td>";
                echo "<td>{$col['Null']}</td>";
                echo "<td>{$col['Key']}</td>";
                echo "<td>" . ($col['Default'] ?? 'NULL') . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";

            // Afficher la structure de la table tasks
            echo "<h3>Structure de la table 'tasks' :</h3>";
            $stmt = $pdo->query("DESCRIBE tasks");
            $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "<table>";
            echo "<thead><tr><th>Colonne</th><th>Type</th><th>Null</th><th>Clé</th><th>Défaut</th></tr></thead>";
            echo "<tbody>";
            foreach ($columns as $col) {
                echo "<tr>";
                echo "<td><code>{$col['Field']}</code></td>";
                echo "<td>{$col['Type']}</td>";
                echo "<td>{$col['Null']}</td>";
                echo "<td>{$col['Key']}</td>";
                echo "<td>" . ($col['Default'] ?? 'NULL') . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";

            // Supprimer le fichier de verrouillage de migration s'il existe
            $lockFile = __DIR__ . '/../migration.lock';
            if (file_exists($lockFile)) {
                unlink($lockFile);
                echo "<p class='info'>🗑️ Fichier de verrouillage de migration supprimé</p>";
            }

            echo "<hr>";
            echo "<h2 class='success'>✅ Réinitialisation terminée avec succès !</h2>";
            echo "<p>La base de données a été complètement réinitialisée.</p>";
            
            echo "<h3>🎯 Prochaines étapes :</h3>";
            echo "<ol>";
            echo "<li>Connectez-vous avec le compte de test (test / test123)</li>";
            echo "<li>Ou créez un nouveau compte</li>";
            echo "<li>Commencez à utiliser l'application</li>";
            echo "</ol>";

            echo "<p><a href='auth/login.php' role='button'>Se connecter avec le compte de test</a></p>";
            echo "<p><a href='auth/register.php' role='button' class='secondary'>Créer un nouveau compte</a></p>";
            echo "<p><a href='index.php' role='button' class='contrast'>Retour à l'accueil</a></p>";

        } catch (Exception $e) {
            echo "<h2 class='error'>❌ Erreur lors de la réinitialisation</h2>";
            echo "<p class='error'><strong>Message :</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
            echo "<details>";
            echo "<summary>Voir la trace complète</summary>";
            echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
            echo "</details>";
            
            echo "<hr>";
            echo "<h3>💡 Vérifications à faire :</h3>";
            echo "<ol>";
            echo "<li>Le serveur MySQL est-il démarré dans MAMP ?</li>";
            echo "<li>Les identifiants dans <code>src/config/database.ini</code> sont-ils corrects ?</li>";
            echo "<li>L'utilisateur MySQL a-t-il les droits de créer/supprimer des bases de données ?</li>";
            echo "</ol>";
            
            echo "<p><a href='index.php' role='button' class='secondary'>Retour à l'accueil</a></p>";
        }
        ?>
    </main>
</body>
</html>