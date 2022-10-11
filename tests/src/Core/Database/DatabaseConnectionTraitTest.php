<?php

namespace drunomics\ServiceUtils\Tests\Core\Database;

use drunomics\ServiceUtils\Core\Database\DatabaseConnectionTrait;
use Drupal\Core\DependencyInjection\Container;
use Drupal\Core\Database\Connection;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @coversDefaultClass \drunomics\ServiceUtils\Core\Database\DatabaseConnectionTrait
 * @group ServiceUtils
 */
class DatabaseConnectionTraitTest extends TestCase {

  use DatabaseConnectionTrait;
  use ProphecyTrait;

  /**
   * The id of the trait's service.
   *
   * @var string
   */
  protected $serviceId = 'database';

  /**
   * @covers ::getDatabaseConnection
   */
  public function testGetter() {
    // Verify the container is used once and the right service is returned.
    $service = $this->mockContainerWithFakeService(['calls' => 1]);
    $this->assertsame($service, $this->getDatabaseConnection());
    // Multiple calls should fetch the service from the container only once.
    $this->getDatabaseConnection();
  }

  /**
   * @covers ::setDatabaseConnection
   */
  public function testSetter() {
    // Verify the set service is returned.
    $this->mockContainerWithFakeService(['calls' => 0]);
    $service = $this->prophesize()
      ->willExtend(Connection::class)
      ->reveal();
    $this->setDatabaseConnection($service);
    $this->assertsame($service, $this->getDatabaseConnection());
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
