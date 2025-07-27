<?php

/**
 * MyActiveRecord
 * ==============
 * A simple, speedy Object/Relational Mapper for MySQL based on Martin 
 * Fowler's ActiveRecord pattern and heavily influenced by the implementation 
 * of the same name in Ruby on Rails.
 *
 * Features
 * --------
 *
 *	-	Mapping of table to class and row to object
 *	-	Relationship retrieval
 *	-	Data validation and error handling
 *	-	PHP5 and PHP4 compatibility
 *
 * License
 * -------
 * Copyright (c) 2006, Jake Grimley	<jake.grimley@mademedia.co.uk>
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without 
 * modification, are permitted provided that the following conditions are met:
 * 
 *	-	Redistributions of source code must retain the above copyright notice, 
 *		this list of conditions and the following disclaimer.
 *
 *	-	Redistributions in binary form must reproduce the above copyright 
 *		notice, this list of conditions and the following disclaimer in the 
 *		documentation and/or other materials provided with the distribution.
 *
 *	-	Neither the name of Made Media Ltd. nor the names of its contributors 
 *		may be used to endorse or promote products derived from this 
 *		software without specific prior written permission.
 *
 *	THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS 
 *	IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, 
 *	THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR 
 *	PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR 
 *	CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, 
 *	EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, 
 *	PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR 
 *	PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF 
 *	LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING 
 *	NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS 
 *	SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * Limitations
 * -----------
 * This class acheives simplicty of use and implementation through the 
 * following 'by-design' limitations:
 *
 *	1.	This class talks to MySQL only.
 *
 *	2.	Table/Class mapping is achieved by each database table being named 
 *		IDENTICALLY to the MyActiveRecord subclass that will represent it.
 *
 *	3.	Every database table mapped by MyActiveRecord MUST have an 
 *		autoincrementing primary-key named `id`.
 * 
 * @category	Database
 * @package		MyActiveRecord
 * @author		Jake Grimley <jake.grimley@mademedia.co.uk>
 * @copyright	2006 Jake Grimley
 * @version		0.2
 */


class MyActiveRecord
{

	/**
	 * Returns a database connection to be used by the class.
	 * If you want, you can borrow this for access to a mysql database
	 * resource:
	 * e.g.:
	 * <code>
	 * 		$result = mysql_Query($query, MyActiveRecord::Connection() );
	 * </code>
	 *
	 * This method uses the global constant MYACTIVERECORD_CONNECTION_STR for the
	 * connection paramaters. This is a string with the following format:
	 * mysql://user:passord@host/db
	 *
	 * @static
	 * @return	resource	mysql connection
	 */	
	function Connection()
	{
		// conserve connection resource
		static $rscMySQL;
		
		if( !is_resource($rscMySQL) )
		// parse connection string and obtain mysql resource
		{
			// check connection string is defined
			if( !defined('MYACTIVERECORD_CONNECTION_STR') ) 
			trigger_error("MyActiveRecord::Connection() - MYACTIVERECORD_CONNECTION_STR is undefined", E_USER_ERROR);

			// deconstruct connection string
			$params = @parse_url(MYACTIVERECORD_CONNECTION_STR) 
			or trigger_error("MyActiveRecord::Connection() - could not parse connection string: ".MYACTIVERECORD_CONNECTION_STR, E_USER_ERROR);
			
			// connect to database server
			$rscMySQL = @mysql_pconnect($params['host'], $params['user'], $params['pass']) 
			or trigger_error("MyActiveRecord::Connection() - could not connect to database server: ".$params['host'], E_USER_ERROR);
			
			// select database
			@mysql_select_db( str_replace('/', '', $params['path']), $rscMySQL)
			or trigger_error("MyActiveRecord::Connection() - could not select database: ".$params['path'], E_USER_ERROR);
		}
		return $rscMySQL;
	}
					
	/**
	 * Execute a SQL Query using Connection()
	 *
	 * @static
	 * @param	string	strSQL	A SQL statement
	 * @return	resource	A MySQL result resource. False on failure.
	 */
	function Query($strSQL)
	{
		if( $rscResult = @mysql_query($strSQL, MyActiveRecord::Connection() ) )
		// return result
		{
			return $rscResult;
		}
		else
		// failure
		{   
			throw new Exception("MyActiveRecord::Query() - query failed: $strSQL with error: ".mysql_error( MyActiveRecord::Connection() ));
			//trigger_error("MyActiveRecord::Query() - query failed: $strSQL with error: ".mysql_error( MyActiveRecord::Connection() ), E_USER_WARNING);
			return false;
		}
	}

	/**
	 * return a date formatted for the database
	 * @param	int	intTimeStamp	A unix timestamp
	 * @return	string	mysql format date string
	 */
	function DbDate($intTimeStamp=null)
	{
		return date('Y-m-d', $intTimeStamp ? $intTimestamp:mktime() );
	}

	/**
	 * return a datetime formatted for the database
	 * @param	int	intTimeStamp	A unix timestamp
	 * @return	string	mysql format datetime string
	 */	
	function DbDateTime($intTimeStamp=null)
	{
		return date('Y-m-d H:i:s', $intTimeStamp ? $intTimeStamp:mktime() );
	}
	
	/**
	 * return a unix timestamp from a database field
	 * @param	string	mysql datetime
	 * @return	int	unix timestamp	
	 */
	function TimeStamp($strMySQLDate)
	{
		return strtotime($strMySQLDate);
	}
	
	/**
	 * Returns an array describing the specified table, or false if the table 
	 * does not exist in the database.
	 * The array contains one array per database column, keyed by the column 
	 * name. To see the structure of the array you could try: 
	 * <code>
	 * print_r( MyActiveRecord::Columns('your_table') );
	 * </code>
	 *
	 * @static
	 * @param	string	strTable	The name of the database table
	 * @return	array	Table columns. False if the table does not exist.
	 */
	function Columns($strTable)
	{
		// cache results locally
		static $cache=array();
		
		// already cached? return columns array
		if( isset($cache[$strTable]) )
		{
			return $cache[$strTable];
		}
		else
		// connect to database and run 'describe' query to get results
		{
			if( $rscResult = MyActiveRecord::Query("SHOW COLUMNS FROM $strTable") )
			{
				$arrFields = array();
				while( $col = mysql_fetch_assoc($rscResult) )
				{
      				$arrFields[$col['Field']] = $col;
				}
				mysql_free_result($rscResult);
				// cache results for future use and return
				return $cache[$strTable] = $arrFields;
			}
			else
			{
				trigger_error("MyActiveRecord::Columns() - could not decribe table $strTable", E_USER_WARNING);
				return false;
			}
		}
	}
	
	function QueryViews($strSql)
	{
		if( $rscResult = MyActiveRecord::Query($strSql) )
		{
			$arrFields = array();
			while( $col = mysql_fetch_assoc($rscResult) )
			{
      			$arrFields[] = $col;
			}
			mysql_free_result($rscResult);
			// cache results for future use and return
			return $cache[$strSql] = $arrFields;
		}
		else
		{
			trigger_error("MyActiveRecord::QueryViews() - Error ", E_USER_WARNING);
			return false;
		}
	}
	/**
	 * Gets the 'type' of a specific field in a specified table
	 *
	 * @static
	 * @param	string	strTable	Name of database table
	 * @param	string	strField	Name of field in table
	 * @return	string 	Field type (e.g. 'int'|'float'|'date'|'char'|'text' ). 
	 *					False if not found.
	 */
	function GetType($strTable, $strField)
	{
		$fields = MyActiveRecord::Columns($strTable);
		if( isset($fields[$strField]['Type']) )
		{
      		$type_len = explode( '(', $fields[$strField]['Type'] );
      		$type = $type_len[0];
      		return $type;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * gets the maximum allowed length of a specified field in a specified 
	 * table
	 *
	 * @static
	 * @param	string	strTable	Name of database table
	 * @param	string	strField	Name of field in table
	 * @return	integer	Maximum length of field. False if not found.
	 */
	function GetLen($strTable, $strField)
	{
		$fields=MyActiveRecord::Columns($strTable);
		if( isset($fields[$strField]['Type']) )
		{
      		$type_len = explode( '(', $fields[$strField]['Type'] );
      		$length = array_key_exists(1, $type_len) ? str_replace(')', '', $type_len[1]) : false;
      		return $length;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * finds out whether a NULL value is allowed in a specified field in a 
	 * specified table 
	 *
	 * @static
	 * @param	string	strTable	Name of database table
	 * @param	string	strField	Name of field in table
	 * @return	boolean	True if this field allows nulls. False if not.
	 */
	function AllowNull($strTable, $strField)
	{
		$fields=MyActiveRecord::Columns($strTable);
		if( isset($fields[$strField]['Null']) )
		{
			return $fields[$strField]['Null'];
  		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Escapes a value against a field type in preparation for adding to a sql
	 * query. Escaping includes wrapping the value in single quotes
	 *
	 * @static
	 * @param	mixed	mixVal	value, eg: true, 1, 'elephant' etc.
	 * @return	mixed	escaped value eg: 1, 'o\'reilly' etc.
	 */
	function Escape($mixVal)
	{
		// clean whitespace
		$val = trim( $mixVal );		
		// magic quotes?
		if ( get_magic_quotes_gpc() )
		{
			$val = stripslashes($val);
		}
		return("'".mysql_real_escape_string($val)."'");
	}
		
	/**
	 * Given the names of two classes/database tables this method returns
	 * the name of the table which would link them in a many-to-many 
	 * relationship e.g: 
	 * <code>
	 * 		print GetLinkTable('Driver', 'Car')	// Car_Driver
	 * </code>
	 *
	 * note that the linking table will order the names of the tables it links
	 * alphabetically. If you intend to have a many-to-many relationship 
	 * between two classes, you need to create this table in your database. 
	 * The table should have two indexed fields, providing foreign keys to the 
	 * tables they link, e.g. Driver_id, Car_id
	 *
	 * NB: This function does NOT check that the table actually exists in the
	 * database, but presumes that it does.
	 *
	 * @static
	 * @param	string	strClass1	name of first class/table, e.g. 'Person'
	 * @param	string	strClass2	name of second class/table e.g. 'Role'
	 * @return	string	name of linking table
	 */
	function GetLinkTable($strClass1, $strClass2)
	{
		$array = array($strClass1, $strClass2);
		sort($array);
		return implode( '_', $array);
	}
	
	/**
	 * Links two objects together. Presumes the existance of a linking table.
	 *
	 * @static
	 * @param	object	$obj1	An Object from a subclass of MyActiveRecord
	 * @param	object	$obj2	An Object from a subclass of MyActiveRecord
	 * @return	boolean	true on success, false on failure
	 * @see	GetLinkTable()	
	 */
	function Link(&$obj1, &$obj2)
	{
		$class1=get_class($obj1);
		$class2=get_class($obj2);
		$linktable = MyActiveRecord::GetLinkTable($class1, $class2);
		$sql = "INSERT INTO {$linktable} ({$class1}_id, {$class2}_id) VALUES ({$obj1->id}, {$obj2->id})";
		if( MyActiveRecord::Query($sql) )
		{
			return true;
		}
		else
		{
			trigger_error("MyActiveRecord::Link() - Failed to link objects: $class1, $class2", E_USER_WARNING);
			return false;
		}
	}
	
	/**
	 * Destroys a link between two objects where it exists
	 *
	 * @static
	 * @param	$obj1	An Object from a subclass of MyActiveRecord
	 * @param	$obj2	An Object from a subclass of MyActiveRecord
	 * @return	true on success, false on failure
	 */
	function UnLink(&$obj1, &$obj2)
	{
		$class1=get_class($obj1);
		$class2=get_class($obj2);
		$linktable = MyActiveRecord::GetLinkTable($class1, $class2);
		$sql = "DELETE FROM {$linktable} WHERE {$class1}_id = {$obj1->id} AND {$class2}_id = {$obj2->id}";
		if( MyActiveRecord::Query($sql) )
		{
			return true;
		}
		else
		{
			trigger_error("MyActiveRecord::UnLink() - Failed to unlink objects: $class1, $class2", E_USER_WARNING);
			return false;
		}
	}
	
	/**
	 * Creates a new object of class strClass. strClass should be 
	 * an extension of MyActiveRecord. arrVals is an optional array of values.
	 * e.g.:
	 * <code>
	 * 		$person = MyActiveRecord::Create('Person', array( first_name=>'Jake', last_name=>"Grimley' ) );
	 * </code>
	 *
	 * @static
	 * @param	strClass, the name of the subclass.
	 * @return	object	of class strClass
	 */
	function &Create($strClass, $arrVals = null )
	{
		$obj = new $strClass();
		foreach( MyActiveRecord::Columns( $strClass ) as $key=>$field )
		{
			$obj->$key = $field['Default'];
		}
		$obj->populate($arrVals);		
		return $obj;
	}
	
	/**
	 * Counts the number of rows in the database matching the optional 
	 * condition. eg:
	 * <code>
	 * 		print 'There are '.MyActiveRecord::Count('Person').' People in the database.';
	 * 		print 'There are '.MyActiveRecord::Count('Person', "last_name LIKE 'Smith'").' People with the surname Smith';
	 * </code>
	 *
	 * @static
	 * @param	string	strClass, the name of the class for which you want to create an object.
	 * @return	integer Count. False if the query fails.
	 */
	function Count( $strClass, $strWhere='1=1' )
	{
		$strSQL = "SELECT Count(id) AS count FROM $strClass WHERE $strWhere";
		$rscResult = MyActiveRecord::Query($strSQL);
		if( $arr = mysql_fetch_array($rscResult) )
		{
			return $arr['count'];
		}
		else
		{
			return false;
		}
	}
		
	/**
	 * Returns an array of objects of class strClass mapped from SQL query 
	 * strSQL. eg:
	 * <code>
	 * 		$people = MyActiveRecord::('Person', 'SELECT * FROM person ORDER BY first_name');
	 * 		foreach( $people as $person ) print $person->first_name;
	 * </code>
	 *
	 * @static
	 * @param	string	strClass	The name of the class for which you want to return objects.
	 * @param	string	strSQL	The SQL query
	 * @return	array	array of objects of class strClass
	 */
	function FindBySql( $strClass, $strSQL, $strIndexBy='id' )
	{
	
		static $cache = array();
		$md5 = md5($strSQL);
	
		if( isset( $cache[$md5] ) && defined('MYACTIVERECORD_CACHE_SQL') && MYACTIVERECORD_CACHE_SQL )
		{
			return $cache[$md5];
		}
		else
		{			
			if( $rscResult = MyActiveRecord::query($strSQL) )
			{
				$arrObjects = array();
				while( $arrVals = mysql_fetch_assoc($rscResult) )
				{
					$arrObjects[$arrVals[$strIndexBy]] =& MyActiveRecord::Create($strClass, $arrVals );
				}
				mysql_free_result($rscResult);
				return $cache[$md5]=$arrObjects;
			}
			else
			{
				trigger_error("MyActiveRecord::FindBySql() - SQL Query Failed: $strSQL", E_USER_ERROR);
				return $cache[$md5]=false;
			}
		}
	}
	
	/**
	 * Returns an array of all objects of class strClass found in database
	 * optional where, order and limit paramaters enable the results to be 
	 * narrowed down. eg:
	 * <code>
	 * 		$cars = MyActiveRecord::FindAll('Car');
	 * 		$cars = MyActiveRecord::FindAll('Car', "colour='red'", 'make ASC', 10);
	 * </code>
	 *
	 * @static
	 * @param 	string	strClass	the name of the class for which you want objects
	 * @param 	mixed	mxdWhere	optional SQL WHERE argument, eg: "username='fred' AND password='123'"
	 *								can also be expressed as array, e.g. array( 'username'=>'fred', password=>'123')
	 * @param	string	strOrderBy	optional SQL ORDER BY argument, eg: "username ASC"
	 * @param	string	intLimit	optional integer limiting the number of records returned
	 * @param	string	intOffset	optional integer to offset the first record brought back
	 * @return	array	Array of objects. Array is empty if no ojbects found
	 */
	function FindAll( $strClass, $mxdWhere=NULL, $strOrderBy='id ASC', $intLimit=100000, $intOffset=0 )
	{
		$strSQL = "SELECT * FROM $strClass";
		if($mxdWhere)
		{
			$strWhere = ' WHERE ';
			if( is_array($mxdWhere) )
			{
				$conditions = array();
				foreach($mxdWhere as $key=>$val)
				{
					$val = addslashes($val);
					$conditions[]="$key='$val'";
				}
				$strWhere.= implode(' AND ', $conditions);
			}
			elseif( is_string($mxdWhere) )
			{
				$strWhere.= $mxdWhere;
			}
			$strSQL.=$strWhere;
		}
		$strSQL.=" ORDER BY $strOrderBy LIMIT $intOffset, $intLimit";
		return MyActiveRecord::FindBySql( $strClass, $strSQL );
	}

		function FindAllCSM( $strClass, $mxdWhere=NULL, $strOrderBy='id ASC', $intLimit=3, $intOffset=0 )
	{
		$strSQL = "SELECT * FROM $strClass";
		if($mxdWhere)
		{
			$strWhere = ' WHERE ';
			if( is_array($mxdWhere) )
			{
				$conditions = array();
				foreach($mxdWhere as $key=>$val)
				{
					$val = addslashes($val);
					$conditions[]="$key='$val'";
				}
				$strWhere.= implode(' AND ', $conditions);
			}
			elseif( is_string($mxdWhere) )
			{
				$strWhere.= $mxdWhere;
			}
			$strSQL.=$strWhere;
		}
		$strSQL.=" ORDER BY $strOrderBy LIMIT $intOffset, $intLimit";
		return MyActiveRecord::FindBySql( $strClass, $strSQL );
	}

	/**
	 * Returns the first object of class strClass found in database
	 * optional where, order and limit paramaters enable the results to be 
	 * narrowed down
	 * eg:
	 * <code>
	 * 		$car = MyActiveRecord::FindFirst('Car', "colour='red'", 'model ASC');
	 * </code>
	 *
	 * @static
	 * @param	strClass	string, the name of the class for which you want objects
	 * @param	strWhere	optional SQL WHERE argument, eg: "username='fred' AND password='123'"
	 * @param	strOrderBy	optional SQL ORDER BY argument, eg: "username ASC"
	 * @return	object, false if no objects found
	 */	
	function FindFirst( $strClass, $strWhere=NULL, $strOrderBy='id ASC' )
	{
		$arrObjects = MyActiveRecord::FindAll( $strClass, $strWhere, $strOrderBy, 1 );
		if( Count($arrObjects) )
		{
			return array_shift($arrObjects);
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Returns an object of class strClass found in database with a specific 
	 * integer ID. An array of integers can be passed in order to retrieve an 
	 * array of objects with matching IDs
	 * eg:
	 * <code>
	 * 		$car = MyActiveRecord::FindById(15);
	 * 		$cars = MyActiveRecord::FindById(3, 5, 13);
	 * </code>
	 *
	 * @static
	 * @param	string	strClass	the name of the class for which you want objects
	 * @param	mixed	mxdID	integer or array of integers
	 * @return	mixed	object, or array of objects
	 */	
	function FindById( $strClass, $mxdID )
	{
		if( is_array($mxdID) )
		{
			$idlist = implode(', ', $mxdID);
			return MyActiveRecord::FindAll( $strClass, "id IN ($idlist)" );
		}
		else
		{
			$strCondition = "id = $mxdID";
			return MyActiveRecord::FindFirst( $strClass, array('id'=>$mxdID) );
		}
	}
	
	function Insert( $strClass, $properties )
	{
		$object = MyActiveRecord::Create($strClass, $properties);
		return $object->save;
	}
	
	function Update( $strClass, $id, $properties )
	{
		$object = MyActiveRecord::FindById($strClass, $id);
		return $object->save();
	}
	
	function Begin()
	{
		MyActiveRecord::Query('BEGIN');
	}
	
	function RollBack()
	{
		MyActiveRecord::Query('ROLLBACK');
	}
	
	function Commit()
	{
		MyActiveRecord::Query('COMMIT');
	}
		
	/**
	 * Saves the object back to the database
	 * eg: 
	 * <code>
	 * 		$car = MyActiveRecord::Create('Car');
	 * 		print $car->id;	// NULL
	 * 		$car->save();
	 * 		print $car->id; // 1
	 * </code>
	 *
	 * NB: if the object has registered errors, save() will return false
	 * without attempting to save the object to the database
	 *
	 * @return	boolean	true on success false on fail
	 */
	function save()
	{
		// if this object has registered errors, we back off and return false.
		if( $this->get_errors() )
		{
			return false;
		}
		else
		{
			$table = get_class($this);
			$fields = MyActiveRecord::Columns($table);
			
			// sort out key and value pairs
			foreach ( $fields as $key=>$field )
			{
				if($key!='id')
				{
					$val = MyActiveRecord::Escape($this->$key);
					$vals[]=$val;
					$keys[]="`".$key."`";
					$set[] = "`$key` = $val";
				}
			}
			
			// insert or update as required
			if($this->id)
			{
				$sql="UPDATE `$table` SET ".implode($set, ", ")." WHERE id={$this->id}";
			}
			else
			{
				$sql="INSERT INTO `$table` (".implode($keys, ", ").") VALUES (".implode($vals, ", ").")";
			}
			$success = MyActiveRecord::Query($sql);
			if(!$this->id)
			{
				$this->id=mysql_insert_id( MyActiveRecord::Connection() );
			}
			return $success;
		}
	}
 
 	/**
 	 * Sets all object properties via an array
 	 *
 	 * @param	array	$arrVals	array of named values
 	 * eg:
 	 * <code>
 	 * $car->populate( array('make'=>'Citroen', 'model'=>'C4', 'colour'=>'red') );
 	 * $car->populate( $_POST );
 	 * </code>
 	 *
 	 * @param	array	$arrVals
 	 * @return	void
 	 */
	function populate($arrVals)
	{
		if( is_array($arrVals) )
		{
			foreach($arrVals as $key=>$val)
			{
				$this->$key=$val;
			}
			return true;
		}
		else
		{
			return false;
		}
	}
		
	/**
	 * Deletes the object from the database
	 * eg:
	 * <code>
	 * 		$car = MyActiveRecord::FindById('Car', 1);
	 * 		$car->destroy();
	 * </code>
	 *
	 * @return	boolean	True on success, False on failure
	 */
	function destroy()
	{
		$table = get_class($this);
		return MyActiveRecord::Query( "DELETE FROM $table WHERE id ={$this->id}");
	}
	
	/**
	 * alias of destroy()
	 * @see destroy()
	 */
	function delete()
	{
		return $this->destroy();
	}
	
	/**
	 * Attaches another object to the object
	 * NB: You must have saved the object you want to attach before attaching 
	 * it eg:
	 * <code>
	 * 		$post = MyActiveRecord::Create('Post');
	 * 		$post->populate( 'title'=>'New Post' );
	 * 		$post->save();
	 * 		$topic->attach('post');
	 * </code>
	 *
	 * @param	object	$obj	the object you wish to attach
	 * @return	boolean	True on success. False on failure.
	 */
	function attach(&$obj)
	{
		if( $this->id && $obj->id )
		{
			return MyActiveRecord::Link($this, $obj);
		}
		else
		{
			trigger_error('MyActiveRecord::attach() - both objects must be saved before you can attach');
			return false;
		}
	}
	
	/**
	 * Detaches an object from the object
	 * eg:
	 * <code>
	 * // detach old posts
	 * foreach( $topic->find_attached('Post') as $post )
	 * {
	 * 	if( $post->created < mktime()-5000000 )
	 *	{
	 *		$topic->detach($post);
	 *	}
	 * }
	 * </code>
	 *
	 * @param	object	$obj	object to be detached
	 */	
	function detach(&$obj)
	{
		return MyActiveRecord::UnLink($this, $obj);
	}
	
	/**
	 * Sets all attached links via an array of IDs
	 * e.g.
	 * <code>	
	 * $topic->set_attached('Post', array(1, 8, 32) );
	 * $topic->set_attached('Post', $_POST['id_list']);
	 * </code>
	 * NB: set_attached will destroy any existing attachments for the class strClass
	 * BEFORE creating new attachments
	 *
 	 * @param	string	strClass	class of objects to be set as attached
	 * @param	array	arrID		array of object IDs
	 * @return	boolean	True on success. False on failure.
	 */
	function set_attached($strClass, $arrID)
	{
		if( is_array($arrID) )
		{
			MyActiveRecord::Begin();
			$pass = true;
			foreach( $this->find_linked($strClass) as $fObject )
			{
				$this->detach($fObject) or $pass=false;
			}
			foreach( MyActiveRecord::FindById($strClass, $arrID) as $fObject )
			{
				$this->attach($fObject) or $pass=false;
			}
			$pass ? MyActiveRecord::Commit() : MyActiveRecord::RollBack();
			return $pass;
		}
		else
		{
			trigger_error('MyActiveRecord::set_attached() - Second argument not an array', E_USER_NOTICE);
			return false;
		}
	}

	
	/**
	* Sets the date of the property specified by strKey
	* @param	string	strKey	property to be set
	* @param	int	intTimeStamp	unix timestamp	
	*/
	function set_date($strKey, $intTimeStamp=null)
	{
		$this->$strKey = MyActiveRecord::DbDate($intTimeStamp);
	}
	
	/**
	* Sets the datetime of the property specified by strKey
	* @param	string	strKey	property to be set
	* @param	int	intTimeStamp	unix timestamp	
	*/
	function set_datetime($strKey, $intTimeStamp=null)
	{
		$this->$strKey = MyActiveRecord::DbDateTime($intTimeStamp);
	}
	
	/**
	* Retrieves a date or datetime fields as a unix timestamp
	* @param	string	strKey	property to be retrieved
	*/
	function get_timestamp($strKey)
	{
		return MyActiveRecord::TimeStamp($this->$strKey);
	}
	
	/**
	 * returns 'parent' object.
	 * e.g.
	 * <code>
	 * 		$topic = $post->find_parent('Topic');
	 * </code>
	 * 
	 * In order for the above to work, you would need to have an integer 
	 * field called 'Topic_id' in your 'Post' table. MyActiveRecord will take 
	 * care of the rest.
	 *
	 * @param	string	strClass	Name of the class of objects to return in the array
	 * @param	string	strForeignKey	Optional specification of foreign key at runtime
	 * @return	object	object of class strClass
	 */
	function find_parent($strClass, $strForeignKey=NULL)
	{
		$key = $strForeignKey or $key=strtolower( $strClass.'_id' );
		return MyActiveRecord::FindById($strClass, $this->$key);
	}
	
	/**
	 * returns array of 'child' objects.
	 * e.g.
	 * <code>
	 * 		foreach( $topic->find_children('Post') as $post ) print $post->subject;
	 * </code>
	 * 
	 * In order for the above to work, you would need to have an integer field called 'Topic_id'
	 * in your 'Post' table. MyActiveRecord will take care of the rest.
	 *
	 * @param	string	strClass	Name of the class of objects to return in the array
	 * @param	mixed	optional sql condition expressed as either a sql string or an array
	 *					eg:	'flagged=true' or array( 'flagged'=>1 );
	 * @return	array	array containing objects of class strClass
	 */
	function find_children($strClass, $mxdCondition=NULL, $strOrderBy='id ASC')
	{
		// name of foreign key:
		$key=strtolower( get_class($this).'_id' );
				
		if( is_array($mxdCondition) || is_null($mxdCondition) )
		{
			// specifiy condition as an array
			$mxdCondition[$key]=$this->id;
			return MyActiveRecord::FindAll( $strClass, $mxdCondition, $strOrderBy );
		}
		else
		{
			// condition is non-null string
			$fullSQLCondition = "$key=$this->id AND ($mxdCondition)";
			return MyActiveRecord::FindAll( $strClass, $fullSQLCondition, $strOrderBy );
		}
	}
	
	/**
	 * returns array of 'linked' objects. (many-to-many relationship)
	 * e.g.
	 * <code>
	 * 		foreach( $user->find_linked('Role') as $role ) print $role->name;
	 * </code>
	 * 
	 * In order for the above to work, you would need to have a linking table
	 * called Role_User in your database, containing the fields role_id and user_id
	 *
	 * @param	string	strClass	Name of the class of objects to return in the array
	 * @param	string	strCondition	Optional SQL condition, e.g. 'password NOT NULL'
	 * @return	array	array containing objects of class strClass
	 *
	 * @todo	not tested
	 */	
	function find_linked($strClass, $mxdCondition=NULL)
	{
		if($this->id)
		{
			// only attempt to find links if this object has an id
			$thisclass=get_class($this);
			$linktable=MyActiveRecord::GetLinkTable($strClass, $thisclass);
			$sql= "SELECT {$strClass}.* FROM {$strClass} INNER JOIN {$linktable} ON {$strClass}_id = {$strClass}.id WHERE $linktable.{$thisclass}_id = {$this->id}";
			if( is_array($mxdCondition) )
			{
				foreach($mxdCondition as $key=>$val)
				{
					$val = addslashes($val);
					$sql.=" AND $key = '$val' ";
				}
			}
			else
			{
				if($mxdCondition) $sql.=" AND $mxdCondition";
			}
			return MyActiveRecord::FindBySql($strClass, $sql);
		}
		else
		{
			return array();
		}
	}
	
	/**
	 * Alias of find_linked()
	 * @link find_linked()
	 */
	function find_attached($strClass, $strCondition=NULL)
	{
		return $this->find_linked($strClass, $strCondition);
	}
	
	/**
	 * Adds an error to the object. The existence of errors
	 * ensures that $object->save() will return false and
	 * will not attempt to persist the object to the database
	 * This can be used for validation of the object.
	 * e.g.
	 * <code>
	 * if( empty( $user->first_name ) ) $user->add_error('first_name', 'First Name may not be blank!');
	 * </code>
	 *
	 * @param	string	strKey	the name of the invalid key/property/attribute
	 * @param	string	strMessage	a message, which you may want to report back to the user in due course
	 * @return	void
	 */
	function add_error($strKey, $strMessage)
	{
		$this->_errors[$strKey] = $strMessage; 
	}
	
	/**
	 * Gets an error on a specified attribute.
	 * 
	 * @param	string	strKey	name of field/attribute/key
	 * @return	string	Error Message. False if no error
	 */
	function get_error($strKey)
	{
		if( isset($this->_errors[$strKey]) )
		{
			return $this->_errors[$strKey];
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Returns all errors.
	 *
	 * @return	array	Array of errors, keyed by attribute. 
	 *					False if there are no errors.
	 */
	function get_errors()
	{
		if( isset($this->_errors) && is_array($this->_errors) )
		{
			return $this->_errors;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Validates the value of an attribute against a regular
	 * expression, adding an error to the object if the value
	 * does not match.
	 *
	 * @param	string	strKey	name of field/attribute/key
	 * @param	string	strRegExp	Regular Expression
	 * @param	string	strMessage	Error message to record if value does not match
	 * @return	boolean	True if the field matches. False if it does not match.
	 */
	function validate_regexp($strKey, $strRegExp, $strMessage=null)
	{
		if( preg_match($strRegExp, $this->$strKey) )
		{
			return true;
		}
		else
		{
			$this->add_error($strKey, $strMessage ? $strMessage : 'Invalid '.$strKey);
			return false;
		}
	}
	
	function h($key)
	{
		return htmlentities($this->$key);
	}

}

?>
