<?php
// Add a trailing H for helper function

use Facade\Ignition\DumpRecorder\DumpHandler;
use PhpOffice\PhpSpreadsheet\Reader\IReader;

function examStatusH($val=null)
{
$array = array(0 => __('Draft'),1=> __('Active'),2=>__('Finished'),3=>__('Archived') );

    if (isset($val)) {
        return $array[$val];
    }
        return $array;
}

function examPublishResultJ($val = null)
{
    $array = array(1 => __("Immidiate"),2=>__("After Exam Expires"), 3=>__("Manually") );

    if (isset($val)) {
        return $array[$val];
    }
    return $array;
}

function questionDifficultyH($val = null)
{
    $array = array(1 => __("Simple") , 2=> __("Medium"), 3=> __("Hard") );

    if (isset($val)) {
        return $array[$val];
    }

    return $array;
}
