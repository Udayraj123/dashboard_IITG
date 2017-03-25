<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		//call a controller function directly
		$resp = $this->call('GET', '/stationary',$parameters=[],$files=[]);
		$crawler = $this->client->request('GET', '/');

		$this->assertTrue($this->client->getResponse()->isOk());
	}

	public function testMyController()
	{
		// crawl in the DOM tree openly
		$resp = $this->call('GET','stationaryController@fetchMenu',$parameters=[],$files=[]);
		$crawler = $this->client->request('GET', '/');
		$this->assertTrue($this->client->getResponse()->isOk(
			$this->assertCount(1,$crawler->filter('div:contains("Menus")'))
			));
	}

}
