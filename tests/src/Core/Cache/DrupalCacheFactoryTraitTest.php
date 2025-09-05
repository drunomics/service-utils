<?php

namespace drunomics\ServiceUtils\Tests\Core\Cache;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\DependencyInjection\Container;
use drunomics\ServiceUtils\Core\Cache\DrupalCacheFactoryTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @coversDefaultClass \drunomics\ServiceUtils\Core\Cache\DrupalCacheFactoryTrait
 * @group ServiceUtils
 */
class DrupalCacheFactoryTraitTest extends TestCase {

  use DrupalCacheFactoryTrait;
  use ProphecyTrait;

  /**
   * @covers ::getCache
   */
  public function testGetCacheDefaultBin(): void {
    $service = $this->mockContainerWithFakeService('cache.default', ['calls' => 1]);
    $this->assertSame($service, $this->getCache());
  }

  /**
   * @covers ::getCache
   */
  public function testGetCacheCustomBin(): void {
    $service = $this->mockContainerWithFakeService('cache.render', ['calls' => 1]);
    $this->assertSame($service, $this->getCache('render'));
  }

  /**
   * Helper to mock the container with a stub cache backend service.
   *
   * @param string $serviceId
   *   The expected service ID.
   * @param array{calls:int} $options
   *   An array with the following keys:
   *   - calls: The number of calls to get the service the mocked container
   *     expects.
   *
   * @return \Drupal\Core\Cache\CacheBackendInterface
   *   The fake cache backend returned by the container.
   */
  protected function mockContainerWithFakeService(string $serviceId, array $options): CacheBackendInterface {
    $service = $this->prophesize(CacheBackendInterface::class)->reveal();

    $container = $this->prophesize(Container::class);
    $prophecy = $container->get($serviceId);
    /** @var \Prophecy\Prophecy\MethodProphecy $prophecy */
    $prophecy->shouldBeCalledTimes($options['calls']);
    $prophecy->willReturn($service);

    \Drupal::setContainer($container->reveal());

    return $service;
  }

}
