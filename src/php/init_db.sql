
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
        email VARCHAR(120) NULL,
        is_active TINYINT(1) NOT NULL DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

    CREATE TABLE IF NOT EXISTS feedback (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NULL,
        name VARCHAR(80) NOT NULL,
        rating TINYINT NOT NULL,
        message VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_feedback_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
        CONSTRAINT chk_feedback_rating CHECK (rating BETWEEN 1 AND 5)
    );

    CREATE TABLE IF NOT EXISTS plan_selections (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NULL,
        plan_name ENUM('Basic', 'Standard', 'Premium') NOT NULL,
        billing_cycle ENUM('monthly', 'yearly') NOT NULL DEFAULT 'monthly',
        selected_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_plan_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
    );

    CREATE INDEX idx_feedback_created_at ON feedback (created_at);
    CREATE INDEX idx_plan_selected_at ON plan_selections (selected_at);
