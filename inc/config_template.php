<?php
/*
================================================================================
 *  BISMILLAAHIRRAHMAANIRRAHIIM - In the Name of Allah, Most Gracious, Most Merciful
================================================================================
FILENAME	 : inc/config.php
AUTHOR		 : CAHYA DSN
CREATED DATE : 2025-02-02 17:02:28
UPDATED DATE : 2025-02-02 17:02:34
DEMO SITE    : https://psycho.cahyadsn.com/bfi
SOURCE CODE  : https://github.com/cahyadsn/bfi
================================================================================
This program is free software; you can redistribute it and/or modify it under the
terms of the MIT License.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

See the MIT License for more details

copyright (c) 2025 by cahya dsn; cahyadsn@gmail.com
================================================================================ */
//--
define('_ISONLINE',true);
//-- assets folder
define('_ASSET','assets/');
//-- constante
$version    = '0.1';
$_SESSION['author'] = 'cahyadsn';
$_SESSION['r_id']    = sha1(rand());
$_SESSION['lang']   = 'EN';
//-- database configuration
$dbhost='localhost';
$dbuser='root';
$dbpass='';
$dbname='psycho';
//-- database connection
$db=new mysqli($dbhost,$dbuser,$dbpass,$dbname);
if ($db->connect_error) {
    die('Connect Error ('.$db->connect_errno.') '.$db->connect_error);
}