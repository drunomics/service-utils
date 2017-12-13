<?php

namespace drunomics\ServiceUtils\Tests\Core\Render\MainContent;

use drunomics\ServiceUtils\Core\Render\MainContent\AjaxRendererTrait;
use Drupal\Core\DependencyInjection\Container;
use Drupal\Core\Render\MainContent\MainContentRendererInterface;

/**
 * @coversDefaultClass \drunomics\ServiceUtils\Core\Render\MainContent\AjaxRendererTrait
 * @group ServiceUtils
 */
class AjaxRendererTraitTest extends \PHPUnit_Framework_TestCase {

  use AjaxRendererTrait;

  /**
   * The id of the trait's service.
   *
   * @var string
   */
  protected $serviceId = 'main_content_renderer.ajax';

  /**
   * @covers ::getAjaxRenderer
   */
  public function testGetter() {
    // Verify the container is used once and the right service is returned.
    $service = $this->mockContainerWithFakeService(['calls' => 1]);
    $this->assertsame($service, $this->getAjaxRenderer());
    // Multiple calls should fetch the service from the container only once.
    $this->getAjaxRenderer();
  }

  /**
   * @covers ::setAjaxRenderer
   */
  public function testSetter() {
    // Verify the set service is returned.
    $this->mockContainerWithFakeService(['calls' => 0]);
    $service = $this->prophesize()
      ->willImplement(MainContentRendererInterface::class)
      ->reveal();
    $this->setAjaxRenderer($service);
    $this->assertsame($service, $this->getAjaxRenderer());
  }

  /**
   * Helper to mock the container with a stub service.
   *
   * @param int[] $options
   *   An array with the following keys:
   *   - calls: The number of calls to get the service the mocked container
   *     expects.
   *
   * @return object
   *   The fake service returned by the container.
   */
  protected function mockContainerWithFakeService(array $options) {
    $service = new \Stdclass();
    $container = $this->prophesize(Container::class);
    $prophecy = $container->get($this->serviceId);
    /** @var \Prophecy\Prophecy\MethodProphecy $prophecy */
    $prophecy->shouldBeCalledTimes($options['calls']);
    $prophecy->willReturn($service);
    \Drupal::setContainer($container->reveal());
    return $service;
  }

}
