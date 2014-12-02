<?php
use Symfony\Component\DomCrawler\Crawler;

include('./vendor/autoload.php');

$html = file_get_contents("http://www.bbc.co.uk/news");
$crawler = new Crawler($html);


$results = array( "results" => $crawler->filter('#most-popular > div.panel.open a')->each(function(Crawler $link, $i) {

	$result = array(
		'title' => trim($link->text()),
		'href' => trim($link->attr('href'))
	);
	
	$articleHtml = file_get_contents($result['href']);
	
	$result['size'] = strlen($articleHtml);
	$articleCrawler = new Crawler($articleHtml);
	
	$paragraphs = $articleCrawler->filter('#main-content .story-body p')->each(function(Crawler $node, $i) {
		return $node->text();
	});

	$wordCount = array_count_values(str_word_count(strtolower(implode("\n", $paragraphs)), 1));

	arsort($wordCount);
	
	$blacklistWords = array('the','a','is','and','i');
	
	foreach($wordCount as $word => $count) {
		if(!in_array($word, $blacklistWords)) {
			$result['most_used_word'] = $word;
			break;
		}
	}
	
	return $result;
}));


echo json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);