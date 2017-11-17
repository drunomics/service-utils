<?php

namespace drunomics\ServiceUtils\Tests\file\FileUsage;

use drunomics\ServiceUtils\file\FileUsage\FileUsageTrait;
use Drupal\Core\DependencyInjection\Container;
use Drupal\file\FileUsage\FileUsageInterface;

/**
 * @coversDefaultClass \drunomics\ServiceUtils\file\FileUsage\FileUsageTrait
 * @group ServiceUtils
 */
class FileUsageTraitTest extends \PHPUnit_Framework_TestCase {

  use FileUsageTrait;

  /**
   * The id of the trait's service.
   *
   * @var string
   */
  protected $serviceId = 'file.usage';

  /**
   * @covers ::getFileUsage
   */
  public function testGetter() {
    // Verify the container is used once and the right service is returned.
    $service = $this->mockContainerWithFakeService(['calls' => 1]);
    $this->assertsame($service, $this->getFileUsage());
    // Multiple calls should fetch the service from the container only once.
    $this->getFileUsage();
  }

  /**
   * @covers ::setFileUsage
   */
  public function testSetter() {
    // Verify the set service is returned.
    $this->mockContainerWithFakeService(['calls' => 0]);
    $service = $this->prophesize(FileUsageInterface::class)
      ->reveal();
    $this->setFileUsage($service);
    $this->assertsame($service, $this->getFileUsage());
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
