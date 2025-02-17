CREATE TABLE mc_cafes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    organization_id INT DEFAULT NULL,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(100) DEFAULT NULL,
    address TEXT DEFAULT NULL,
    invoice_footer_text TEXT DEFAULT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_mc_cafes_organization_id FOREIGN KEY (organization_id) REFERENCES saas_organizations(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_cafes_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_cafes_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE mc_employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cafe_id INT DEFAULT NULL,
    user_id INT DEFAULT NULL,

    CONSTRAINT fk_mc_employees_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE mc_customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cafe_id INT DEFAULT NULL,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(100) DEFAULT NULL,
    address TEXT DEFAULT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_mc_customers_cafe_id FOREIGN KEY (cafe_id) REFERENCES mc_cafes(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_customers_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_customers_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE mc_sections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    organization_id INT DEFAULT NULL,
    name VARCHAR(100) NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_mc_sections_organization_id FOREIGN KEY (organization_id) REFERENCES saas_organizations(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_sections_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_sections_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE mc_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    organization_id INT DEFAULT NULL,
    section_id INT DEFAULT NULL,
    name VARCHAR(100) NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_mc_categories_organization_id FOREIGN KEY (organization_id) REFERENCES saas_organizations(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_categories_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_categories_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_categories_section_id FOREIGN KEY (section_id) REFERENCES mc_sections(id) ON DELETE SET NULL
);

CREATE TABLE mc_products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cafe_id INT DEFAULT NULL,
    target_id INT DEFAULT NULL,
    category_id INT DEFAULT NULL,
    name VARCHAR(100) NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_mc_products_cafe_id FOREIGN KEY (cafe_id) REFERENCES mc_cafes(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_products_target_id FOREIGN KEY (target_id) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_products_category_id FOREIGN KEY (category_id) REFERENCES mc_categories(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_products_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_products_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE mc_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cafe_id INT DEFAULT NULL,
    customer_id INT DEFAULT NULL,
    total_items INT DEFAULT NULL,
    total_qty INT DEFAULT NULL,
    code VARCHAR(100) NOT NULL,
    table_name VARCHAR(100) DEFAULT NULL,
    floor_name VARCHAR(100) DEFAULT NULL,
    status VARCHAR(100) NOT NULL DEFAULT "NEW", -- NEW, FINISH
    logs JSON DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_mc_orders_cafe_id FOREIGN KEY (cafe_id) REFERENCES mc_cafes(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_orders_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_orders_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL,

    CONSTRAINT fk_mc_orders_customer_id FOREIGN KEY (customer_id) REFERENCES mc_customers(id) ON DELETE SET NULL
);

CREATE TABLE mc_order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT DEFAULT NULL,
    target_id INT DEFAULT NULL,
    product_id INT DEFAULT NULL,
    qty INT DEFAULT NULL,
    status VARCHAR(100) NOT NULL DEFAULT "NEW", -- NEW, ON PROGRESS, DONE, CLOSE
    logs JSON DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_mc_order_items_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_order_items_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL,

    CONSTRAINT fk_mc_order_items_order_id FOREIGN KEY (order_id) REFERENCES mc_orders(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_order_items_target_id FOREIGN KEY (target_id) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_order_items_product_id FOREIGN KEY (product_id) REFERENCES mc_products(id) ON DELETE SET NULL
);
