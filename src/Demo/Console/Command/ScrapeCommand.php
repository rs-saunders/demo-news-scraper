<?php
namespace Demo\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;
use Demo\LinkScraper\BBCLinkScraper;
use Demo\WordCounter\WordCounter;
use Demo\NewsScraper\BBCNewsScraper;

/**
 * A Symfony Command 
 * Scrapes the BBC news homepage and returns a JSON array of the most popular shared articles table.
 * 
 * @author Richard Saunders
 *
 */
class ScrapeCommand extends Command
{
	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Console\Command\Command::configure()
	 */
	protected function configure()
	{
		$this->setName('scrape:bbc')
		->setDescription('Scrapes the BBC news homepage and returns a JSON array of the most popular shared articles table.')
		->addArgument(
			'uri',
			InputArgument::OPTIONAL,
			'uri of the bbc homepage',
			'http://www.bbc.co.uk/news'
		);
	}

	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\Console\Command\Command::execute()
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		//fetch the homepage
		$uri = $input->getArgument('uri');
		$html = file_get_contents($uri);
		
		//scrape the homepage for headlines
		$scraper = new BBCNewsScraper();
		$headlines = $scraper->scrapeHeadlines($html);
		
		$results = array('results' => array());
		
		foreach($headlines as $headline) {
			
			//fetch the article's html
			$articleHtml = file_get_contents($headline['href']);
	
			//scrape article's text
			$article = $scraper->scrapeArticle($articleHtml);
				
			$result = $headline;
				
			//record article's size
			$result['size'] = strlen($article);
			
			//find article's most used word
			$wordCount = new WordCounter();
			$result['most_used_word'] = $wordCount->mostUsedWord($article);
			$results['results'] []= $result;
		}
		
		//output result as json
		$output->writeln(json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
	}
}