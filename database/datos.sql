INSERT INTO `personas` (`id`, `nombre`, `cedula`, `created_at`, `updated_at`) VALUES
(2, 'root', NULL, '2019-11-21 21:31:47', '2019-11-21 21:31:47');

INSERT INTO `users` (`id`, `id_persona`, `email`, `email_verified_at`, `password`, `fecha_nacimiento`, `estado`, `tipo`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 2, 'root@root.com', NULL, '$2y$10$.Ow35MqAVARI/Kyqpz0VPO4AHVU84sb41PFO9YdoARp.F/z9vphKW', NULL, 1, 3, NULL, '2019-11-21 21:31:48', '2019-11-21 21:31:48');
