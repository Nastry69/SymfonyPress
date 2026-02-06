--
-- Base de données : `symfonypress`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--
INSERT INTO `category` (`id`, `name`, `slug`) VALUES
(1, 'Symfony', 'symfony'),
(2, 'PHP', 'php'),
(3, 'DevOps', 'devops'),
(4, 'Frontend', 'frontend'),
(5, 'Architecture', 'architecture');

-- --------------------------------------------------------
INSERT INTO `user` (`id`, `email`, `roles`, `password`, `name`) VALUES
(1, 'admin@exemple.fr', '[]', '$2y$13$VI25uaQD30MeN4FRLqRPQOYI4yVoXEn7iG4LSlYVEs77nhM4w93L2', 'Admin'),
(2, 'user@gmail.com', '[]', '$2y$13$jhKQCAZEKKyRvoFp.0jnoOyHEp.yJgjHFdtZWa6FVobkKeD8Qq7m6', 'User1'),
(3, 'user2@exemple.com', '[]', '$2y$13$.bfSfi0bBgL9DN/l4b/XiOsJfZSQQmPb4Vi8UWfRboRggYVmDMn22', 'User2');

-- --------------------------------------------------------

INSERT INTO `article` (`id`, `title`, `content`, `slug`, `category_id`, `created_at`, `image`, `user_id`, `is_published`) VALUES
(1, 'Découvrir Symfony 8', 'Symfony 8 apporte de nombreuses améliorations en performance et en DX. Le nouveau composant AssetMapper simplifie la gestion des assets frontend sans build step. Les attributs PHP 8 permettent une configuration plus claire et concise.', 'decouvrir-symfony-8', 1, '2026-02-05 16:32:11', NULL, 1, 1),
(2, 'Twig pour les débutants', 'Twig est le moteur de template par défaut de Symfony. Sa syntaxe claire et sécurisée permet de créer des vues maintenables. Les filtres, fonctions et extensions offrent une grande flexibilité pour manipuler les données côté template.', 'twig-pour-les-debutants', 1, '2026-02-05 16:32:11', NULL, 1, 1),
(3, 'Les bases solides de PHP moderne', 'PHP 8 apporte le typage strict, les attributes, les enums et les propriétés promues. Ces fonctionnalités permettent un code plus robuste et expressif. L\'écosystème PHP moderne inclut Composer, PHPStan et des outils de qualité professionnels.', 'php-moderne', 2, '2026-02-05 16:32:11', NULL, 1, 1),
(4, 'Doctrine et les relations', 'Les jointures sont au cœur de toute application métier. Doctrine ORM permet de mapper les relations de base de données en objets PHP. ManyToOne, OneToMany, ManyToMany : chaque type de relation a ses spécificités et ses bonnes pratiques.', 'doctrine-relations', 5, '2026-02-05 16:32:11', NULL, 2, 1),
(5, 'Organiser un projet Symfony', 'Une bonne architecture permet un projet maintenable sur le long terme. Symfony impose une structure MVC claire : contrôleurs, entités, repositories, services. Les bundles permettent de modulariser les fonctionnalités.', 'architecture-symfony', 5, '2026-02-05 16:32:11', NULL, 2, 1),
(6, 'Symfony vs Laravel', 'Comparaison entre deux frameworks majeurs de l\'écosystème PHP. Symfony privilégie la robustesse et la flexibilité, Laravel met l\'accent sur la rapidité de développement. Les deux approches ont leurs avantages selon le contexte projet.', 'symfony-vs-laravel', 1, '2026-02-05 16:32:11', NULL, 1, 1),
(7, 'Bases du frontend moderne', 'HTML, CSS et JS sont les fondations du web. Les standards modernes incluent les Web Components, CSS Grid, et l\'API Fetch. Stimulus et Turbo permettent d\'ajouter de l\'interactivité sans framework lourd.', 'frontend-moderne', 4, '2026-02-05 16:32:11', NULL, 2, 1),
(8, 'Déployer une app Symfony', 'Docker, Nginx et CI/CD sont les piliers du déploiement moderne. Symfony s\'adapte à tous les environnements : serveur dédié, VPS, cloud, PaaS. Les bonnes pratiques incluent les variables d\'environnement et la gestion des secrets.', 'deployer-symfony', 3, '2026-02-05 16:32:11', NULL, 1, 1);

