-- Active: 1725728941897@@127.0.0.1@3306@sistema_shop
CREATE DATABASE sistema_shop;

USE sistema_shop;

-- Tabela usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    nivel_acesso VARCHAR(255) NOT NULL
);

-- Tabela produtos
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL,
    quantidade INT NOT NULL,
    imagem VARCHAR(255) NOT NULL
);

-- Usuários cadastrados
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `nivel_acesso`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$YGOXlHquwj7Bqilz.gzpLOvKOXmpreyDRdkAW4x6j/Rck3..FQHCK', 'ADMINISTRADOR'),
(2, 'forsen', 'forsen@forsen.com', '$2y$10$7RvYRfSrTVJE.boxsSM5OOC2xgALgZOMbtwYq9/PW486jMawKG/PO', 'COMUM'),
(3, 'Zé das Coves', 'zedascoves@gmail.com', '$2y$10$Y29PskUyYcqfdjHrphf/d.ToYbAg20JSkI.euGNaNwRytdQ2BOdD6', 'COMUM'),
(4, 'Reginaldo Cândido', 'reginaldo@fatec.com', '$2y$10$.uMRxpBbzHb9gZJwndn3cOnjcWnq/idee/hpuIAFLs54MYx/w8v7.', 'COMUM'),
(5, 'test', 'test@test.com', '$2y$10$nlg5pxBqam3CwaaJSdEGc.qatbe.kHNCpEJwGpKnIZjspiAP4rWPa', 'COMUM'),
(6, 'José', 'jose@outlook.com', '$2y$10$nFooVTVuzOfM26Pm4g7rBeaZ3LCpQHHWQP85FO2fzhfNaRiAp/n/G', 'COMUM'),
(7, 'Lucas', 'lucas@gmail.com', '$2y$10$O14ZNrXlnB9KOVRMNARrfOEhStoWsxifcGpfl9DcRnLvg58NDRuSC', 'COMUM');

-- Produtos cadastrados
INSERT INTO `produtos` (`id`, `nome`, `descricao`, `preco`, `quantidade`, `imagem`) VALUES
(1, 'Dragon Ball Z, Vol. 1', 'After years of training and adventure, young Son Goku has become Earth\'s strongest martial artist, but the stakes are increasing from the threat of the deadliest villains of all time and space!', 325.00, 20, '67228beb373d0-DragonBallZVol1.jpg'),
(2, 'Lucky Star, Vol. 1', 'Follows the lives of four high school girls--Konata, Miyuki, Kagami, and Tsukasa--as they juggle schoolwork, extracurricular activities, and other interests.', 300.00, 10, '67228ef064833-LuckyStarVol1.jpg'),
(3, 'Bakemonogatari, Vol. 1', 'The story revolves around Koyomi Araragi, a third-year high school student, now a quasi-vampire after surviving a vampire attack, with the help of Meme Oshino, a specialist in the supernatural. Despite having some superhuman abilities, such as regeneration, Koyomi tries his best to live life as a normal student, but keeps encountering girls with supernatural problems.', 50.00, 30, '67239649e3151-BakemonogatariVol1.jpg'),
(4, 'RE: Zero -Starting Life in Another World, Vol. 1', 'Subaru Natsuki was just trying to get to the convenience store but wound up summoned to another world. He encounters the usual things--life-threatening situations, silver haired beauties, cat fairies--you know, normal stuff. All that would be bad enough, but he\'s also gained the most inconvenient magical ability of all--time travel, but he\'s got to die to use it. How do you repay someone who saved your life when all you can do is die?', 100.00, 25, '6723cb4281ee5-REZeroVol1.jpg'),
(5, 'Death Note, Vol. 1', 'Light Yagami is an ace student with great prospects--and he\'s bored out of his mind. But all that changes when he finds the Death Note, a notebook dropped by a rogue Shinigami death god. Any human whose name is written in the notebook dies, and now Light has vowed to use the power of the Death Note to rid the world of evil. But when criminals begin dropping dead, the authorities send the legendary detective L to track down the killer. With L hot on his heels, will Light lose sight of his noble goal...or his life?', 150.00, 35, '6723cbe80ac08-DeathNoteVol1.jpg'),
(6, 'Neon Genesis Evangelion, Vol. 1', 'Once Shinji didn’t care about anything; then he found people to fight for—only to learn that he couldn’t protect them or keep those he let into his heart from going away. As mankind tilts on the brink of the apocalyptic Third Impact, human feelings are fault lines leading to destruction and just maybe, redemption and rebirth. ', 60.00, 40, '6723e288af757-NeonGenesisEvangelionVol1.jpg'),
(7, 'No Matter How I Look at It, It\'s You Guys\' Fault I\'m Not Popular, Vol. 1', 'Tomoko Kuroki is not cool. She is unattractive, socially awkward, and spends most of her evenings playing video games. Even so, no one wants popularity as desperately as she does. With one ingenious idea after another, Tomoko comes ever closer to achieving her goal—or so she thinks. Utilizing such innovative methods as imitating popular anime personas and buying expensive panties, she claws her way toward attaining the social status of her dreams.', 70.00, 50, '6723e39689955-WatamoteVol1.jpg'),
(8, 'Bocchi the Rock, Vol. 1', 'High school student Hitori \"Bocchi\" Gotou has no social life or any friends—unless you count her guitar. She dreams of creating a school band in the hopes that using her instrument will elevate her social standing. However, despite spending the last two years diligently practicing guitar, she is no closer to her goal.', 80.00, 70, '6723e4e672b4c-BocchiTheRockVol1.jpg');

SELECT * FROM usuarios;

SELECT * FROM produtos;
