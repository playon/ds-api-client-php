<?php
/**
 * Copyright (c) 2014 Ryan Parman <http://ryanparman.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 */

namespace DigitalScout;

use Monolog\Formatter;

/**
 * A variation of the Monolog JsonFormatter which pretty-prints the JSON output.
 */
class JsonPrettyPrintFormatter extends Formatter\LineFormatter
{
    /**
     * {@inheritdoc}
     */
    public function format(array $record)
    {	
    	$context = $record["context"];
    	unset($record["context"]);
    	$val = parent::format($record);
    	$val = str_replace(" %context% []", "", $val);
    	$json = json_encode($context, JSON_PRETTY_PRINT);
    	$indentedJson = '';
    	foreach(preg_split("/((\r?\n)|(\r\n?))/", $json) as $line){
		    $indentedJson = $indentedJson . "    " . $line . PHP_EOL;
		} 
		return $val . $indentedJson . PHP_EOL;
        //return json_encode($record, JSON_PRETTY_PRINT) . PHP_EOL;
    }
}