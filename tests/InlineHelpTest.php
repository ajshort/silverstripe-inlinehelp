<?php
/**
 * @package    silverstripe-inlinehelp
 * @subpackage tests
 */
class InlineHelpTest extends SapphireTest {

	public static $fixture_file = 'inlinehelp/tests/InlineHelpTest.yml';

	public function testAttachAllPages() {
		$home = $this->objFromFixture('SiteTree', 'home')->getHelpItems();

		$this->assertEquals(1, count($home));
		$this->assertEquals('All Pages Help', $home->First()->Title);
	}

	public function testAttachSpecificPages() {
		$about   = $this->objFromFixture('SiteTree', 'about')->getHelpItems();
		$contact = $this->objFromFixture('SiteTree', 'contact')->getHelpItems();

		foreach (array($about, $contact) as $fixture) {
			$this->assertEquals(2, count($fixture));
			$this->assertEquals(array('All Pages Help', 'Specific Pages Help'),
				array_values($fixture->map()));
		}
	}

	public function testAttachChildPages() {
		$location = $this->objFromFixture('SiteTree', 'location')->getHelpItems();

		$this->assertEquals(2, count($location));
			$this->assertEquals(array('All Pages Help', 'Child Pages Help'),
				array_values($location->map()));
	}

}