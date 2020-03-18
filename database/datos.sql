INSERT INTO `personas` (`id`, `nombre`, `cedula`, `created_at`, `updated_at`) VALUES
(1, 'root', NULL, '2019-11-22 01:31:47', '2019-11-22 01:31:47'),
(2, 'Carlos Bolivar', NULL, '2020-02-10 19:05:15', '2020-02-10 19:05:15'),
(3, 'kewin', NULL, '2020-02-10 19:05:33', '2020-02-10 19:05:33'),
(4, 'moderador', '0000001', '2020-02-10 20:16:29', '2020-02-10 20:16:29'),
(5, 'Administrador', '0000002', '2020-02-10 20:16:29', '2020-02-10 20:16:29'),
(6, 'Marcos', '000006', '2020-02-10 20:16:29', '2020-02-10 20:16:29'),
(7, 'Misael', '000007', '2020-02-10 20:16:29', '2020-02-10 20:16:29'),
(8, 'Andrea', '000008', '2020-02-10 20:16:29', '2020-02-10 20:16:29'),
(9, 'Edglis', '000009', '2020-02-10 20:16:29', '2020-02-10 20:16:29'),
(10, 'Estefani', '0000010', '2020-02-10 20:16:29', '2020-02-10 20:16:29'),
(11, 'Zoralid', '0000011', '2020-02-10 20:16:29', '2020-02-10 20:16:29'),
(12, 'Dioselid', '0000012', '2020-02-10 20:16:29', '2020-02-10 20:16:29'),
(13, 'Margaret', '0000013', '2020-02-10 20:16:29', '2020-02-10 20:16:29'),
(14, 'Juan Diego', '0000014', '2020-02-10 20:16:29', '2020-02-10 20:16:29'),
(15, 'Elianny', '0000015', '2020-02-10 20:16:29', '2020-02-10 20:16:29'),
(16, 'Ricardo', '0000016', '2020-02-10 20:16:29', '2020-02-10 20:16:29'),
(17, 'Emanuel', '0000017', '2020-02-10 20:16:29', '2020-02-10 20:16:29'),
(18, 'Sabrina', '0000018', '2020-02-10 20:16:29', '2020-02-10 20:16:29'),
(19, 'Mario', '0000019', '2020-02-10 20:16:29', '2020-02-10 20:16:29'),
(20, 'Adriana', '0000020', '2020-02-10 20:16:53', '2020-02-10 20:16:53');

INSERT INTO `users` (`id`, `id_persona`, `email`, `email_verified_at`, `password`, `fecha_nacimiento`, `telefono`, `estado`, `tipo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'root@root.com', NULL, '$2y$10$.Ow35MqAVARI/Kyqpz0VPO4AHVU84sb41PFO9YdoARp.F/z9vphKW', NULL, NULL, 1, 3, NULL, '2019-11-22 01:31:48', '2019-11-22 01:31:48'),
(2, 2, 'carlos@gmail.com', NULL, '$2y$10$rLuM.6J70KKx/T6ip7Fq2.UDVLeDuWB86K7kpV8Dnu7wmgwHnzTFm', NULL, NULL, 1, 1, NULL, '2020-02-10 19:05:16', '2020-02-10 19:05:16'),
(3, 3, 'kewin@gmail.com', NULL, '$2y$10$QbG6.aCT.TrOPyAMFXI7.u5/xJglrrpqeykJlf9Myv5TZ8jTYMKvu', NULL, NULL, 1, 1, NULL, '2020-02-10 19:05:34', '2020-02-10 19:05:34'),
(4, 4, 'mod@gmail.com', NULL, '$2y$10$XjMGgI7FZlkjv4y4hCCfa.OVvne6l0.Q6qAe/6zQKzRRQaOJcgIGS', '2020-01-01', NULL, 1, 2, NULL, '2020-02-10 20:16:30', '2020-02-10 20:16:30'),
(5, 5, 'admin@gmail.com', NULL, '$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q', '2020-01-01', NULL, 1, 3, NULL, '2020-02-10 20:16:53', '2020-02-10 20:16:53'),
(6, 6, 'Marcos@gmail.com', NULL, '$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q', '2020-01-01', NULL, 1, 3, NULL, '2020-02-10 20:16:53', '2020-02-10 20:16:53'),
(7, 7, 'Misael@gmail.com', NULL, '$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q', '2020-01-01', NULL, 1, 3, NULL, '2020-02-10 20:16:53', '2020-02-10 20:16:53'),
(8, 8, 'Andrea@gmail.com', NULL, '$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q', '2020-01-01', NULL, 1, 3, NULL, '2020-02-10 20:16:53', '2020-02-10 20:16:53'),
(9, 9, 'Edglis@gmail.com', NULL, '$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q', '2020-01-01', NULL, 1, 3, NULL, '2020-02-10 20:16:53', '2020-02-10 20:16:53'),
(10, 10, 'Estefani@gmail.com', NULL, '$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q', '2020-01-01', NULL, 1, 3, NULL, '2020-02-10 20:16:53', '2020-02-10 20:16:53'),
(11, 11, 'Zoralid@gmail.com', NULL, '$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q', '2020-01-01', NULL, 1, 3, NULL, '2020-02-10 20:16:53', '2020-02-10 20:16:53'),
(12, 12, 'Dioselid@gmail.com', NULL, '$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q', '2020-01-01', NULL, 1, 3, NULL, '2020-02-10 20:16:53', '2020-02-10 20:16:53'),
(13, 13, 'Margaret@gmail.com', NULL, '$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q', '2020-01-01', NULL, 1, 3, NULL, '2020-02-10 20:16:53', '2020-02-10 20:16:53'),
(14, 14, 'Juan@gmail.com', NULL, '$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q', '2020-01-01', NULL, 1, 3, NULL, '2020-02-10 20:16:53', '2020-02-10 20:16:53'),
(15, 15, 'Elianny@gmail.com', NULL, '$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q', '2020-01-01', NULL, 1, 3, NULL, '2020-02-10 20:16:53', '2020-02-10 20:16:53'),
(16, 16, 'Ricardo@gmail.com', NULL, '$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q', '2020-01-01', NULL, 1, 3, NULL, '2020-02-10 20:16:53', '2020-02-10 20:16:53'),
(17, 17, 'Emanuel@gmail.com', NULL, '$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q', '2020-01-01', NULL, 1, 3, NULL, '2020-02-10 20:16:53', '2020-02-10 20:16:53'),
(18, 18, 'Sabrina@gmail.com', NULL, '$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q', '2020-01-01', NULL, 1, 3, NULL, '2020-02-10 20:16:53', '2020-02-10 20:16:53'),
(19, 19, 'Mario@gmail.com', NULL, '$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q', '2020-01-01', NULL, 1, 3, NULL, '2020-02-10 20:16:53', '2020-02-10 20:16:53'),
(20, 20, 'Adriana@gmail.com', NULL, '$2y$10$jyctYinHsanIxT0PDHa4L.7GGNRbZLhDveBImQ0EUgqQK1tYOHV1q', '2020-01-01', NULL, 1, 3, NULL, '2020-02-10 20:16:53', '2020-02-10 20:16:53');

INSERT INTO `moderadores` (id_usuario, `created_at`, `updated_at`) VALUES
(4, '2020-02-10 20:16:53', '2020-02-10 20:16:53');


INSERT INTO `clientes` (id_usuario, estado, `created_at`, `updated_at`) VALUES
(2, 0, '2020-02-10 19:05:15', '2020-02-10 19:05:15'),
(3, 0, '2020-02-10 19:05:33', '2020-02-10 19:05:33'),
(6, 0, '2020-02-10 19:05:33', '2020-02-10 19:05:33'),
(7, 0, '2020-02-10 19:05:33', '2020-02-10 19:05:33'),
(8, 0, '2020-02-10 19:05:33', '2020-02-10 19:05:33'),
(9, 0, '2020-02-10 19:05:33', '2020-02-10 19:05:33'),
(10, 0, '2020-02-10 19:05:33', '2020-02-10 19:05:33'),
(11, 0, '2020-02-10 19:05:33', '2020-02-10 19:05:33'),
(12, 0, '2020-02-10 19:05:33', '2020-02-10 19:05:33'),
(13, 0, '2020-02-10 19:05:33', '2020-02-10 19:05:33'),
(14, 0, '2020-02-10 19:05:33', '2020-02-10 19:05:33'),
(15, 0, '2020-02-10 19:05:33', '2020-02-10 19:05:33'),
(16, 0, '2020-02-10 19:05:33', '2020-02-10 19:05:33'),
(17, 0, '2020-02-10 19:05:33', '2020-02-10 19:05:33'),
(18, 0, '2020-02-10 19:05:33', '2020-02-10 19:05:33'),
(19, 0, '2020-02-10 19:05:33', '2020-02-10 19:05:33'),
(20, 0, '2020-02-10 19:05:33', '2020-02-10 19:05:33');

INSERT INTO `tipos_transaccion` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Internal Remittance', NULL, NULL),
(2, 'External Remittance', NULL, NULL),
(3, 'Buy', NULL, NULL),
(4, 'Trade', NULL, NULL),
(5, 'Retirement', NULL, NULL);

INSERT INTO `metodos_pago` (`nombre`, `estado`, `created_at`, `updated_at`) VALUES
('Change (trading)', '1', NULL, NULL),
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
(6,'Dogecoin', 'DOGE', NULL, NULL),
(7,'Gourde', 'HTG', NULL, NULL);

INSERT INTO `hai_criptomonedas` (id_moneda) VALUES
(2),
(3),
(4),
(5),
(6);

INSERT INTO `prefijos_telefono` (pais,codigo) VALUES
('Afghanistan', '+93'),
('Albania', '+355'),
('Algeria', '+213'),
('American Samoa', '+1-684'),
('Andorra', '+376'),
('Angola', '+244'),
('Anguilla', '+1-264'),
('Antarctica', '+672'),
('Antigua and Barbuda', '+1-268'),
('Argentina', '+54'),
('Armenia', '+374'),
('Aruba', '+297'),
('Australia', '+61'),
('Austria', '+43'),
('Azerbaijan', '+994'),
('Bahamas', '+1-242'),
('Bahrain', '+973'),
('Bangladesh', '+880'),
('Barbados', '+1-246'),
('Belarus', '+375'),
('Belgium', '+32'),
('Belize', '+501'),
('Benin', '+229'),
('Bermuda', '+1-441'),
('Bhutan', '+975'),
('Bolivia', '+591'),
('Bosnia and Herzegovina', '+387'),
('Botswana', '+267'),
('Brazil', '+55'),
('British Indian Ocean Territory', '+246'),
('British Virgin Islands', '+1-284'),
('Brunei', '+673'),
('Bulgaria', '+359'),
('Burkina Faso', '+226'),
('Burundi', '+257'),
('Cambodia', '+855'),
('Cameroon', '+237'),
('Canada', '+1'),
('Cape Verde', '+238'),
('Cayman Islands', '+1-345'),
('Central African Republic', '+236'),
('Chad', '+235'),
('Chile', '+56'),
('China', '+86'),
('Christmas Island', '+61'),
('Cocos Islands', '+61'),
('Colombia', '+57'),
('Comoros', '+269'),
('Cook Islands', '+682'),
('Costa Rica', '+506'),
('Croatia', '+385'),
('Cuba', '+53'),
('Curacao', '+599'),
('Cyprus', '+357'),
('Czech Republic', '+420'),
('Democratic Republic of the Congo', '+243'),
('Denmark', '+45'),
('Djibouti', '+253'),
('Dominica', '+1-767'),
('Dominican Republic', '+1-809'),
('Dominican Republic', '+1-829'),
('Dominican Republic', '+1-849'),
('East Timor', '+670'),
('Ecuador', '+593'),
('Egypt', '+20'),
('El Salvador', '+503'),
('Equatorial Guinea', '+240'),
('Eritrea', '+291'),
('Estonia', '+372'),
('Ethiopia', '+251'),
('Falkland Islands', '+500'),
('Faroe Islands', '+298'),
('Fiji', '+679'),
('Finland', '+358'),
('France', '+33'),
('French Polynesia', '+689'),
('Gabon', '+241'),
('Gambia', '+220'),
('Georgia', '+995'),
('Germany', '+49'),
('Ghana', '+233'),
('Gibraltar', '+350'),
('Greece', '+30'),
('Greenland', '+299'),
('Grenada', '+1-473'),
('Guam', '+1-671'),
('Guatemala', '+502'),
('Guernsey', '+44-1481'),
('Guinea', '+224'),
('Guinea-Bissau', '+245'),
('Guyana', '+592'),
('Haiti', '+509'),
('Honduras', '+504'),
('Hong Kong', '+852'),
('Hungary', '+36'),
('Iceland', '+354'),
('India', '+91'),
('Indonesia', '+62'),
('Iran', '+98'),
('Iraq', '+964'),
('Ireland', '+353'),
('Isle of Man', '+44-1624'),
('Israel', '+972'),
('Italy', '+39'),
('Ivory Coast', '+225'),
('Jamaica', '+1-876'),
('Japan', '+81'),
('Jersey', '+44-1534'),
('Jordan', '+962'),
('Kazakhstan', '+7'),
('Kenya', '+254'),
('Kiribati', '+686'),
('Kosovo', '+383'),
('Kuwait', '+965'),
('Kyrgyzstan', '+996'),
('Laos', '+856'),
('Latvia', '+371'),
('Lebanon', '+961'),
('Lesotho', '+266'),
('Liberia', '+231'),
('Libya', '+218'),
('Liechtenstein', '+423'),
('Lithuania', '+370'),
('Luxembourg', '+352'),
('Macau', '+853'),
('Macedonia', '+389'),
('Madagascar', '+261'),
('Malawi', '+265'),
('Malaysia', '+60'),
('Maldives', '+960'),
('Mali', '+223'),
('Malta', '+356'),
('Marshall Islands', '+692'),
('Mauritania', '+222'),
('Mauritius', '+230'),
('Mayotte', '+262'),
('Mexico', '+52'),
('Micronesia', '+691'),
('Moldova', '+373'),
('Monaco', '+377'),
('Mongolia', '+976'),
('Montenegro', '+382'),
('Montserrat', '+1-664'),
('Morocco', '+212'),
('Mozambique', '+258'),
('Myanmar', '+95'),
('Namibia', '+264'),
('Nauru', '+674'),
('Nepal', '+977'),
('Netherlands', '+31'),
('Netherlands Antilles', '+599'),
('New Caledonia', '+687'),
('New Zealand', '+64'),
('Nicaragua', '+505'),
('Niger', '+227'),
('Nigeria', '+234'),
('Niue', '+683'),
('North Korea', '+850'),
('Northern Mariana Islands', '+1-670'),
('Norway', '+47'),
('Oman', '+968'),
('Pakistan', '+92'),
('Palau', '+680'),
('Palestine', '+970'),
('Panama', '+507'),
('Papua New Guinea', '+675'),
('Paraguay', '+595'),
('Peru', '+51'),
('Philippines', '+63'),
('Pitcairn', '+64'),
('Poland', '+48'),
('Portugal', '+351'),
('Puerto Rico', '+1-787'),
('Puerto Rico', '+1-939'),
('Qatar', '+974'),
('Republic of the Congo', '+242'),
('Reunion', '+262'),
('Romania', '+40'),
('Russia', '+7'),
('Rwanda', '+250'),
('Saint Barthelemy', '+590'),
('Saint Helena', '+290'),
('Saint Kitts and Nevis', '+1-869'),
('Saint Lucia', '+1-758'),
('Saint Martin', '+590'),
('Saint Pierre and Miquelon', '+508'),
('Saint Vincent and the Grenadines', '+1-784'),
('Samoa', '+685'),
('San Marino', '+378'),
('Sao Tome and Principe', '+239'),
('Saudi Arabia', '+966'),
('Senegal', '+221'),
('Serbia', '+381'),
('Seychelles', '+248'),
('Sierra Leone', '+232'),
('Singapore', '+65'),
('Sint Maarten', '+1-721'),
('Slovakia', '+421'),
('Slovenia', '+386'),
('Solomon Islands', '+677'),
('Somalia', '+252'),
('South Africa', '+27'),
('South Korea', '+82'),
('South Sudan', '+211'),
('Spain', '+34'),
('Sri Lanka', '+94'),
('Sudan', '+249'),
('Suriname', '+597'),
('Svalbard and Jan Mayen', '+47'),
('Swaziland', '+268'),
('Sweden', '+46'),
('Switzerland', '+41'),
('Syria', '+963'),
('Taiwan', '+886'),
('Tajikistan', '+992'),
('Tanzania', '+255'),
('Thailand', '+66'),
('Togo', '+228'),
('Tokelau', '+690'),
('Tonga', '+676'),
('Trinidad and Tobago', '+1-868'),
('Tunisia', '+216'),
('Turkey', '+90'),
('Turkmenistan', '+993'),
('Turks and Caicos Islands', '+1-649'),
('Tuvalu', '+688'),
('U.S. Virgin Islands', '+1-340'),
('Uganda', '+256'),
('Ukraine', '+380'),
('United Arab Emirates', '+971'),
('United Kingdom', '+44'),
('United States', '+1'),
('Uruguay', '+598'),
('Uzbekistan', '+998'),
('Vanuatu', '+678'),
('Vatican', '+379'),
('Venezuela', '+58'),
('Vietnam', '+84'),
('Wallis and Futuna', '+681'),
('Western Sahara', '+212'),
('Yemen', '+967'),
('Zambia', '+260'),
('Zimbabwe', '+263');
insert into comisiones (general,compra,remesa,cambio,retiro,deposito,created_at,updated_at) VALUES
(2,5,10,20,50,100,'2020-03-01','2020-03-01');
insert into tipos_remesa (nombre) VALUES
('Internal'),
('External');