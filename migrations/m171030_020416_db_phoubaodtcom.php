<?php
use yii\db\Migration;
class m171030_020416_db_phoubaodtcom extends Migration {
	public function safeUp() {
		$sql = file_get_contents ( dirname ( __FILE__ ) . '/moha_phoubao.sql' );
		$this->execute ( $sql );
	}
	public function safeDown() {
		$connection = Yii::$app->db;
		$hostName = $this->getDsnAttribute ( 'mysql:host', $connection->dsn );
		$dbName = $this->getDsnAttribute ( 'dbname', $connection->dsn );
		$userName = $connection->username;
		$password = $connection->password;
		$sql = " SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA= DATABASE()  AND TABLE_NAME<>'migration'; ";
		$mysqli = new mysqli ( $hostName, $userName, $password, $dbName );
		$mysqli->query ( 'SET foreign_key_checks = 0' );
		if ($result = $mysqli->query ( $sql )) {
			while ( $row = $result->fetch_array ( MYSQLI_NUM ) ) {
				$mysqli->query ( 'DROP TABLE IF EXISTS ' . $row [0] );
			}
		}
		
		$mysqli->query ( 'SET foreign_key_checks = 1' );
		$mysqli->close ();
	
	/**
	 * We can use below code too
	 */
		
		// $connection = Yii::$app->db;
		// $sql = "show tables where Tables_in_moha != 'migration' ";
		// $command = $connection->createCommand ( $sql );
		
		// $results = $command->queryAll ();
		// $connection->createCommand ( "SET foreign_key_checks = 0" )->query ();
		// foreach ( $results as $row ) {
		// $sql_drop = " DROP TABLE IF EXISTS " . $row ["Tables_in_moha"];
		// $connection->createCommand ( $sql_drop )->query ();
		// }
		// $connection->createCommand ( "SET foreign_key_checks = 1" )->query ();
	}
	private function getDsnAttribute($name, $dsn) {
		if (preg_match ( '/' . $name . '=([^;]*)/', $dsn, $match )) {
			return $match [1];
		} else {
			return null;
		}
	}
}
