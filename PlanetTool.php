<?php

namespace Ling\UniverseTools;


use Ling\DirScanner\YorgDirScannerTool;
use Ling\LingTalfi\Util\ReadmeUtil;
use Ling\TokenFun\TokenFinder\Tool\TokenFinderTool;
use Ling\UniverseTools\Exception\UniverseToolsException;

/**
 * The PlanetTool class.
 *
 * Contains methods related to a planet, like listing the @kw(bsr-0) classes found in a planet for instance.
 *
 */
class PlanetTool
{


    /**
     * Returns the version number of the planet if found, or null otherwise.
     *
     * @param string $planetDir
     * @return string|null
     */
    public static function getVersionByPlanetDir(string $planetDir)
    {
        $version = MetaInfoTool::getVersion($planetDir);
        if (true === empty($version)) {
            $ru = new ReadmeUtil();
            $rf = $planetDir . "/README.md";
            if (file_exists($rf)) {
                $versionInfo = $ru->getLatestVersionInfo($rf);
                $version = $versionInfo[0];
            }
        }
        return $version;
    }


    /**
     * Returns the [planet slash name](https://github.com/karayabin/universe-snapshot#the-planet-slash-name) from the given planet dot name.
     *
     *
     * @param string $planetDotName
     * @return string
     */
    public static function getPlanetSlashNameByDotName(string $planetDotName): string
    {
        return str_replace(".", "/", $planetDotName);
    }


    /**
     * Returns the location of the planet directory from the given planet dot name and app dir.
     *
     * @param string $planetDotName
     * @param string $appDir
     * @return string
     */
    public static function getPlanetDirByPlanetDotName(string $planetDotName, string $appDir): string
    {
        return $appDir . "/universe/" . self::getPlanetSlashNameByDotName($planetDotName);
    }

    /**
     * Parses the given directory recursively and returns an array containing the names of all @kw(bsr-1) classes found.
     *
     * Example:
     * -----------
     *
     * The following code:
     *
     * ```php
     * $planetDir = "/komin/jin_site_demo/universe/Ling/UniverseTools";
     * az(PlanetTool::getClassNames($planetDir));
     * ```
     *
     *
     * Will output:
     *
     * ```html
     * array(3) {
     * [0] => string(33) "Ling\UniverseTools\DependencyTool"
     * [1] => string(51) "Ling\UniverseTools\Exception\UniverseToolsException"
     * [2] => string(29) "Ling\UniverseTools\PlanetTool"
     * }
     *
     * ```
     *
     *
     *
     *
     * Available options are:
     * - ignoreFilesStartingWith: array of prefixes to look for. If a prefix matches the beginning of a (relative) file path (relative to the planet root dir),
     *          then the file is excluded.
     *
     *
     * @param $planetDir
     * @param array $options
     * @return array
     * @throws UniverseToolsException
     */
    public static function getClassNames($planetDir, array $options = []): array
    {
        if (false === is_dir($planetDir)) {
            throw new UniverseToolsException("Dir not found: $planetDir");
        }

        $ignoreFilesStartingWith = $options['ignoreFilesStartingWith'] ?? [];


        $pInfo = PlanetTool::getGalaxyNamePlanetNameByDir($planetDir);
        if (false !== $pInfo) {
            list($galaxy, $planetName) = $pInfo;
            $classNames = [];
            $dirName = basename($planetDir);


            $files = YorgDirScannerTool::getFilesWithExtension($planetDir, 'php', false, true, true);
            foreach ($files as $file) {


                /**
                 * Skip files starting with the specified prefixes
                 */
                if ($ignoreFilesStartingWith) {
                    foreach ($ignoreFilesStartingWith as $prefix) {
                        if (0 === strpos($file, $prefix)) {
                            continue 2;
                        }
                    }
                }

                $absFile = $planetDir . "/" . $file;
                $content = file_get_contents($absFile);
                /**
                 * filtering scripts starting with
                 *
                 *      #!/usr/bin/env php
                 *
                 *
                 */
                if ('<?php' === substr($content, 0, 5)) {


                    $relativeClassName = str_replace('/', '\\', substr($file, 0, -4));
                    $className = $galaxy . '\\' . $dirName . '\\' . $relativeClassName;


                    $tokens = token_get_all(file_get_contents($absFile));
                    $_items = TokenFinderTool::getClassNames($tokens, true, [
                        "includeInterfaces" => true,
                    ]);


                    if ($_items) { // ensure that the file contains a class

                        try {

                            $class = new \ReflectionClass($className);
                            $classNames[] = $className;

                        } catch (\ReflectionException $e) {
                        }
                    }

                }
            }
            return $classNames;
        } else {
            throw new UniverseToolsException("Invalid planet directory. A valid planet dir should be of the form /my/universe/\$galaxyName/\$shortPlanetName.");
        }
    }


    /**
     * Returns the list of planet dirs for a given $universeDir.
     *
     * If the given universe directory does not exist, a UniverseToolsException is thrown.
     *
     *
     * @param string $universeDir
     * @return array
     * @throws UniverseToolsException
     */
    public static function getPlanetDirs(string $universeDir): array
    {
        if (false === is_dir($universeDir)) {
            throw new UniverseToolsException("Dir not found: $universeDir");
        }
        $ret = [];
        $galaxies = YorgDirScannerTool::getDirs($universeDir);
        foreach ($galaxies as $galaxy) {
            $ret = array_merge($ret, YorgDirScannerTool::getDirs($galaxy));
        }
        return $ret;
    }


    /**
     * Returns an array containing the galaxy name and the short planet name extracted from the given $planetDir.
     * Returns false if the given $planetDir is not valid.
     *
     * @param string $planetDir
     * @return array|false
     */
    public static function getGalaxyNamePlanetNameByDir(string $planetDir)
    {
        if (false !== strpos($planetDir, "/")) {
            return [
                basename(dirname($planetDir)),
                basename($planetDir),
            ];
        }
        return false;
    }


    /**
     * Returns the @page(tight planet name) for a given planet.
     *
     * Note: it's the same as the getCompressedPlanetName method.
     * @param string $planetName
     * @return string
     */
    public static function getTightPlanetName(string $planetName): string
    {
        return str_replace("_", "", $planetName);
    }


    /**
     * Returns the [compressed planet name](https://github.com/karayabin/universe-snapshot#the-compressed-planet-name) for a given planet.
     *
     * Note: it's the same as the getTightPlanetName method.
     *
     * @param string $planetName
     * @return string
     */
    public static function getCompressedPlanetName(string $planetName): string
    {
        return str_replace("_", "", $planetName);
    }

    /**
     * Returns an array containing the galaxy name and the short planet name extracted from the given $planetName.
     * Returns false if the given $planetName is invalid.
     *
     *
     * @param string $longPlanetName
     * The long planet name (galaxy/planetShortName).
     * @return array|false
     */
    public static function getGalaxyNamePlanetNameByPlanetName(string $longPlanetName)
    {
        $p = explode("/", $longPlanetName);
        if (2 === count($p)) {
            return $p;
        }
        return false;
    }


    /**
     * Returns an array containing the galaxy and the planet, based on the given planetId.
     *
     * The array contains the following:
     * - 0: galaxy name
     * - 1: planet name
     *
     *
     *
     * @param string $planetId
     * @return array
     * @throws \Exception
     */
    public static function extractPlanetId(string $planetId): array
    {
        $p = explode("/", $planetId, 2);
        if (2 === count($p)) {
            return $p;
        }
        throw new UniverseToolsException("The given planetId is not valid: $planetId.");
    }


    /**
     * Returns an array containing the galaxy and the planet, based on the given [planetDotName](https://github.com/karayabin/universe-snapshot#the-planet-dot-name).
     *
     * The array contains the following:
     * - 0: galaxy name
     * - 1: planet name
     *
     *
     *
     * @param string $planetDotName
     * @return array
     * @throws \Exception
     */
    public static function extractPlanetDotName(string $planetDotName): array
    {
        $p = explode(".", $planetDotName, 2);
        if (2 === count($p)) {
            return $p;
        }
        throw new UniverseToolsException("The given planetDotName is not valid: $planetDotName.");
    }


    /**
     * Returns an array containing the galaxy and planet contained in the given class name.
     * Returns false if the given class name is not valid (i.e. @page(bsr-0) compliant).
     *
     * The given class name is the fully qualified class name.
     *
     *
     * @param string $className
     * @return array|false
     */
    public static function getGalaxyPlanetByClassName(string $className)
    {
        $p = explode("\\", $className);
        if (count($p) > 2) {
            return [
                array_shift($p),
                array_shift($p),
            ];
        }
        return false;
    }


//    /**
//     * Imports a planet by copying an external source dir, and importing the assets/map into the app.
//     *
//     * See more details in the @page(UniverseTools conception notes).
//     *
//     * @param string $planetDot
//     * @param string $extPlanetDir
//     * @param string $appDir
//     */
//    public static function importPlanetByExternalDir(string $planetDot, string $extPlanetDir, string $appDir)
//    {
//        list($galaxy, $planet) = self::extractPlanetDotName($planetDot);
//        if (false === file_exists($extPlanetDir)) {
//            throw new UniverseToolsException("External source dir not found: $extPlanetDir.");
//        }
//        if (false === file_exists($appDir)) {
//            throw new UniverseToolsException("Application dir not found: $appDir.");
//        }
//
//        $newPlanetDir = $appDir . "/universe/$galaxy/$planet";
//        FileSystemTool::copyDir($extPlanetDir, $newPlanetDir);
//
//        $assetsMapDir = $newPlanetDir . "/assets/map";
//        if (is_dir($assetsMapDir)) {
//            AssetsMapTool::copyAssets($assetsMapDir, $appDir);
//        }
//    }


    /**
     * Installs the assets of the given planet.
     *
     * See the @page(UniverseTool conception notes) for more details about assets.
     *
     * @param string $appDir
     * @param string $planetDotName
     */
    public static function installAssetsByPlanetDotName(string $appDir, string $planetDotName)
    {
        $planetDir = $appDir . "/universe/" . str_replace(".", "/", $planetDotName);
        $assetsMapDir = $planetDir . "/assets/map";
        if (is_dir($assetsMapDir)) {
            AssetsMapTool::copyAssets($assetsMapDir, $appDir);
        }
    }


    /**
     * Removes the assets for the given planet.
     *
     * See the @page(UniverseTool conception notes) for more details about assets.
     *
     * @param string $appDir
     * @param string $planetDotName
     */
    public static function removeAssetsByPlanetDotName(string $appDir, string $planetDotName)
    {
        $planetDir = $appDir . "/universe/" . str_replace(".", "/", $planetDotName);
        $assetMapDir = $planetDir . "/assets/map";
        if (is_dir($assetMapDir)) {
            AssetsMapTool::removeAssets($assetMapDir, $appDir);
        }
    }


//    /**
//     * Removes the given planet from the given app directory. The assets/map files are also removed.
//     *
//     * See more details in the @page(UniverseTools conception notes).
//     *
//     *
//     * @param string $planetDot
//     * @param string $appDir
//     */
//    public static function removePlanet(string $planetDot, string $appDir)
//    {
//
//        list($galaxy, $planet) = self::extractPlanetDotName($planetDot);
//        $planetDir = $appDir . "/universe/$galaxy/$planet";
//        $assetMapDir = $planetDir . "/assets/map";
//
//        if (is_dir($assetMapDir)) {
//            AssetsMapTool::removeAssets($assetMapDir, $appDir);
//        }
//        if (is_dir($planetDir)) {
//            FileSystemTool::remove($planetDir);
//        }
//    }

}