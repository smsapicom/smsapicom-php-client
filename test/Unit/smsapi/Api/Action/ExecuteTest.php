<?php

namespace SMSApi\Api\Action;

use SMSApi\Api\Action\Sms\Delete as SmsDelete;
use SMSApi\Api\Action\Sms\Get as SmsGet;
use SMSApi\Api\Action\Sms\Send as SmsSend;

use SMSApi\Client;

class ExecuteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider statusResponseDataProvider
     */
    public function testExecuteReturnsStatusResponse(AbstractAction $action)
    {
        $proxyStub = $this->prepareProxyStub();
        $client = new Client('test');

        $action->client($client);
        $action->proxy($proxyStub);

        $result = $action->execute();

        $this->assertInstanceOf('SMSApi\Api\Response\StatusResponse', $result);
    }

    public function statusResponseDataProvider()
    {
        return array(
            array(new SmsSend()),
            array(new SmsGet()),
        );
    }

    /**
     * @dataProvider countableResponseDataProvider
     */
    public function testExecuteReturnsCountableResponse(AbstractAction $action)
    {
        $proxyStub = $this->prepareProxyStub();
        $client = new Client('test');

        $action->client($client);
        $action->proxy($proxyStub);

        $result = $action->execute();

        $this->assertInstanceOf('SMSApi\Api\Response\CountableResponse', $result);
    }

    public function countableResponseDataProvider()
    {
        return array(
            array(new SmsDelete()),
        );
    }

    private function prepareProxyStub()
    {
        $proxyStub = $this->getMock('\SMSApi\Proxy\Http\Native', array(), array(''));

        $proxyStub->expects($this->once())
            ->method('execute')
            ->will($this->returnValue(array('output' => '{}', 'code' => 0)));

        return $proxyStub;
    }
}
