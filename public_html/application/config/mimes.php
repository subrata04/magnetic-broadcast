<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| MIME TYPES
| -------------------------------------------------------------------
| This file contains an array of mime types.  It is used by the
| Upload class to help identify allowed file types.
|
*/

$mimes = array(	'hqx'	=>	'application/mac-binhex40',
				'cpt'	=>	'application/mac-compactpro',
				'csv'	=>	array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel'),
				'bin'	=>	'application/macbinary',
				'dms'	=>	'application/octet-stream',
				'lha'	=>	'application/octet-stream',
				'lzh'	=>	'application/octet-stream',
				'exe'	=>	array('application/octet-stream', 'application/x-msdownload'),
				'class'	=>	'application/octet-stream',
				'psd'	=>	'application/x-photoshop',
				'so'	=>	'application/octet-stream',
				'sea'	=>	'application/octet-stream',
				'dll'	=>	'application/octet-stream',
				'oda'	=>	'application/oda',
				'pdf'	=>	array('application/pdf', 'application/x-download'),
				'ai'	=>	'application/postscript',
				'eps'	=>	'application/postscript',
				'ps'	=>	'application/postscript',
				'smi'	=>	'application/smil',
				'smil'	=>	'application/smil',
				'mif'	=>	'application/vnd.mif',
				'xls'	=>	array('application/excel', 'application/vnd.ms-excel', 'application/msexcel'),
				'ppt'	=>	array('application/powerpoint', 'application/vnd.ms-powerpoint'),
				'wbxml'	=>	'application/wbxml',
				'wmlc'	=>	'application/wmlc',
				'dcr'	=>	'application/x-director',
				'dir'	=>	'application/x-director',
				'dxr'	=>	'application/x-director',
				'dvi'	=>	'application/x-dvi',
				'gtar'	=>	'application/x-gtar',
				'php'	=>	'application/x-httpd-php',
				'php4'	=>	'application/x-httpd-php',
				'php3'	=>	'application/x-httpd-php',
				'phtml'	=>	'application/x-httpd-php',
				'phps'	=>	'application/x-httpd-php-source',
				'js'	=>	'application/x-javascript',
                'swf'    => 'application/x-shockwave-flash',
				'sit'	=>	'application/x-stuffit',
				'tgz'	=>	array('application/x-tar', 'application/x-gzip-compressed'),
				'xhtml'	=>	'application/xhtml+xml',
				'xht'	=>	'application/xhtml+xml',
				
				'mid'	=>	'audio/midi',
				'midi'	=>	'audio/midi',
				'mpga'	=>	'audio/mpeg',
				'mp2'	=>	'audio/mpeg',
				'mp3'	=>	array('audio/mpeg', 'audio/mpg', 'audio/mpeg3', 'audio/mp3'),
				'aif'	=>	'audio/x-aiff',
				'aiff'	=>	'audio/x-aiff',
				'aifc'	=>	'audio/x-aiff',
				'ram'	=>	'audio/x-pn-realaudio',
				'rm'	=>	'audio/x-pn-realaudio',
				'rpm'	=>	'audio/x-pn-realaudio-plugin',
				'ra'	=>	'audio/x-realaudio',
				'rv'	=>	'video/vnd.rn-realvideo',
				'wav'	=>	array('audio/x-wav', 'audio/wave', 'audio/wav'),
				'bmp'	=>	array('image/bmp', 'image/x-windows-bmp'),
				'gif'	=>	'image/gif',
				'jpeg'	=>	array('image/jpeg', 'image/pjpeg'),
				'jpg'	=>	array('image/jpeg', 'image/pjpeg'),
				'jpe'	=>	array('image/jpeg', 'image/pjpeg'),
				'png'	=>	array('image/png',  'image/x-png'),
				'tiff'	=>	'image/tiff',
				'tif'	=>	'image/tiff',
				'css'	=>	'text/css',
				'html'	=>	'text/html',
				'htm'	=>	'text/html',
				'shtml'	=>	'text/html',
				'txt'	=>	'text/plain',
				'text'	=>	'text/plain',
				'log'	=>	array('text/plain', 'text/x-log'),
				'rtx'	=>	'text/richtext',
				'rtf'	=>	'text/rtf',
				'xml'	=>	'text/xml',
				'xsl'	=>	'text/xml',
				'mpeg'	=>	'video/mpeg',
				'mpg'	=>	'video/mpeg',
				'mpe'	=>	'video/mpeg',
				'qt'	=>	'video/quicktime',
				'mov'	=>	'video/quicktime',
				'movie'	=>	'video/x-sgi-movie',
				'doc'	=>	'application/msword',
				'docx'	=>	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				'xlsx'	=> 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
				'word' => array('application/msword', 'application/octet-stream'),
				'xl' =>	'application/excel',
				'eml' => 'message/rfc822',
				'json' => array('application/json', 'text/json'),
                
                // Modification done here for video upload
                'flv' => array('video/x-flv','application/octet-stream','application/x-shockwave-flash', 'video/mp4', 'video/flv'),    // FLV file upload
                'mp4' => array('video/mp4','application/octet-stream','video/mp4v-es','audio/mp4'),    // MP4 file upload
                'avi' => array('video/msvideo', 'video/x-msvideo', 'video/avi', 'application/x-troff-msvideo', 'video/xmpg2'),
                'vob' => array('video/dvd', 'video/mpeg'),
                'mpg' => array('video/mpeg', 'video/mpg', 'video/x-mpg', 'video/mpeg2', 'application/x-pn-mpg', 'video/x-mpeg', 'video/x-mpeg2a'),
                'mpeg' => array('video/mpeg'),
                'wmv' => array('video/x-ms-wmv'),
                '3gp' => array('audio/3gpp', 'video/3gpp'),
                
                // Extension for zip files
                '7z' => array('application/x-7z-compressed', 'application/octet-stream'),
                'gz' => array('application/gzip', 'application/x-gzip', 'application/x-gunzip', 'application/gzipped', 'application/gzip-compressed', 'application/x-compressed', 'application/x-compress', 'gzip/document', 'application/octet-stream'),
                'tar' => array('application/tar', 'application/x-tar', 'applicaton/x-gtar', 'multipart/x-tar', 'application/x-compress', 'application/x-compressed'),
                'zip'    =>  array('application/zip', 'application/x-zip', 'application/x-zip-compressed', 'application/octet-stream', 'application/x-compress', 'application/x-compressed', 'multipart/x-zip')
			);


/* End of file mimes.php */
/* Location: ./application/config/mimes.php */
