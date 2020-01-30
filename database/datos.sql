INSERT INTO `personas` (`id`, `nombre`, `cedula`, `created_at`, `updated_at`) VALUES
(2, 'root', NULL, '2019-11-21 21:31:47', '2019-11-21 21:31:47');

INSERT INTO `users` (`id`, `id_persona`, `email`, `email_verified_at`, `password`, `fecha_nacimiento`, `estado`, `tipo`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 2, 'root@root.com', NULL, '$2y$10$.Ow35MqAVARI/Kyqpz0VPO4AHVU84sb41PFO9YdoARp.F/z9vphKW', NULL, 1, 3, NULL, '2019-11-21 21:31:48', '2019-11-21 21:31:48');

INSERT INTO `tipo_transaccion` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Compra de criptomoneda', NULL, NULL),
(2, 'Cambio de moneda', NULL, NULL),
(3, 'Envio de remesa', NULL, NULL),
(4, 'Retiro', NULL, NULL);

INSERT INTO `metodos_pago` (`id`, `nombre`, `estado`, `created_at`, `updated_at`) VALUES (1, 'paypal', '1', NULL, NULL);

INSERT INTO `criptomonedas` (`id`, `nombre`, `siglas`, `created_at`, `updated_at`) VALUES(NULL, 'XRP', 'XRP', NULL, NULL),
(NULL, 'Ethereum', 'ETH', NULL, NULL),
(NULL, 'Litecoin', 'LTC', NULL, NULL),
(NULL, 'Bitcoin Cash', 'BCH', NULL, NULL),
(NULL, 'Bitcoin', 'BTC', NULL, NULL),
(NULL, 'DASH', 'DASH', NULL, NULL),
(NULL, 'Stellar', 'XLM', NULL, NULL),
(NULL, 'Dai', 'DAI', NULL, NULL),
(NULL, 'Bitcoin SV', 'BSV', NULL, NULL),
(NULL, 'Zcash', 'ZEC', NULL, NULL),
(NULL, 'EOS', 'EOS', NULL, NULL),
(NULL, 'Ethereum Classic', 'ETC', NULL, NULL),
(NULL, 'Basic Attention Token', 'BAT', NULL, NULL),
(NULL, 'Augur', 'REP', NULL, NULL),
(NULL, '0x Protocol Token', 'ZRX', NULL, NULL),
(NULL, 'Link', 'LINK', NULL, NULL);
