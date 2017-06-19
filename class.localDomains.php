<?php

class localDomains {
	
	protected $arr_localDomains = NULL;

	public function __construct($arr_domains=array()){
		if (count($arr_domains)) {
			$this->initDomains($arr_domains);
		}
	}
	
	public function initDomains($arr_domains){
		$this->arr_localDomains = array();
		foreach ($arr_domains as $domain => $domainConf){
			$this->arr_localDomains[] = new localDomain($domain, $domainConf);
		}
	}

	public function getDomainArray($arr_domains=array()){
		if(count($arr_domains)){
			$this->initDomains($arr_domains);
		}
		return $this->arr_localDomains;
	}

	public function getDomains($arr_domains=array()){
		if(count($arr_domains)){
			$this->initDomains($arr_domains);
		}
		$mainDomains = $this->getMainDomains($arr_domains);
		foreach ($mainDomains as $int_count => $mainDomain){
			// @TODO
		}
		return $mainDomains;
	}

	public function getMainDomains($arr_domains=array()){
		if(count($arr_domains)){
			$this->initDomains($arr_domains);
		}
		$mainDomains = array();
		foreach ($this->arr_localDomains as $int_count => $obj_localDomain){
			if(!$obj_localDomain->getParentDomain()){
				$mainDomains[] = $obj_localDomain;
			}
		}
		return $mainDomains;
	}

	public function getSubDomains($mainDomain='', $arr_domains=array()){
		if(count($arr_domains)){
			$this->initDomains($arr_domains);
		}
		foreach ($this->arr_localDomains as $int_count => $obj_localDomain){
			// @TODO
		}
	}
	
	public function parse(
		$allWrap=array('<table>','</table>'),
		$headerWrap=array('<thead>','</thead>'),
		$headerLineWrap=array('<tr>','</tr>'),
		$headerFieldWrap=array('<th>','</th>'),
		$bodyWrap=array('<tbody>','</tbody>'),
		$bodyLineWrap=array('<tr>','</tr>'),
		$bodyFieldWrap=array('<td>','</td>')
	){
		# var_dump($this->getDomainArray());
		$domains = $this->getDomains();
		
		$header = $headerLineWrap[0];
		$header.= $headerFieldWrap[0].'Domain'.$headerFieldWrap[1];
		$header.= $headerFieldWrap[0].'Alias'.$headerFieldWrap[1];
		$header.= $headerFieldWrap[0].'Path'.$headerFieldWrap[1];
		$header.= $headerFieldWrap[0].'Admin-Url'.$headerFieldWrap[1];
		$header.= $headerFieldWrap[0].'Admin-Path'.$headerFieldWrap[1];
		$header.= $headerFieldWrap[0].'Admin-Login'.$headerFieldWrap[1];
		$header.= $headerLineWrap[1];
		$header = $headerWrap[0].$header.$headerWrap[1];
		
		$body = $bodyWrap[0];
		foreach($domains as $count => $domain){	
			#foreach($domain as $countSub => $subDomain){
				$body.= $bodyLineWrap[0];
				$body.= $domain->parse($domain,$bodyFieldWrap);
				$body.= $bodyLineWrap[1];
			#}
		}
		$body.= $bodyWrap[1];
		
		$content = $allWrap[0].$header.$body.$allWrap[1];
		unset($header);
		unset($body);
		echo $content;
	}
	
}

?>