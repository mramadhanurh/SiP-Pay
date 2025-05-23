<?php

namespace PhpCoveralls\Bundle\CoverallsBundle\Config;

/**
 * Coveralls API configuration.
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 */
class Configuration
{
    /**
     * Entry point which is used for api calls.
     *
     * @var string
     */
    protected $entryPoint;

    // same as ruby lib

    /**
     * repo_token.
     *
     * @var string
     */
    protected $repoToken;

    /**
     * service_name.
     *
     * @var string
     */
    protected $serviceName;

    // only for php lib

    /**
     * Absolute path to repository root directory.
     *
     * @var string
     */
    protected $rootDir;

    /**
     * Absolute paths to clover.xml.
     *
     * @var array
     */
    protected $cloverXmlPaths = [];

    /**
     * Absolute path to output json_file.
     *
     * @var string
     */
    protected $jsonPath;

    // from command option

    /**
     * Whether to send json_file to jobs API.
     *
     * @var bool
     */
    protected $dryRun = true;

    /**
     * Whether to exclude source files that have no executable statements.
     *
     * @var bool
     */
    protected $excludeNoStatements = false;

    /**
     * Whether to show log.
     *
     * @var bool
     */
    protected $verbose = false;

    /**
     * Runtime environment name.
     *
     * @var string
     */
    protected $env = 'prod';

    // accessor

    /**
     * Set api entry point.
     *
     * @param string $entryPoint
     *
     * @return $this
     */
    public function setEntryPoint($entryPoint)
    {
        $this->entryPoint = rtrim($entryPoint, '/');

        return $this;
    }

    /**
     * Return api entry point.
     *
     * @return string
     */
    public function getEntryPoint()
    {
        return $this->entryPoint;
    }

    /**
     * Set repository token.
     *
     * @param string $repoToken
     *
     * @return $this
     */
    public function setRepoToken($repoToken)
    {
        $this->repoToken = $repoToken;

        return $this;
    }

    /**
     * Return whether repository token is configured.
     *
     * @return bool
     */
    public function hasRepoToken()
    {
        return null !== $this->repoToken;
    }

    /**
     * Return repository token.
     *
     * @return null|string
     */
    public function getRepoToken()
    {
        return $this->repoToken;
    }

    /**
     * Set service name.
     *
     * @param string $serviceName
     *
     * @return $this
     */
    public function setServiceName($serviceName)
    {
        $this->serviceName = $serviceName;

        return $this;
    }

    /**
     * Return whether the service name is configured.
     *
     * @return bool
     */
    public function hasServiceName()
    {
        return null !== $this->serviceName;
    }

    /**
     * Return service name.
     *
     * @return null|string
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }

    public function setRootDir($rootDir)
    {
        $this->rootDir = $rootDir;

        return $this;
    }

    public function getRootDir()
    {
        return $this->rootDir;
    }

    /**
     * Set absolute paths to clover.xml.
     *
     * @param string[] $cloverXmlPaths
     *
     * @return $this
     */
    public function setCloverXmlPaths(array $cloverXmlPaths)
    {
        $this->cloverXmlPaths = $cloverXmlPaths;

        return $this;
    }

    /**
     * Add absolute path to clover.xml.
     *
     * @param string $cloverXmlPath
     *
     * @return $this
     */
    public function addCloverXmlPath($cloverXmlPath)
    {
        $this->cloverXmlPaths[] = $cloverXmlPath;

        return $this;
    }

    /**
     * Return absolute path to clover.xml.
     *
     * @return string[]
     */
    public function getCloverXmlPaths()
    {
        return $this->cloverXmlPaths;
    }

    /**
     * Set absolute path to output json_file.
     *
     * @param string $jsonPath
     *
     * @return $this
     */
    public function setJsonPath($jsonPath)
    {
        $this->jsonPath = $jsonPath;

        return $this;
    }

    /**
     * Return absolute path to output json_file.
     *
     * @return string
     */
    public function getJsonPath()
    {
        return $this->jsonPath;
    }

    /**
     * Set whether to send json_file to jobs API.
     *
     * @param bool $dryRun
     *
     * @return $this
     */
    public function setDryRun($dryRun)
    {
        $this->dryRun = $dryRun;

        return $this;
    }

    /**
     * Return whether to send json_file to jobs API.
     *
     * @return bool
     */
    public function isDryRun()
    {
        return $this->dryRun;
    }

    /**
     * Set whether to exclude source files that have no executable statements.
     *
     * @param bool $excludeNoStatements
     *
     * @return $this
     */
    public function setExcludeNoStatements($excludeNoStatements)
    {
        $this->excludeNoStatements = $excludeNoStatements;

        return $this;
    }

    /**
     * Set whether to exclude source files that have no executable statements unless false.
     *
     * @param bool $excludeNoStatements
     *
     * @return $this
     */
    public function setExcludeNoStatementsUnlessFalse($excludeNoStatements)
    {
        if ($excludeNoStatements) {
            $this->excludeNoStatements = true;
        }

        return $this;
    }

    /**
     * Return whether to exclude source files that have no executable statements.
     *
     * @return bool
     */
    public function isExcludeNoStatements()
    {
        return $this->excludeNoStatements;
    }

    /**
     * Set whether to show log.
     *
     * @param bool $verbose
     *
     * @return $this
     */
    public function setVerbose($verbose)
    {
        $this->verbose = $verbose;

        return $this;
    }

    /**
     * Return whether to show log.
     *
     * @return bool
     */
    public function isVerbose()
    {
        return $this->verbose;
    }

    /**
     * Set runtime environment name.
     *
     * @param string $env runtime environment name
     *
     * @return $this
     */
    public function setEnv($env)
    {
        $this->env = $env;

        return $this;
    }

    /**
     * Return runtime environment name.
     *
     * @return string
     */
    public function getEnv()
    {
        return $this->env;
    }

    /**
     * Return whether the runtime environment is test.
     *
     * @return bool
     */
    public function isTestEnv()
    {
        return 'test' === $this->env;
    }

    /**
     * Return whether the runtime environment is dev.
     *
     * @return bool
     */
    public function isDevEnv()
    {
        return 'dev' === $this->env;
    }

    /**
     * Return whether the runtime environment is prod.
     *
     * @return bool
     */
    public function isProdEnv()
    {
        return 'prod' === $this->env;
    }
}
