<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

/**
 * Class AppKernel
 */
class AppKernel extends Kernel
{
    private const CONFIG_EXTS = '.{php,xml,yaml,yml}';

    /**
     * @return array
     */
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle,
            new FOS\HttpCacheBundle\FOSHttpCacheBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Kunstmaan\UtilitiesBundle\KunstmaanUtilitiesBundle(),
            new Kunstmaan\NodeBundle\KunstmaanNodeBundle(),
            new Kunstmaan\SeoBundle\KunstmaanSeoBundle(),
            new Symfony\Cmf\Bundle\RoutingBundle\CmfRoutingBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Liip\ImagineBundle\LiipImagineBundle(),
            new Knp\Bundle\GaufretteBundle\KnpGaufretteBundle(),
            new Kunstmaan\MediaBundle\KunstmaanMediaBundle(),
            new ArsThanea\RemoteMediaBundle\RemoteMediaBundle(),
            new ArsThanea\PageMediaSetBundle\PageMediaSetBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Kunstmaan\AdminBundle\KunstmaanAdminBundle(),
            new Kunstmaan\PagePartBundle\KunstmaanPagePartBundle(),
            new Kunstmaan\MediaPagePartBundle\KunstmaanMediaPagePartBundle(),
            new Kunstmaan\FormBundle\KunstmaanFormBundle(),
            new Kunstmaan\AdminListBundle\KunstmaanAdminListBundle(),
            new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
            new Kunstmaan\SearchBundle\KunstmaanSearchBundle(),
            new Kunstmaan\NodeSearchBundle\KunstmaanNodeSearchBundle(),
            new Kunstmaan\SitemapBundle\KunstmaanSitemapBundle(),
            new Kunstmaan\ArticleBundle\KunstmaanArticleBundle(),
            new Kunstmaan\TranslatorBundle\KunstmaanTranslatorBundle(),
            new Ekino\Bundle\NewRelicBundle\EkinoNewRelicBundle(),
            new Kunstmaan\RedirectBundle\KunstmaanRedirectBundle(),
            new Kunstmaan\UserManagementBundle\KunstmaanUserManagementBundle(),
            new Kunstmaan\DashboardBundle\KunstmaanDashboardBundle(),
            new ArsThanea\KunstmaanExtraBundle\KunstmaanExtraBundle(),
            //new Kunstmaan\LeadGenerationBundle\KunstmaanLeadGenerationBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'docker'), true)) {
            $bundles[] = new Kunstmaan\GeneratorBundle\KunstmaanGeneratorBundle();
        }

        if (in_array($this->getEnvironment(), array('dev', 'test', 'docker'), true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Kunstmaan\BehatBundle\KunstmaanBehatBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Symfony\Bundle\WebServerBundle\WebServerBundle();
        }

        return $bundles;
    }

    /**
     * @param LoaderInterface $loader
     * @throws Exception
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $confDir = $this->getRootDir() . '/config';
        $loader->load($confDir . "/{parameters}.{yml}", 'glob');
        $loader->load($confDir . "/{packages}/*" . self::CONFIG_EXTS, 'glob');
        $loader->load($confDir . "/{packages}/" . $this->environment . "/**/*" . self::CONFIG_EXTS, 'glob');
        $loader->load($confDir . '/{services}' . self::CONFIG_EXTS, 'glob');
        $loader->load($confDir . '/{services}_' . $this->environment . self::CONFIG_EXTS, 'glob');
    }

    /**
     * @return string
     */
    public function getRootDir()
    {
        return __DIR__;
    }

    /**
     * @return string
     */
    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->environment;
    }

    /**
     * @return string
     */
    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }
}
