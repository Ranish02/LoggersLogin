
DROP TABLE user;


CREATE TABLE `user` (
  `userid` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `acc_create_date` date NOT NULL,
  `verify` int(1) NOT NULL,
  `code` varchar(20) NOT NULL,
  `failedloginAttempts` int(1) NOT NULL,
  `passwordchangedate` date NOT NULL
)

--
-- Dumping data for table `user`
--

INSERT INTO `user`(`fullname`,`username`, `email`, `password`,`acc_create_date`,`verify`,`code`,`failedloginAttempts`,`passwordchangedate`)VALUES
('Ram Prasad','rammy069', 'killyr204@gmail.com', 'ZfWWm04xKsm+vZs=','2022-05-22',1, 'yFMpbY',0,'2022-05-22'),
('Jamma Khadka','JamKhadka','killyr202@gmail.com','a/2JjjxldYk=','2022-06-25',1,'FzZn9jXHcv5I',0,'2022-06-25')


--ZfWWm04xKsm+vZs= = Easy2forme.
(Hari Karki
Harry1223
killyr204@gmail.com
a/2Jjjxmd4g=
2022-06-25
1
pO8SYXktwrq1
0
2022-06-25)
(9
killyr204@gmail.com
YNqAkh07dIng
1
yFMpbY
5)
(1
killyr202@gmail.com
YNqAkh07dIng
1
qVCcyNxAfWzj
0)
