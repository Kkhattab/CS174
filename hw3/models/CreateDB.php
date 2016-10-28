<?php
namespace kareemkevin\hw3\Models;

class CreateDB extends Base {

	public function tablesExist(){

		$this->db_connect();

		$sql = "SHOW TABLES";

		$result = mysql_query( $sql );

		$exists = mysql_num_rows( $result ) > 0;

		$this->db_disconnect();

		return $exists;

	}

	public function createTables(){
		$this->db_connect();
		$sql = "CREATE TABLE `entries` (
		  `entry_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `entry_title` varchar(255) NOT NULL,
		  `entry_author` varchar(255) NOT NULL,
		  `entry_identifier` varchar(255) NOT NULL,
		  `entry_text` text NOT NULL,
		  `entry_rating_sum` int(11) NOT NULL DEFAULT '0',
		  `entry_rating_num` int(11) NOT NULL DEFAULT '0',
		  `entry_views` int(11) NOT NULL DEFAULT '0',
		  `entry_created` datetime NOT NULL,
		  `entry_modified` datetime NOT NULL
		)  ENGINE=InnoDB DEFAULT CHARSET=latin1;";
		mysql_query( $sql ) or die( mysql_error() );
		$sql = "CREATE TABLE `entry_genres` (
			  `genre_id` int(11) NOT NULL,
			  `entry_id` int(11) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
		mysql_query( $sql ) or die( mysql_error() );
		$sql = "CREATE TABLE `genres` (
		  `genre_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `genre_title` varchar(255) NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
		mysql_query( $sql ) or die( mysql_error() );
		$this->db_disconnect();
	}

	public function insertDummyData(){


		$this->db_connect();

		$sql ="INSERT INTO `entries` (`entry_id`, `entry_title`, `entry_author`, `entry_identifier`, `entry_text`, `entry_rating_sum`, `entry_rating_num`, `entry_views`, `entry_created`, `entry_modified`) VALUES
		(2, 'Malcolm X', 'Kareem Khattab', 'post_1', 'Malcolm X (/ˈmælkəm ˈɛks/; May 19, 1925 – February 21, 1965), born Malcolm Little and later also known as el-Hajj Malik el-Shabazz[A][pronunciation?] (Arabic: الحاجّ مالك الشباز‎‎), was an African-American Muslim minister and human rights activist. To his admirers he was a courageous advocate for the rights of blacks, a man who indicted white America in the harshest terms for its crimes against black Americans; detractors accused him of preaching racism and violence. He has been called one of the greatest and most influential African Americans in history.\r\n\r\n By March 1964, Malcolm X had grown disillusioned with the Nation of Islam and its leader Elijah Muhammad. Expressing many regrets about his time with them, which he had come to regard as largely wasted, he embraced Sunni Islam. After a period of travel in Africa and the Middle East, which included completing the Hajj, he repudiated the Nation of Islam, disavowed racism and founded Muslim Mosque, Inc. and the Organization of Afro-American Unity. He continued to emphasize Pan-Africanism, black self-determination, and black self-defense.', 11, 3, 23, '2016-10-26 16:31:51', '2016-10-27 21:20:02'),
		(3, 'Kareem Abdul-Jabbar', 'Kevin Hou', 'post_2', 'Kareem Abdul-Jabbar (born Ferdinand Lewis Alcindor, Jr.; April 16, 1947) is an American retired professional basketball player who played 20 seasons in the National Basketball Association (NBA) for the Milwaukee Bucks and Los Angeles Lakers. During his career as a center, Abdul-Jabbar was a record six-time NBA Most Valuable Player (MVP), a record 19-time NBA All-Star, a 15-time All-NBA selection, and an 11-time NBA All-Defensive Team member. A member of six NBA championship teams as a player and two as an assistant coach, Abdul-Jabbar twice was voted NBA Finals MVP. In 1996, he was honored as one of the 50 Greatest Players in NBA History. NBA coach Pat Riley and players Isiah Thomas and Julius Erving have called him the greatest basketball player of all time.[1][2][3][4][5]\r\n\r\nAfter winning 71 consecutive basketball games on his high school team in New York City, Lew Alcindor attended college at UCLA, where he played on three consecutive national championship basketball teams and was a record three-time MVP of the NCAA Tournament.[6] Drafted by the one-season-old Bucks franchise in the 1969 NBA draft with the first overall pick, Alcindor spent six seasons in Milwaukee. After winning his first NBA championship in 1971, he adopted the Muslim name Kareem Abdul-Jabbar at age 24. Using his trademark \"skyhook\" shot, he established himself as one of the league''s top scorers. In 1975, he was traded to the Lakers, with whom he played the last 14 seasons of his career and won five additional NBA championships. Abdul-Jabbar''s contributions were a key component in the \"Showtime\" era of Lakers basketball. Over his 20-year NBA career his team succeeded in making the playoffs 18 times and past the 1st round in 14 of them; his team reached the NBA Finals 10 times.\r\n\r\nAt the time of his retirement in 1989, Abdul-Jabbar was the NBA''s all-time leader in points scored (38,387), games played (1,560), minutes played (57,446), field goals made (15,837), field goal attempts (28,307), blocked shots (3,189), defensive rebounds (9,394), and personal fouls (4,657). He remains the all-time leading scorer in the NBA, and is ranked 3rd all-time in both rebounds and blocks. In 2007, ESPN voted him the greatest center of all time,[7] in 2008, they named him the \"greatest player in college basketball history\",[8] and in 2016, they named him the second best player in NBA history.[9] Abdul-Jabbar has also been an actor, a basketball coach, and a best-selling author.[10][11] In 2012, he was selected by Secretary of State Hillary Clinton to be a U.S. global cultural ambassador.', 5, 1, 8, '2016-10-26 17:35:15', '2016-10-26 17:35:15');";

		mysql_query( $sql );

		$sql = "INSERT INTO `entry_genres` (`genre_id`, `entry_id`) VALUES
				(1, 4),
				(1, 2),
				(4, 2),
				(2, 0),
				(3, 3),
				(4, 5),
				(5, 5),
				(2, 5);";

		mysql_query( $sql );

		$sql = "INSERT INTO `genres` (`genre_id`, `genre_title`) VALUES
				(1, 'epic'),
				(2, 'tragedy'),
				(3, 'comedy'),
				(4, 'novel'),
				(5, 'short story');";

		mysql_query( $sql );

		$this->db_disconnect();
	}
}