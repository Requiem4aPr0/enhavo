<?php
/**
 * Created by PhpStorm.
 * User: m
 * Date: 21.11.17
 * Time: 10:33
 */

namespace Enhavo\Bundle\MultiTenancyBundle\DependencyInjection;

use Sylius\Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Yaml\Yaml;

class MultiTenancyExtension extends AbstractResourceExtension implements PrependExtensionInterface
{
    public function load(array $config, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $config);
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $container->setParameter('multiTenancy.configuration', $config['configuration']);

        $configFiles = array(
            'services.yml'
        );

        foreach ($configFiles as $configFile) {
            $loader->load($configFile);
        }
    }

    /**
     * @inheritDoc
     */
    public function prepend(ContainerBuilder $container)
    {
        $path = __DIR__ . '/../Resources/config/app/';
        $files = scandir($path);

        foreach ($files as $file) {
            if (preg_match('/\.yaml$/', $file)) {
                $settings = Yaml::parse(file_get_contents($path . $file));
                if (is_array($settings)) {
                    if (is_array($settings)) {
                        foreach ($settings as $name => $value) {
                            if (is_array($value)) {
                                $container->prependExtensionConfig($name, $value);
                            }
                        }
                    }
                }
            }
        }
    }
}
