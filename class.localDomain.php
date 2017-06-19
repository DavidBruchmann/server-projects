<?php

class localDomain {
	
	protected $domainName = NULL;
	
	protected $domainConf = array();
	
	protected $isMain = FALSE;
	
	protected $isSub = FALSE;
	
	protected $parent = '';
	
	protected $alias = '';
	
	protected $path = '';
	
	protected $adminUrl = '';
	
	protected $adminPath = '';
	
	protected $adminLogin = array();
	
	protected $parentDomain = NULL;
	
	public function __construct($str_domain='', $domainConf=array()){
		if($str_domain && count($domainConf)){
			$this->initDomain($str_domain, $domainConf);
		}
	}
	
	public function initDomain($str_domain, $arr_domainConf){
		$this->setDomainName($str_domain);
		$this->setDomainConf($arr_domainConf);
		$this->initDomainConf();
	}
	
	public function setDomainName($str_domain){
		$this->domainName = $str_domain;
	}
	
	public function getDomainName(){
		return $this->domainName;
	}
	
	public function setDomainConf($domainConf){
		$this->domainConf = $domainConf;
		/*
		'domain' => array(
			'parent-domain' => '',
			'alias' => '',
			'path' => '/',
			'admin-url' => '',
			'admin-path' => '',
		)
		*/
	}
	
	public function initDomainConf(){
		$domainConf = $this->domainConf;
		if(isset($domainConf['parent-domain']) && strlen($domainConf['parent-domain'])){
			$this->setParentDomain($domainConf['parent-domain']);
			$this->setIsMain(FALSE);
			$this->setIsSub(TRUE);
		} else {
			$this->setIsMain(TRUE);
			$this->setIsSub(FALSE);
		}
		if(isset($domainConf['alias']) && strlen($domainConf['alias'])){
			$this->setAlias($domainConf['alias']);
		}
		if(isset($domainConf['path']) && strlen($domainConf['path'])){
			$this->setPath($domainConf['path']);
		}
		if(isset($domainConf['admin-url']) && strlen($domainConf['admin-url'])){
			$this->setAdminUrl($domainConf['admin-url']);
		}
		if(isset($domainConf['admin-path']) && strlen($domainConf['admin-path'])){
			$this->setAdminPath($domainConf['admin-path']);
		}
		if(isset($domainConf['admin-login']) && strlen($domainConf['admin-login'])){
			$this->setAdminLogin($domainConf['admin-login']);
		}
	}
	
	public function getDomainConf(){
		return $this->domainConf;
	}
	
	protected function setParentDomain($parentDomain){
		$this->parentDomain = $parentDomain;
	}
	
	public function getParentDomain(){
		return $this->parentDomain;
	}
	
	protected function setAlias($alias){
		$this->alias = $alias;
	}
	
	public function getAlias(){
		return $this->alias;
	}
	
	protected function setPath($path){
		$this->path = $path;
	}
	
	public function getPath(){
		return $this->path;
	}
	
	protected function setAdminUrl($adminUrl){
		$this->adminUrl = $adminUrl;
	}
	
	public function getAdminUrl(){
		return $this->adminUrl;
	}
	
	protected function setAdminPath($adminPath){
		$this->adminPath = $adminPath;
	}
	
	public function getAdminPath(){
		return $this->adminPath;
	}
	
	protected function setAdminLogin($adminLogin){
		$this->adminLogin = $adminLogin;
	}
	
	public function getAdminLogin(){
		return $this->adminLogin;
	}
	
	protected function setIsMain($isMain){
		$this->isMain = $isMain;
	}
	
	public function getIsMain(){
		return $this->isMain;
	}
	
	protected function setIsSub($isSub){
		$this->isSub = $isSub;
	}
	
	public function getIsSub(){
		return $this->isSub;
	}
	
	public function setSubDomains($subDomains){
		$this->subDomains = $subDomains;
	}
	
	public function addSubDomains($subDomain){
		$this->subDomains[] = $subDomain;
	}
	
	public function removeSubDomain(localDomain $subDomainName){
		foreach($this->subDomains as $count => $subDomain){
			if($subDomain->getDomainName() === $subDomainName){
				unset($subDomain);
				// unset($this->subDomains[$count]);
			}
		}
	}
	
	public function getSubDomains(){
		return $this->subDomains();
	}
	
	public function parse($domain, $fieldWrap=array('<td>','</td>')){
		$content = $fieldWrap[0].($domain->getDomainName() ? '<a href="http://'.$domain->getDomainName().'" target="_blank">'.$domain->getDomainName().'</a>' : '').$fieldWrap[1]; // DOMAIN
		$content.= $fieldWrap[0].($domain->getAlias() ? '<a href="http://'.$domain->getAlias().'" target="_blank">'.$domain->getAlias().'</a>' : '--').$fieldWrap[1]; // ALIAS
		$content.= $fieldWrap[0].($domain->getPath() ? $domain->getPath() : '--').$fieldWrap[1]; // PATH
		$content.= $fieldWrap[0].($domain->getAdminUrl() ? $domain->getAdminUrl() : '--').$fieldWrap[1]; // ADMIN-URL
		$content.= $fieldWrap[0].($domain->getAdminPath() ? $domain->getAdminPath() : '--').$fieldWrap[1]; // ADMIN-PATH
		$content.= $fieldWrap[0].
			(isset($domain->getAdminLogin()['loginName']) ? $domain->getAdminLogin()['loginName'] : '').
			(isset($domain->getAdminLogin()['loginName']) && isset($domain->getAdminLogin()['password']) ? ' - ' : '--').
			(isset($domain->getAdminLogin()['password']) ? $domain->getAdminLogin()['password'] : '').
			$fieldWrap[1]; // ADMIN-LOGIN
		return $content;
	}
}

?>