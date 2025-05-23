INSERT INTO roles (name) VALUES ('Owner'),('Operator'),('Waiter'),('Kitchen'),('Cashier');
INSERT INTO role_routes (role_id,route_path,order_number) VALUES 
((SELECT id FROM roles WHERE name = 'Owner'), 'default/*', 10),
((SELECT id FROM roles WHERE name = 'Owner'), '!default/settings/index', 9),
((SELECT id FROM roles WHERE name = 'Owner'), 'minicafe/operators/*', 9),
((SELECT id FROM roles WHERE name = 'Owner'), 'minicafe/waiters/*', 9),
((SELECT id FROM roles WHERE name = 'Owner'), 'minicafe/kitchens/*', 9),
((SELECT id FROM roles WHERE name = 'Owner'), 'minicafe/caschiers/*', 9),
((SELECT id FROM roles WHERE name = 'Owner'), 'minicafe/reports/*', 9),
((SELECT id FROM roles WHERE name = 'Owner'), 'crud/*?table=mc_cafes', 10),
((SELECT id FROM roles WHERE name = 'Owner'), 'crud/*?table=mc_customers', 10),
((SELECT id FROM roles WHERE name = 'Owner'), 'crud/*?table=mc_sections', 10),
((SELECT id FROM roles WHERE name = 'Owner'), 'crud/*?table=mc_categories', 10),
((SELECT id FROM roles WHERE name = 'Owner'), 'crud/*?table=mc_products', 10),
((SELECT id FROM roles WHERE name = 'Owner'), 'crud/*?table=mc_product_prices', 10),
((SELECT id FROM roles WHERE name = 'Owner'), 'crud/index?table=mc_orders', 10),

((SELECT id FROM roles WHERE name = 'Operator'), 'default/*', 10),
((SELECT id FROM roles WHERE name = 'Operator'), '!default/settings/index', 9),
((SELECT id FROM roles WHERE name = 'Operator'), 'minicafe/waiters/*', 9),
((SELECT id FROM roles WHERE name = 'Operator'), 'minicafe/kitchens/*', 9),
((SELECT id FROM roles WHERE name = 'Operator'), 'minicafe/cashiers/*', 9),
((SELECT id FROM roles WHERE name = 'Operator'), 'minicafe/reports/*', 9),
((SELECT id FROM roles WHERE name = 'Operator'), 'crud/*?table=mc_customers', 10),
((SELECT id FROM roles WHERE name = 'Operator'), 'crud/*?table=mc_products', 10),
((SELECT id FROM roles WHERE name = 'Operator'), 'crud/index?table=mc_orders', 10),
((SELECT id FROM roles WHERE name = 'Operator'), 'crud/index?table=mc_order_items', 10),
((SELECT id FROM roles WHERE name = 'Operator'), 'crud/index?table=mc_orders', 10),
((SELECT id FROM roles WHERE name = 'Operator'), 'crud/index?table=mc_orders&filter%5Bstatus%5D=NEW', 10),
((SELECT id FROM roles WHERE name = 'Operator'), 'crud/index?table=mc_orders&filter%5Bstatus%5D=FINISH', 10),
((SELECT id FROM roles WHERE name = 'Operator'), 'minicafe/orders/close-item', 10),

((SELECT id FROM roles WHERE name = 'Waiter'), 'default/*', 10),
((SELECT id FROM roles WHERE name = 'Waiter'), '!default/settings/index', 9),
((SELECT id FROM roles WHERE name = 'Waiter'), 'crud/index?table=mc_order_items', 10),
((SELECT id FROM roles WHERE name = 'Waiter'), 'crud/index?table=mc_orders', 10),
((SELECT id FROM roles WHERE name = 'Waiter'), 'crud/index?table=mc_orders&filter%5Bstatus%5D=NEW', 10),
((SELECT id FROM roles WHERE name = 'Waiter'), 'crud/index?table=mc_orders&filter%5Bstatus%5D=FINISH', 10),
((SELECT id FROM roles WHERE name = 'Waiter'), 'minicafe/orders/create', 10),
((SELECT id FROM roles WHERE name = 'Waiter'), 'minicafe/orders/close-item', 10),

((SELECT id FROM roles WHERE name = 'Kitchen'), 'default/*', 10),
((SELECT id FROM roles WHERE name = 'Kitchen'), '!default/settings/index', 9),
((SELECT id FROM roles WHERE name = 'Kitchen'), 'crud/index?table=mc_order_items', 10),
((SELECT id FROM roles WHERE name = 'Kitchen'), 'minicafe/orders/approve-item', 10),
((SELECT id FROM roles WHERE name = 'Kitchen'), 'minicafe/orders/done-item', 10);