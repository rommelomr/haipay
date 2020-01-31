INSERT INTO `personas` (`id`, `nombre`, `cedula`, `created_at`, `updated_at`) VALUES
(1, 'root', NULL, '2019-11-21 21:31:47', '2019-11-21 21:31:47'),
(2, 'Rommel Montoya', NULL, '2019-11-21 21:31:47', '2019-11-21 21:31:47');

INSERT INTO `users` (`id`, `id_persona`, `email`, `email_verified_at`, `password`, `fecha_nacimiento`, `estado`, `tipo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'root@root.com', NULL, '$2y$10$.Ow35MqAVARI/Kyqpz0VPO4AHVU84sb41PFO9YdoARp.F/z9vphKW', NULL, 1, 3, NULL, '2019-11-21 21:31:48', '2019-11-21 21:31:48'),
(2, 2, 'rommelmontoya97@gmail.com', NULL, '$2y$10$lZseG47xh/m95XSJvfBXPOjKyBqKUncYfUOXG2E5ZD54cMRFWFOcS', NULL, 1, 1, NULL, '2019-11-21 21:31:48', '2019-11-21 21:31:48');

INSERT INTO `tipo_transaccion` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Compra de criptomoneda', NULL, NULL),
(2, 'Cambio de moneda', NULL, NULL),
(3, 'Envio de remesa', NULL, NULL),
(4, 'Retiro', NULL, NULL);

INSERT INTO `metodos_pago` (`nombre`, `estado`, `created_at`, `updated_at`) VALUES
('Mon Cash', '1', NULL, NULL),
('Wester Union', '1', NULL, NULL),
('MoneyGram', '1', NULL, NULL),
('paypal', '1', NULL, NULL),
('Skrill', '1', NULL, NULL),
('Uphold', '1', NULL, NULL),
('Zelle', '1', NULL, NULL),
('Payoneer', '1', NULL, NULL),
('Deposit', '1', NULL, NULL),
('Bank Account', '1', NULL, NULL);

INSERT INTO `criptomonedas` (`nombre`, `siglas`, `created_at`, `updated_at`) VALUES
('XRP', 'XRP', NULL, NULL),
('Bitcoin', 'BTC', NULL, NULL),
('Litecoin', 'LTC', NULL, NULL),
('Ethereum', 'ETH', NULL, NULL),
('Dogecoin', 'DOGE', NULL, NULL);