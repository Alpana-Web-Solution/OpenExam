<?php
function diffInSecondsH($oldTime)
{
    return \Carbon\Carbon::parse($oldTime)->diffInSeconds(now());
}
