<?php

// Данный код создан и распространяется по лицензии GPL v3
// Разработчики:
//   Грибов Павел,
//   Сергей Солодягин (solodyagin@gmail.com)
//   (добавляйте себя если что-то делали)
// http://грибовы.рф

defined('WUO_ROOT') or die('Доступ запрещён'); // Запрещаем прямой вызов скрипта.

$page = _GET('page');
$limit = _GET('rows');
$sidx = (isset($_GET['sidx'])) ? $_GET['sidx'] : '1';
$sord = _GET('sord');
$oper = _POST('oper');
$curuserid = _GET('curuserid');
$id = _POST('id');

if ($oper == '') {
	$result = $sqlcn->ExecuteSQL("SELECT COUNT(*) AS count, name as grname, res2.* FROM group_nome
		INNER JOIN (SELECT places.name as plname, res.* FROM places INNER JOIN(
		SELECT name AS namenome, nome.groupid as grpid, eq.*  FROM nome INNER JOIN (
		SELECT equipment.id AS eqid, equipment.placesid AS plid, equipment.nomeid AS nid, equipment.buhname AS bn, equipment.cost AS cs, equipment.currentcost AS curc, equipment.invnum, equipment.sernum, equipment.shtrihkod, equipment.mode, equipment.os FROM equipment INNER JOIN (
		SELECT placesid FROM places_users WHERE userid='$curuserid') AS pl ON pl.placesid=equipment.placesid
		WHERE equipment.active=1)
		AS eq ON nome.id=eq.nid)
		AS res ON places.id=res.plid) AS res2 ON group_nome.id=res2.grpid");
	$row = mysqli_fetch_array($result);
	$count = $row['count'];

	$total_pages = ($count > 0) ? ceil($count / $limit) : 0;

	if ($page > $total_pages)
		$page = $total_pages;

	$start = $limit * $page - $limit;
	$SQL = "SELECT name as grname,res2.* FROM group_nome
		INNER JOIN (SELECT places.name as plname, res.* FROM places INNER JOIN (
		SELECT name AS namenome, nome.groupid as grpid, eq.*  FROM nome INNER JOIN (
		SELECT equipment.id AS eqid, equipment.placesid AS plid, equipment.nomeid AS nid, equipment.buhname AS bn, equipment.cost AS cs, equipment.currentcost AS curc, equipment.invnum, equipment.sernum, equipment.shtrihkod, equipment.mode, equipment.os FROM equipment INNER JOIN (
		SELECT placesid FROM places_users WHERE userid='$curuserid') AS pl ON pl.placesid=equipment.placesid
		WHERE equipment.active=1)
		AS eq ON nome.id=eq.nid)
		AS res ON places.id=res.plid ORDER BY $sidx $sord LIMIT $start , $limit)  AS res2 ON group_nome.id=res2.grpid";
	//echo "!$SQL!";            
	$result = $sqlcn->ExecuteSQL($SQL) or
			die("Не могу выбрать сформировать список по оргтехнике/помещениям/пользователю!".mysqli_error($sqlcn->idsqlconnection));
	$responce = new stdClass();
	$responce->page = $page;
	$responce->total = $total_pages;
	$responce->records = $count;
	$i = 0;
	while ($row = mysqli_fetch_array($result)) {
		$responce->rows[$i]['id'] = $row['eqid'];
		$responce->rows[$i]['cell'] = array($row['eqid'], $row['plname'], $row['namenome'], $row['grname'], $row['invnum'], $row['sernum'], $row['shtrihkod'], $row['mode']);
		$i++;
	}
	echo json_encode($responce);
}
?>