<?php
namespace Demo\NewsScraper;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Privides helper methods for news scraper classes
 * 
 * @author Richard Saunders
 *
 */
abstract class NewsScraper {
	
	/**
	 * Returns a Crawler instance for the given html
	 * 
	 * @param string $html
	 * @return \Symfony\Component\DomCrawler\Crawler
	 */
	public function getCrawler($html) {
		return new Crawler($html);	
	}
	
	/**
	 * Filters html using a css selector. Runs the callback  
	 * over each returned element of the css selector and the
	 * method returns an array of all the callback responses
	 * 
	 * @param string $html
	 * @param string $selector
	 * @param callable $closure
	 * @return array
	 */
	public function filter($html, $selector, callable $closure) {
		return $this->getCrawler($html)->filter($selector)->each($closure);
	}
}