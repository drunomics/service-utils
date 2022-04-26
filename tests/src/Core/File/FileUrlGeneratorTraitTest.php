<?php

namespace drunomics\ServiceUtils\Tests\Core\File;

use drunomics\ServiceUtils\Core\File\FileUrlGeneratorTrait;
use Drupal\Core\DependencyInjection\Container;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \drunomics\ServiceUtils\Core\File\FileUrlGeneratorTrait
 * @group ServiceUtils
 */
class FileUrlGeneratorTraitTest extends TestCase {

  use FileUrlGeneratorTrait;

  /**
   * The id of the trait's service.
   *
   * @var string
   */
  protected $serviceId = 'file_url_generator';

  /**
   * @covers ::getFileSystem
   */
  public function testGetter() {
    // Verify the container is used once and the right service is returned.
    $service = $this->mockContainerWithFakeService(['calls' => 1]);
    $this->assertsame($service, $this->getFileUrlGenerator());
    // Multiple calls should fetch the service from the container only once.
    $this->getFileUrlGenerator();
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
