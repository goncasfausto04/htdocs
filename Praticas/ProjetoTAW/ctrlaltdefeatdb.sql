-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Jun-2024 às 21:33
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ctrlaltdefeatdb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `password`, `name`, `role`) VALUES
(13, 'teste@gmail.com', '$2y$10$SiBtpxG1HngX99SEowSa0.ZOp3OQ96POuYCtcIuUCIirpXfh2ED9q', '', ''),
(14, 'admin@gmail.com', '$2y$10$Kr0Xkk1roXySa9OcOpKPku2PTq0.V6T7gGRnEWXO7LlnFF7Dv.JoC', 'Admin test Acc', 'admin'),
(15, 'trackadmin@gmail.com', '$2y$10$AfMK/zJiXZmfIgabYgkMCu18RcWloCKARZxcjZPaea8NNS.6dl2xG', '', 'trackadmin'),
(16, 'usertest@gmail.com', '$2y$10$rOjSIZEJD0cqBhTuSGA21.zv14wxolWHVII6fsKAvXvGH4g/P3P0e', 'user_test', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer`) VALUES
(6, 10, 'José Miguel da Rocha Fonte, conhecido como José Fonte ou “Centralão”, é um futebolista português atua como defesa central.'),
(8, 12, 'Jane is a PHD and masters in Healthcare, and works in Hospital da Luz'),
(9, 13, 'around 45 minutes'),
(10, 14, 'Yes there will!'),
(11, 15, 'Yes he is the best!'),
(12, 16, 'We chose José Neves as he is the CEO of one of the biggest Portuguese Companies (Farfetch).'),
(13, 17, 'Yes there will be free snacks, such as Pasteis de Nata, Rissóis, etc and free cocktails, as well as non-alcoholic drinks.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `questions`
--

INSERT INTO `questions` (`id`, `article_id`, `question`) VALUES
(10, 3, 'Who is José?'),
(12, 2, 'Who is Jane?'),
(13, 1, 'How long will it last?'),
(14, 1, 'Will there be a Q&A?'),
(15, 1, 'Is this Professor good?'),
(16, 6, 'Why did you choose this speaker?'),
(17, 9, 'Will there be free food and drinks?');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `session` varchar(200) NOT NULL,
  `date` datetime NOT NULL,
  `room` varchar(50) NOT NULL,
  `speaker` varchar(200) NOT NULL,
  `article` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `sessions`
--

INSERT INTO `sessions` (`id`, `session`, `date`, `room`, `speaker`, `article`) VALUES
(1, 'The Etics of AI', '2024-05-31 10:00:00', 'Auditorium A14', 'Professor Américo Rio', 'Artificial Intelligence (AI) is rapidly transforming various sectors, including healthcare, finance, and transportation. However, this technological advancement also raises critical ethical questions. In this session, Professor Americo Rio will explore the ethical implications of AI development and deployment. Topics will include issues of bias in AI systems, privacy concerns, the impact of AI on employment, and the moral responsibilities of AI creators. Attendees will gain insights into the challenges and considerations necessary to ensure AI is developed and used in ways that are fair, transparent, and beneficial to society.\r\n\r\n'),
(2, 'AI in Healthcare', '2024-05-31 10:00:00', 'Auditorium A13', 'Dr. Jane Smith', 'Artificial Intelligence is revolutionizing the healthcare industry by enhancing diagnostic accuracy, personalizing treatment plans, and streamlining administrative processes. Dr. Jane Smith will delve into the current applications of AI in healthcare, discuss successful case studies, and explore future prospects. Attendees will learn about the latest AI technologies being used in medical research and patient care, as well as the ethical considerations and challenges involved in their implementation.'),
(3, 'Innovate or Stagnate', '2024-05-31 12:00:00', 'INE Auditorium', 'José Fonte', 'Dive into the latest advancements in AI, machine learning, and quantum computing. Discover how these technologies are reshaping industries and what it means for the future of work.'),
(4, 'Cybersecurity in the Emotional Era', '2024-05-31 14:00:00', 'Auditorium A20', 'Professor Pedro Malta', 'Learn about the emotional impact of cyber threats and the importance of empathy in crafting security measures that protect not just data, but people.'),
(5, 'The Emotional Intelligence of Bots', '2024-05-31 16:00:00', 'Auditorium A20', 'Professor Manuela Aparicio', 'Explore the fascinating world of emotionally aware bots and how they’re transforming customer service, mental health, and personal assistance'),
(6, 'The Burnout Code', '2024-07-01 10:00:00', 'A14', 'José Neves', 'Address the silent epidemic of tech burnout. Engage in open discussions about work-life balance, mental health, and strategies to thrive in high-pressure environments.'),
(7, 'Empathy in the Age of AI', '2024-06-01 12:30:00', 'INE Auditorium', 'Professor Américo Rio', ' Delve into the ethical implications of AI and machine learning. Discuss how to design technology that respects human rights, diversity, and emotional well-being.'),
(8, ' Humanizing Tech', '2024-06-01 14:00:00', 'Auditorium A14', 'Mark Bourke', 'Explore the intersection of technology and humanity. Reflect on the emotional impact of innovation, and how to create tech that enhances, rather than diminishes, the human experience.'),
(9, 'Farewell CTRALTDEFEAT', '2024-06-01 17:00:00', 'Nova IMS Patio', 'rofessor Doutor Miguel de Castro Neto', 'Conference Farewell with the Dean of Nova IMS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sessionstable`
--

CREATE TABLE `sessionstable` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `speaker` text NOT NULL,
  `description` text NOT NULL,
  `room` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_presence`
--

CREATE TABLE `user_presence` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `arrival_time` datetime DEFAULT NULL,
  `attend` enum('Every day','1 day') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `user_presence`
--

INSERT INTO `user_presence` (`id`, `name`, `company`, `email`, `contact`, `arrival_time`, `attend`) VALUES
(8, 'Joao Tomás', 'SEA.AI', 'joaoseaai@gmail.com', '923456789', '2024-06-19 15:04:00', 'Every day'),
(9, 'José Almeida', 'Microsoft', 'josealmeidajanelas@outlook.com', '923456789', '2024-06-04 16:00:00', 'Every day'),
(10, 'Ana Silva', 'Google', 'anasilva@google.com', '923456781', '2024-06-01 10:30:00', '1 day'),
(11, 'Sofia Martins', 'IBM', 'sofiamartins@ibm.pt', '923456783', '2024-05-31 10:00:00', 'Every day'),
(12, 'Luis Ferreira', 'Oracle', 'luisferreira@oracle.com', '926304486', '2024-05-31 09:00:00', '1 day');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Índices para tabela `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`);

--
-- Índices para tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sessionstable`
--
ALTER TABLE `sessionstable`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user_presence`
--
ALTER TABLE `user_presence`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `sessionstable`
--
ALTER TABLE `sessionstable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `user_presence`
--
ALTER TABLE `user_presence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Limitadores para a tabela `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `sessions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
