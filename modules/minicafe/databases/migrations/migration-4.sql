ALTER TABLE mc_payments ADD COLUMN payment_method VARCHAR(100) DEFAULT "CASH";
ALTER TABLE mc_payments ADD COLUMN payment_reference VARCHAR(100) DEFAULT NULL;