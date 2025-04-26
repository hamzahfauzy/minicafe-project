ALTER TABLE mc_orders ADD COLUMN total_value DOUBLE(11,2) DEFAULT NULL;
ALTER TABLE mc_order_items ADD COLUMN price DOUBLE(11,2) DEFAULT NULL;
ALTER TABLE mc_order_items ADD COLUMN total DOUBLE(11,2) DEFAULT NULL;

CREATE TABLE mc_payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cafe_id INT DEFAULT NULL,
    order_id INT DEFAULT NULL,
    total_order DOUBLE(11,2) DEFAULT NULL,
    total_discount DOUBLE(11,2) NOT NULL,
    total_final DOUBLE(11,2) DEFAULT NULL,
    total_payment DOUBLE(11,2) DEFAULT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_mc_payments_cafe_id FOREIGN KEY (cafe_id) REFERENCES mc_cafes(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_payments_order_id FOREIGN KEY (order_id) REFERENCES mc_orders(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_payments_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_payments_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);


CREATE TABLE mc_product_prices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cafe_id INT DEFAULT NULL,
    product_id INT DEFAULT NULL,
    price DOUBLE(11,2) DEFAULT NULL,
    status VARCHAR(100) DEFAULT 'NON ACTIVE',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_mc_product_prices_cafe_id FOREIGN KEY (cafe_id) REFERENCES mc_cafes(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_product_prices_product_id FOREIGN KEY (product_id) REFERENCES mc_products(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_product_prices_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_mc_product_prices_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);