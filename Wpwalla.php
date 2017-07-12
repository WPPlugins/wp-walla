<?php
    class Wpwalla
	{
		private $_wpwallaname;
		private $_wpwallaurl;
		private $_cacheFile = 'wpwallacache.txt';
		private $_cacheMintues;
		public $wpwalladata;
		
		public function __construct($wpwallaoptions)
		{
			$gowallaName = $wpwallaoptions['wpwallausername'];
			$cacheTime = $wpwallaoptions['wpwallacache'];

			$this->_wpwallaname = $gowallaName;
			$this->_wpwallaurl = 'http://gowalla.com/users/'.$gowallaName.'/visits.atom';
			$this->_cacheMintues = $cacheTime;
		}
		
		public function getWpwallaData()
		{
			if(!file_exists(dirname(__FILE__)."/".$this->_cacheFile)) {
				$this->createCacheFile();
			} 
			$fileTime = filemtime(dirname(__FILE__)."/".$this->_cacheFile);
			$currentTime = time();
			$cacheTime = mktime(date('H', $currentTime), date('i', $currentTime) - $this->_cacheMintues, date('s', $currentTime), date("m",$currentTime)  , date("d",$currentTime), date("Y",$currentTime));

			if($cacheTime > $fileTime) {
				$rawData = @file_get_contents($this->_wpwallaurl); //Get new Data from Gowalla-url
				$this->createCacheFile($rawData); //Create the cacheFile
			} else {
				$rawData = file_get_contents(dirname(__FILE__)."/".$this->_cacheFile); //Get old Data from Filecache
			}
			$rawData = $this->convertData($rawData);
			$WpwallaXml = simplexml_load_string($rawData);
			return $WpwallaXml;
		}
		
		
		private function createCacheFile($data = '')
		{
			file_put_contents(dirname(__FILE__)."/".$this->_cacheFile, $data); //Create the Cachefile
		}
		
		private function convertData($data)
		{
			$data = str_replace('&', '', $data);
			$data = iconv("UTF-8","UTF-8//IGNORE",$data);
			return $data;
		}
	}
?>