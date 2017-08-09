<?PHP

namespace Tests\RoutesTest;

use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class RoutesTest extends TestCase
{
    public function testBasicRouting()
    {
        $app = parent::startApp();//require __DIR__ . '/../../lib/Framework/startApp.php';
        $app->addRoute('GET', '/', function () {
            return new Response('TEST');
        });
        $response = $app->run();
        $responseContent = $response->getContent();
        $responseStatus = $response->getStatusCode();
        $this->assertContains($responseContent, 'TEST');
        $this->assertEquals($responseStatus, 200);
    }
}
