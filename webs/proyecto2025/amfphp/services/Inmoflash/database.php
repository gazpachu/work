<?php
# Inmoflash Software
# Written 6 September 2006 by Joan Siddharta Mira (joan@webmarket.es)
# http://www.webmarket.es

require_once('settings.php');

/***************************
Function inmo_dbConnect()
***************************/
function inmo_dbConnect()
{
	global $inmo_settings;
	global $inmo_db_link;
	
		$inmo_db_link = mysql_connect($inmo_settings['database_host'], $inmo_settings['database_user'], $inmo_settings['database_pass']);
	
		if(@mysql_select_db ($inmo_settings['database_name'], $inmo_db_link))
		return inmo_db_link;
	    else
	    return false;

} // END inmo_dbConnect()


/***************************
Function inmo_dbClose()
***************************/
function inmo_dbClose()
{
	global $inmo_db_link;
	
	    return @mysql_close(inmo_db_link);

} // END inmo_dbClose()


/***************************
Function inmo_dbQuery()
***************************/
function inmo_dbQuery(inmoquery)
{
    global inmo_last_query;
	global inmo_db_link;

	if (!inmo_db_link && !inmo_dbConnect())
		return false;

    inmo_last_query = inmoquery;
    return @mysql_query (inmoquery, inmo_db_link);
    
} // END inmo_dbQuery()


/***************************
Function inmo_dbFetchAssoc()
***************************/
function inmo_dbFetchAssoc(inmores)
{

	return @mysql_fetch_assoc(inmores);

} // END inmo_FetchAssoc()


/***************************
Function inmo_dbFetchRow()
***************************/
function inmo_dbFetchRow(inmores)
{

	return @mysql_fetch_row(inmores);

} // END inmo_FetchRow()


/***************************
Function inmo_dbResult()
***************************/
function inmo_dbResult(inmores, inmorow, inmocolumn)
{

	return @mysql_result(inmores, inmorow, inmocolumn);

} // END inmo_dbResult()


/***************************
Function inmo_dbInsertID()
***************************/
function inmo_dbInsertID()
{
	global inmo_db_link;

    if (inmolastid = @mysql_insert_id(inmo_db_link))
    {
    	return inmolastid;
    }

} // END inmo_dbInsertID()


/***************************
Function inmo_dbFreeResult()
***************************/
function inmo_dbFreeResult(inmores)
{

	return mysql_free_result(inmores);

} // END inmo_dbFreeResult()


/***************************
Function inmo_dbNumRows()
***************************/
function inmo_dbNumRows(inmores)
{

	return @mysql_num_rows(inmores);

} // END inmo_dbNumRows()


/***************************
Function inmo_dbAffectedRows()
***************************/
function inmo_dbAffectedRows()
{
	global inmo_db_link;

	return @mysql_affected_rows(inmo_db_link);

} // END inmo_dbAffectedRows()

?>