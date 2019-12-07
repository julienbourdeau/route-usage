<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
;

$config = PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        '@PhpCsFixer' => true,
        'list_syntax' => ['syntax' => 'long'],
        'multiline_whitespace_before_semicolons' => false,
    ])
    ->setFinder($finder)
;

return $config;
