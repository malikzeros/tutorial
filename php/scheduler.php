<?php
//*************************************************************************************
//connector mysql
//*************************************************************************************
//$host = '192.168.240.107';
//$db   = 'db_etechpub';
//$user = 'jos';
//$pass = 'p@ssw0rd';
//Local server
$host = 'localhost';
$db   = 'db_etechpub';
$user = 'root';
$pass = '';

$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $pdo_mysql = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
     throw new PDOException($e->getMessage(), (int)$e->getCode());
}
//*************************************************************************************
//connector ms sql server
//*************************************************************************************
$host = '192.168.240.100';
$db   = 'db_dboard';
$user = 'usr_dboard';
$pass = 'p@ssw0rd';
$charset = 'utf8mb4';

$dsn = "sqlsrv:Server=$host;Database=$db";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $pdo_sqlserver = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
     throw new PDOException($e->getMessage(), (int)$e->getCode());
}
//*************************************************************************************
//scheduler
//*************************************************************************************
$stmt_sql_server_acreg = $pdo_sqlserver->query('SELECT * FROM tbl_master_acreg');
$stmt_sql_server_actype = $pdo_sqlserver->query('SELECT * FROM tbl_master_actype');
$stmt_mysql_acreg = $pdo_mysql->query('SELECT * FROM acreg');
$stmt_mysql_aircraft = $pdo_mysql->query('SELECT * FROM aircraft');

//*************************************************************************************
//checking tbl_master_acreg data and acreg data
//*************************************************************************************
echo "tbl_master_acreg -> acreg\n";
while ($row = $stmt_mysql_acreg->fetch())
{
	$acreg[]=$row['acreg'];
}
while ($rows = $stmt_sql_server_acreg->fetch())
{
	if(in_array($rows['COL_AC_REG'], $acreg, TRUE))
	{
		echo $rows['COL_AC_REG']." ada\n";
	}
	else{
		echo $rows['COL_AC_REG']." tidak ada\n";
		echo $rows['COL_AC_TYPE']." insert into table\n";
		$sql = "insert into acreg (aircraft_idaircraft,acreg)
		values(1,?)";
		$pdo_mysql->prepare($sql)->execute([$rows['COL_AC_REG']]);
		$acreg[]=$rows['COL_AC_REG'];
	}
}
//*************************************************************************************
//checking tbl_master_acreg data and acreg data
//********************************************************
echo "tbl_master_actype -> aircraft\n";
while ($row = $stmt_mysql_aircraft->fetch())
{
	$actype[]=$row['aircraft_name'];
}
while ($rows = $stmt_sql_server_actype->fetch())
{
	if(in_array($rows['COL_AC_TYPE'], $actype, TRUE))
	{
		echo $rows['COL_AC_TYPE']." ada\n";
	}
	else{
		echo $rows['COL_AC_TYPE']." tidak ada\n";
		if($rows['COL_AC_TYPE']=='B737-800 MAX' || $rows['COL_AC_TYPE']=='B737-8MAX'){
			echo $rows['COL_AC_TYPE']." abaikan\n";
		}
		else
		{
			echo $rows['COL_AC_TYPE']." insert into table\n";
			$sql = "insert into aircraft (aircraft_name)
		values(?)";
		$pdo_mysql->prepare($sql)->execute([$rows['COL_AC_TYPE']]);
		$actype[]=$rows['COL_AC_TYPE'];
		}
	}
}
?>