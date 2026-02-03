<?php
/**
 * Database Configuration and Connection Class
 * Optimized with PDO, prepared statements, and connection management
 */

class Database {
    private static ?PDO $instance = null;
    
    private const HOST = 'localhost';
    private const DB_NAME = 'dinewithus';
    private const USERNAME = 'root';
    private const PASSWORD = '';
    private const CHARSET = 'utf8mb4';
    
    /**
     * Get database connection instance (Singleton pattern)
     */
    public static function getInstance(): PDO {
        if (self::$instance === null) {
            try {
                $dsn = "mysql:host=" . self::HOST . ";dbname=" . self::DB_NAME . ";charset=" . self::CHARSET;
                
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_PERSISTENT => true,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . self::CHARSET
                ];
                
                self::$instance = new PDO($dsn, self::USERNAME, self::PASSWORD, $options);
            } catch (PDOException $e) {
                error_log("Database Connection Error: " . $e->getMessage());
                throw new Exception("Database connection failed. Please try again later.");
            }
        }
        
        return self::$instance;
    }
    
    /**
     * Execute a prepared query and return results
     */
    public static function query(string $sql, array $params = []): array {
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    
    /**
     * Execute a prepared query and return single row
     */
    public static function queryOne(string $sql, array $params = []): ?array {
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch();
        return $result ?: null;
    }
    
    /**
     * Execute INSERT/UPDATE/DELETE and return affected rows
     */
    public static function execute(string $sql, array $params = []): int {
        $stmt = self::getInstance()->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    }
    
    /**
     * Get last inserted ID
     */
    public static function lastInsertId(): string {
        return self::getInstance()->lastInsertId();
    }
    
    /**
     * Begin transaction
     */
    public static function beginTransaction(): bool {
        return self::getInstance()->beginTransaction();
    }
    
    /**
     * Commit transaction
     */
    public static function commit(): bool {
        return self::getInstance()->commit();
    }
    
    /**
     * Rollback transaction
     */
    public static function rollback(): bool {
        return self::getInstance()->rollBack();
    }
    
    // Prevent cloning and unserialization
    private function __construct() {}
    private function __clone() {}
    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }
}

/**
 * Security helper functions
 */
class Security {
    /**
     * Generate CSRF token
     */
    public static function generateCSRFToken(): string {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        
        return $_SESSION['csrf_token'];
    }
    
    /**
     * Verify CSRF token
     */
    public static function verifyCSRFToken(string $token): bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    
    /**
     * Sanitize input
     */
    public static function sanitize(string $input): string {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
    
    /**
     * Validate email
     */
    public static function validateEmail(string $email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    /**
     * Check if user is logged in
     */
    public static function isLoggedIn(): bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    }
    
    /**
     * Check if user is admin
     */
    public static function isAdmin(): bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
    }
    
    /**
     * Redirect with message
     */
    public static function redirect(string $url, string $message = '', string $type = 'info'): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if ($message) {
            $_SESSION['flash_message'] = ['text' => $message, 'type' => $type];
        }
        
        header("Location: $url");
        exit;
    }
    
    /**
     * Get and clear flash message
     */
    public static function getFlashMessage(): ?array {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (isset($_SESSION['flash_message'])) {
            $message = $_SESSION['flash_message'];
            unset($_SESSION['flash_message']);
            return $message;
        }
        
        return null;
    }
}

/**
 * User helper class
 */
class User {
    /**
     * Get current user data
     */
    public static function getCurrentUser(): ?array {
        if (!Security::isLoggedIn()) {
            return null;
        }
        
        return Database::queryOne(
            "SELECT id_client, nom, prenom, email, image_profile FROM client WHERE id_client = ?",
            [$_SESSION['user_id']]
        );
    }
    
    /**
     * Get user by ID
     */
    public static function getById(int $id): ?array {
        return Database::queryOne(
            "SELECT id_client, nom, prenom, email, image_profile FROM client WHERE id_client = ?",
            [$id]
        );
    }
    
    /**
     * Get user by email
     */
    public static function getByEmail(string $email): ?array {
        return Database::queryOne(
            "SELECT * FROM client WHERE email = ?",
            [$email]
        );
    }
}
