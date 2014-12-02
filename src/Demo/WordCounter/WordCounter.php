<?php
namespace Demo\WordCounter;

/**
 * Provides methods for counting words in a string
 * 
 * @author Richard Saunders
 *
 */
class WordCounter {
	
	/** @var array */
	private static $blacklist = array('the','a','is','and','i');
	
	/**
	 * counts the words in the given text
	 * returns an array of words in order of most used
	 * @param unknown $text
	 * @return array ( word => count )
	 */
	public function countWords($text) {
		$wordCount = array_count_values(str_word_count(strtolower($text), 1));
		arsort($wordCount);
		return $wordCount;
	}
	
	/**
	 * returns the most used word in the given text taking into account
	 * a blacklist of words
	 * 
	 * @return string|NULL
	 */
	public function mostUsedWord($text, array $blacklist = array()) {
		if(!$blacklist) $blacklist = self::$blacklist;
		$wordCount = $this->countWords($text);
		foreach($wordCount as $word => $count) {
			if(!in_array($word, $blacklist)) {
				return $word;
			}
		}
		return null;
	}
}