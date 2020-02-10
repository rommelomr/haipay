INSERT INTO `personas` (`id`, `nombre`, `cedula`, `created_at`, `updated_at`) VALUES
(1, 'root', NULL, '2019-11-22 01:31:47', '2019-11-22 01:31:47'),
(2, 'Carlos Bolivar', NULL, '2020-02-10 19:05:15', '2020-02-10 19:05:15'),
(3, 'kewin', NULL, '2020-02-10 19:05:33', '2020-02-10 19:05:33'),
(4, 'moderador', '0000001', '2020-02-10 20:16:29', '2020-02-10 20:16:29'),
(5, 'Administrador', '0000002', '2020-02-10 20:16:53', '2020-02-10 20:16:53');

INSERT INTO `users` (`id`, `id_persona`, `email`, `email_verified_at`, `password`, `fecha_nacimiento`, `telefono`, `estado`, `tipo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'root@root.com', NULL, '$2y$10$.Ow35MqAVARI/Kyqpz0VPO4AHVU84sb41PFO9YdoARp.F/z9vphKW', NULL, NULL, 1, 3, NULL, '2019-11-22 01:31:48', '2019-11-22 01:31:48'),
(2, 2, 'carlos@gmail.com', NULL, '$2y$10$rLuM.6J70KKx/T6ip7Fq2.UDVLeDuWB86K7kpV8Dnu7wmgwHnzTFm', NULL, NULL, 1, 1, NULL, '2020-02-10 19:05:16', '2020-02-10 19:05:16'),
(3, 3, 'kewin@gmail.com', NULL, '$2y$10$QbG6.aCT.TrOPyAMFXI7.u5/xJglrrpqeykJlf9Myv5TZ8jTYMKvu', NULL, NULL, 1, 1, NULL, '2020-02-10 19:05:34', '2020-02-10 19:05:34'),
(4, 4, 'mod@gmail.com', NULL, '$2y$10$XjMGgI7FZlkjv4y4hCCfa.OVvne6l0.Q6qAe/6zQKzRRQaOJcgIGS', '2020-01-01', NULL, 1, 2, NULL, '2020-02-10 20:16:30', '2020-02-10 20:16:30'),
(5, 5, 'admin@gmail.com', NULL, '$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q', '2020-01-01', NULL, 1, 3, NULL, '2020-02-10 20:16:53', '2020-02-10 20:16:53');

INSERT INTO `moderadores` (id_usuario, `created_at`, `updated_at`) VALUES
(4, '2020-02-10 20:16:53', '2020-02-10 20:16:53');


INSERT INTO `clientes` (id_usuario, estado, `created_at`, `updated_at`) VALUES
(2, 0, '2020-02-10 19:05:15', '2020-02-10 19:05:15'),
(3, 0, '2020-02-10 19:05:33', '2020-02-10 19:05:33');

INSERT INTO `tipos_transaccion` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Buy Cripto', NULL, NULL),
(2, 'Trade', NULL, NULL),
(3, 'Remittance', NULL, NULL),
(4, 'Retirement', NULL, NULL);

INSERT INTO `metodos_pago` (`nombre`, `estado`, `created_at`, `updated_at`) VALUES
('Change', '1', NULL, NULL),
('Deposit', '1', NULL, NULL),
('Bank Account', '1', NULL, NULL),
('Mon Cash', '1', NULL, NULL),
('Wester Union', '1', NULL, NULL),
('MoneyGram', '1', NULL, NULL),
('paypal', '1', NULL, NULL),
('Skrill', '1', NULL, NULL),
('Uphold', '1', NULL, NULL),
('Zelle', '1', NULL, NULL),
('Payoneer', '1', NULL, NULL);

INSERT INTO `monedas` (id, `nombre`, `siglas`, `created_at`, `updated_at`) VALUES
(1,'United States Dollar', 'USD', NULL, NULL),
(2,'XRP', 'XRP', NULL, NULL),
(3,'Bitcoin', 'BTC', NULL, NULL),
(4,'Litecoin', 'LTC', NULL, NULL),
(5,'Ethereum', 'ETH', NULL, NULL),
(6,'Dogecoin', 'DOGE', NULL, NULL);

INSERT INTO `hai_criptomonedas` (id_moneda) VALUES
(2),
(3),
(4),
(5),
(6);