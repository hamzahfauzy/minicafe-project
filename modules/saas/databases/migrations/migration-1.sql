CREATE TABLE saas_organizations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    owner_id INT DEFAULT NULL,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(100) DEFAULT NULL,
    address TEXT DEFAULT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_saas_organizations_owner_id FOREIGN KEY (owner_id) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_saas_organizations_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_saas_organizations_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE saas_plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT DEFAULT NULL,
    features JSON DEFAULT NULL,
    monthly_price DECIMAL(10,2) DEFAULT NULL,
    annualy_price DECIMAL(10,2) DEFAULT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_saas_plans_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_saas_plans_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE saas_invoices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plan_id INT DEFAULT NULL,
    organization_id INT DEFAULT NULL,
    code VARCHAR(100) NOT NULL,
    total_price DECIMAL(10,2) DEFAULT NULL,
    qty INT DEFAULT NULL,
    unit VARCHAR(100) NOT NULL DEFAULT "MONTHLY",
    status VARCHAR(100) NOT NULL DEFAULT "PENDING",
    payment_at TIMESTAMP NULL DEFAULT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_saas_invoices_plan_id FOREIGN KEY (plan_id) REFERENCES saas_plans(id) ON DELETE SET NULL,
    CONSTRAINT fk_saas_invoices_organization_id FOREIGN KEY (organization_id) REFERENCES saas_organizations(id) ON DELETE SET NULL,
    CONSTRAINT fk_saas_invoices_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_saas_invoices_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE saas_subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plan_id INT DEFAULT NULL,
    organization_id INT DEFAULT NULL,
    status VARCHAR(100) NOT NULL DEFAULT "ACTIVE",
    start_at TIMESTAMP NULL DEFAULT NULL,
    expired_at TIMESTAMP NULL DEFAULT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_saas_subscriptions_plan_id FOREIGN KEY (plan_id) REFERENCES saas_plans(id) ON DELETE SET NULL,
    CONSTRAINT fk_saas_subscriptions_organization_id FOREIGN KEY (organization_id) REFERENCES saas_organizations(id) ON DELETE SET NULL,
    CONSTRAINT fk_saas_subscriptions_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_saas_subscriptions_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);