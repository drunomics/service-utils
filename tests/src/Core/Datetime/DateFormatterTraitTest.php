<?php

namespace drunomics\ServiceUtils\Tests\Core\Datetime;

use drunomics\ServiceUtils\Core\Datetime\DateFormatterTrait;
use PHPUnit\Framework\TestCase;
use Drupal\Core\DependencyInjection\Container;

/**
 * @coversDefaultClass \drunomics\ServiceUtils\Core\Datetime\DateFormatterTrait
 * @group ServiceUtils
 */
class DateFormatterTraitTest extends TestCase {

  use DateFormatterTrait;

  /**
   * The id of the trait's service.
   *
   * @var string
   */
  protected $serviceId = 'date.formatter';

  /**
   * @covers ::getModuleHandler
   */
  public function testGetter() {
    // Verify the container is used once and the right service is returned.
    $service = $this->mockContainerWithFakeService(['calls' => 1]);
    $this->assertsame($service, $this->getDateFormatter());
    // Multiple calls should fetch the service from the container only once.
    $this->getDateFormatter();
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
