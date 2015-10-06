<?php
namespace LiteTest\src;

class ClassParser
{
	private $tokens;
	
	private $gatheringNamespace = false;
	private $namespaceBits = [];
	
	private $className = '';
	private $gatheringClassName = false;
	
	public function __construct($filePath)
	{
		if (!file_exists($filePath) || !is_readable($filePath)) {
			throw new FileException('File does not exist, or is not readable; check permissions.');
		}
		$this->tokens = token_get_all(file_get_contents($filePath));
	}
	
	public function getNamespaceOfFile()
	{
		foreach ($this->tokens as $token) {
			$this->updateReadingNamespaceStatus($token);
			$this->addNamespacePiece($token);
			$this->updateReadingNamespaceStatus($token);			 
		}
		return implode('', $this->namespaceBits);
	}
	
	private function updateReadingNamespaceStatus($token)
	{
		if (is_array($token) && $this->tokenCode($token) == T_NAMESPACE) {
			$this->gatheringNamespace = true;
		} else if ($token == ';' || $token == '{') {
			$this->gatheringNamespace = false;
		}
	}
	
	private function tokenCode(array $token)
	{
		return $token[0];
	}
	
	private function addNamespacePiece($token)
	{
		if (is_array($token)
			&& $this->gatheringNamespace
			&& $this->tokenCode($token) != T_WHITESPACE
			&& $this->tokenCode($token) != T_NAMESPACE) {
				$this->namespaceBits[] = $this->tokenValue($token);
		}
	}
	
	private function tokenValue(array $token)
	{
		return $token[1];
	}
	
	public function getClassNameInFile()
	{
		foreach ($this->tokens as $token) {
			if (is_array($token) && $this->tokenCode($token) == T_CLASS) {
				$this->gatheringClassName = true;
			} else if ($this->gatheringClassName && is_array($token) && $this->tokenCode($token) == T_STRING) {
				$this->className = $this->tokenValue($token);
				$this->gatheringClassName = false;
			}
		}
		return sprintf('%s\\%s', $this->getNamespaceOfFile(), $this->className);
	}
}
