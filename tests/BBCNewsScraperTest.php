<?php
use Demo\NewsScraper\BBCNewsScraper;

/**
 * Test the bbc news scraper
 *
 * @author Richard Saunders
 *
 */
class BBCNewsScraperTest extends PHPUnit_Framework_TestCase {
	
	public function testScrapeHeadlines() {
		
		$html = file_get_contents('./data/homepage.html');
		
		$scraper = new BBCNewsScraper();
		
		$this->assertEquals(array(
			array('title' => '1: Article 1', 'href' => './data/article1.html'),
			array('title' => '2: Article 2', 'href' => './data/article2.html'),
			array('title' => '3: Article 3', 'href' => './data/article3.html'),
			array('title' => '4: Article 4', 'href' => './data/article4.html'),
			array('title' => '5: Article 5', 'href' => './data/article5.html')
		), $scraper->scrapeHeadlines($html));
		
	}
	
	public function testScrapeArticle() {
		$html = file_get_contents('./data/article2.html');
		
		$scraper = new BBCNewsScraper();
		
		$this->assertEquals("dog dog dog cat\ndog dog dog cat\ndog dog dog cat\na a a a a a a a a a a a a a a a a a a a a a a a a a a a a a", 
				$scraper->scrapeArticle($html));
	}
}