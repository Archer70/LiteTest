<?php
namespace LiteTest\src;

class FileReader
{
    private $testPath;

    public function __construct($path)
    {
        $this->testPath = $path;
    }

    public function getClassNamesFromFiles()
    {
        $classNames = [];
        foreach ($this->getTestFilePaths() as $file) {
            $parser = new ClassParser($file);
            $classNames[] = $parser->getClassNameInFile();
        }
        return $classNames;
    }

    public function getTestFilePaths()
    {
        $filePaths = [];
        foreach ($this->fileIterator() as $file) {
            if (!is_dir($file) && preg_match('/(Test\.php)$/', $file->getPathname())) {
                $filePaths[] = $file->getPathname();
            }
        }
        return $filePaths;
    }

    private function fileIterator()
    {
        return new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($this->testPath));
    }
}
