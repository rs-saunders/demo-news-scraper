<?php
namespace Demo\NewsScraper;

interface NewsScraperInterface {
	/**
	 * takes html as a string and returns a 2d array of headlines 
	 * @param string $html
	 * @return array { { 'title' => 'extra extra read all about it!', 'href' => 'http://www.google.com' } }
	 */
	public function scrapeHeadlines($html);
	
	/**
	 * takes html as a string and returns just the article text
	 * @param string $html
	 * @return string
	 */
	public function scrapeArticle($html);
}