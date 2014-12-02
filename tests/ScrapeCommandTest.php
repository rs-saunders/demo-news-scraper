<?php
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Demo\Console\Command\ScrapeCommand;

/**
 * Test the command end to end, passing in static test data
 * 
 * @author Richard Saunders
 *
 */
class ScrapeCommandTest extends PHPUnit_Framework_TestCase
{
	public function testExecute()
	{
		$application = new Application();
		$application->add(new ScrapeCommand());

		$command = $application->find('scrape:bbc');
		$commandTester = new CommandTester($command);
		$commandTester->execute(
            array('command' => $command->getName(), 'uri' => './data/homepage.html')
        );
		
		$output = file_get_contents('./data/output.json');
		
		$this->assertEquals($output, $commandTester->getDisplay());

	}
}