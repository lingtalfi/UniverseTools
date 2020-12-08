[Back to the Ling/UniverseTools api](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools.md)



The PlanetTool class
================
2019-02-26 --> 2020-12-08






Introduction
============

The PlanetTool class.

Contains methods related to a planet, like listing the [bsr-0](https://github.com/lingtalfi/BumbleBee/blob/master/Autoload/convention.bsr0.eng.md) classes found in a planet for instance.



Class synopsis
==============


class <span class="pl-k">PlanetTool</span>  {

- Methods
    - public static [getClassNames](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/getClassNames.md)($planetDir, ?array $options = []) : array
    - public static [getPlanetDirs](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/getPlanetDirs.md)(string $universeDir) : array
    - public static [getGalaxyNamePlanetNameByDir](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/getGalaxyNamePlanetNameByDir.md)(string $planetDir) : array | false
    - public static [getTightPlanetName](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/getTightPlanetName.md)(string $planetName) : string
    - public static [getGalaxyNamePlanetNameByPlanetName](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/getGalaxyNamePlanetNameByPlanetName.md)(string $longPlanetName) : array | false
    - public static [extractPlanetId](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/extractPlanetId.md)(string $planetId) : array
    - public static [extractPlanetDotName](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/extractPlanetDotName.md)(string $planetDotName) : array
    - public static [getGalaxyPlanetByClassName](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/getGalaxyPlanetByClassName.md)(string $className) : array | false
    - public static [importPlanetByExternalDir](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/importPlanetByExternalDir.md)(string $planetDot, string $extPlanetDir, string $appDir) : void
    - public static [removePlanet](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/removePlanet.md)(string $planetDot, string $appDir) : void

}






Methods
==============

- [PlanetTool::getClassNames](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/getClassNames.md) &ndash; Parses the given directory recursively and returns an array containing the names of all [bsr-1](https://github.com/lingtalfi/TheScientist/blob/master/bsr-1.md) classes found.
- [PlanetTool::getPlanetDirs](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/getPlanetDirs.md) &ndash; Returns the list of planet dirs for a given $universeDir.
- [PlanetTool::getGalaxyNamePlanetNameByDir](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/getGalaxyNamePlanetNameByDir.md) &ndash; Returns an array containing the galaxy name and the short planet name extracted from the given $planetDir.
- [PlanetTool::getTightPlanetName](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/getTightPlanetName.md) &ndash; Returns the [tight planet name](https://github.com/lingtalfi/UniverseTools/blob/master/doc/pages/nomenclature.md#tight-planet-name) for a given planet.
- [PlanetTool::getGalaxyNamePlanetNameByPlanetName](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/getGalaxyNamePlanetNameByPlanetName.md) &ndash; Returns an array containing the galaxy name and the short planet name extracted from the given $planetName.
- [PlanetTool::extractPlanetId](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/extractPlanetId.md) &ndash; Returns an array containing the galaxy and the planet, based on the given planetId.
- [PlanetTool::extractPlanetDotName](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/extractPlanetDotName.md) &ndash; Returns an array containing the galaxy and the planet, based on the given [planetDotName](https://github.com/karayabin/universe-snapshot#the-planet-dot-name).
- [PlanetTool::getGalaxyPlanetByClassName](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/getGalaxyPlanetByClassName.md) &ndash; Returns an array containing the galaxy and planet contained in the given class name.
- [PlanetTool::importPlanetByExternalDir](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/importPlanetByExternalDir.md) &ndash; Imports a planet by copying an external source dir, and importing the assets/map into the app.
- [PlanetTool::removePlanet](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/PlanetTool/removePlanet.md) &ndash; Removes the given planet from the given app directory.





Location
=============
Ling\UniverseTools\PlanetTool<br>
See the source code of [Ling\UniverseTools\PlanetTool](https://github.com/lingtalfi/UniverseTools/blob/master/PlanetTool.php)



SeeAlso
==============
Previous class: [MetaInfoTool](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/MetaInfoTool.md)<br>
