<?php
namespace SwimlanesIo;

use MediaWiki\Hook\ParserAfterTidyHook;
use MediaWiki\Hook\ParserFirstCallInitHook;
use MediaWiki\Html\Html;
use Parser;
use PPFrame;

class Hooks implements
	ParserAfterTidyHook,
	ParserFirstCallInitHook
{
	public function onParserFirstCallInit($parser)
	{
		$parser->setHook('swimlanes-io', [$this, 'parserHook']);
	}

	public function onParserAfterTidy($parser, &$text)
	{
		$text .= Html::linkedScript('//cdn.swimlanes.io/embed.js');
	}

	public function parserHook($text, array $params, Parser $parser, PPFrame $frame): array
	{
		$output = htmlspecialchars($text);
		return [
			Html::rawElement('swimlanes-io', $params, $output),
			'markerType' => 'nowiki'
		];
	}
}
