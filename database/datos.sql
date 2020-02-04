INSERT INTO `personas` (`id`, `nombre`, `cedula`, `created_at`, `updated_at`) VALUES
(1, 'root', NULL, '2019-11-21 21:31:47', '2019-11-21 21:31:47'),
(2, 'Rommel Montoya', NULL, '2019-11-21 21:31:47', '2019-11-21 21:31:47'),
(3, 'Moderador', NULL, '2019-11-21 21:31:47', '2019-11-21 21:31:47'),
(4, 'Carlos Bolivar', NULL, '2019-11-21 21:31:47', '2019-11-21 21:31:47');

INSERT INTO `users` (`id`, `id_persona`, `email`, `email_verified_at`, `password`, `fecha_nacimiento`, `estado`, `tipo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'root@root.com', NULL, '$2y$10$.Ow35MqAVARI/Kyqpz0VPO4AHVU84sb41PFO9YdoARp.F/z9vphKW', NULL, 1, 3, NULL, '2019-11-21 21:31:48', '2019-11-21 21:31:48'),
(2, 2, 'rommelmontoya97@gmail.com', NULL, '$2y$10$lZseG47xh/m95XSJvfBXPOjKyBqKUncYfUOXG2E5ZD54cMRFWFOcS', NULL, 1, 1, NULL, '2019-11-21 21:31:48', '2019-11-21 21:31:48'),
(3, 3, 'mod@gmail.com', NULL, '$2y$10$lZseG47xh/m95XSJvfBXPOjKyBqKUncYfUOXG2E5ZD54cMRFWFOcS', NULL, 1, 2, NULL, '2019-11-21 21:31:48', '2019-11-21 21:31:48'),
(4, 4, 'carlos@gmail.com', NULL, '$2y$10$lZseG47xh/m95XSJvfBXPOjKyBqKUncYfUOXG2E5ZD54cMRFWFOcS', NULL, 1, 2, NULL, '2019-11-21 21:31:48', '2019-11-21 21:31:48');

INSERT INTO `clientes` (id_usuario, estado, `created_at`, `updated_at`) VALUES
(4, 0, NULL, NULL);

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