<?php
namespace Demo\NewsScraper;

use Demo\NewsScraper\NewsScraper;
use Demo\NewsScraper\NewsScraperInterface;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Provides methods for scraping headlines and articles from the bbc news website
 * 
 * @author Richard Saunders
 *
 */
class BBCNewsScraper extends NewsScraper implements NewsScraperInterface {
	
	/**
	 * (non-PHPdoc)
	 * @see \Demo\NewsScraper\NewsScraperInterface::scrapeHeadlines()
	 */
	public function scrapeHeadlines($html) {
		return $this->filter($html, '#most-popular > div.panel.open a', function(Crawler $node, $i) {
			return array(
				'title' => trim($node->text()),
				'href' => trim($node->attr('href'))
			);
		});
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Demo\NewsScraper\NewsScraperInterface::scrapeArticle()
	 */
	public function scrapeArticle($html) {
		$paragraphs = $this->filter($html, '#main-content .story-body p', function(Crawler $node, $i) {
			return $node->text();
		});
		return implode("\n", $paragraphs);
	}
}
