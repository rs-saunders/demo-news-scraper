<?php
use Demo\WordCounter\WordCounter;

/**
 * Test the word counter
 *
 * @author Richard Saunders
 *
 */
class WordCounterTest extends PHPUnit_Framework_TestCase {
	
	private $wordCounter;
	
	public function setUp() {
		$this->wordCounter = new WordCounter();
	}
	
    public function testCountWords() {
    
        //test it counts correctly
    	$this->assertEquals(array ('three' => 3, 'two' => 2, 'one' => 1), 
        		$this->wordCounter->countWords('one two two three three three') );
    }
    
    public function testMostUsedWord() {
    	
    	//test it finds the correct word, case insensitive, ignore punctuation
    	$this->assertEquals('three', $this->wordCounter->mostUsedWord('one two TWO three THREE. three') );
    	
    	//test the blacklist is used
    	$this->assertEquals('two', $this->wordCounter->mostUsedWord('one two two three three three', array('three') ));
    }
}