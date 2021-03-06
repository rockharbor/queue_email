<?php
/* Queues Test cases generated on: 2010-09-17 10:09:29 : 1284744509*/
App::import('Controller', 'QueueEmail.Queues');

class TestQueuesController extends QueuesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class QueuesControllerTestCase extends CakeTestCase {
	var $fixtures = array('plugin.queue_email.queue');

	function startTest() {
		$this->Queues =& new TestQueuesController();
		$this->Queues->constructClasses();
		$this->Queues->Component->initialize($this->Queues);
	}

	function endTest() {
		unset($this->Queues);
		ClassRegistry::flush();
	}

	function testIndex() {
		$this->Queues->params['url']['url'] = 'queues/index';
		$this->Queues->index();
		$results = Set::extract('/Queue/id', $this->Queues->viewVars['queues']);
		sort($results);
		$expected = array(1, 2, 3, 4);
		$this->assertEqual($results, $expected);
	}

	function testView() {
		$this->Queues->params['url']['url'] = 'queues/view';
		$this->Queues->view(2);
		$results = $this->Queues->viewVars['queue']['Queue']['id'];
		$this->assertEqual($results, 2);
	}

	function testDelete() {
		$this->Queues->params['url']['url'] = 'queues/delete';
		$this->Queues->delete(1);
		$count = $this->Queues->Queue->find('count');
		$this->assertEqual($count, 3);
	}

}
?>