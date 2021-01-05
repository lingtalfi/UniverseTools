[Back to the Ling/UniverseTools api](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools.md)<br>
[Back to the Ling\UniverseTools\DependencyTool class](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/DependencyTool.md)


DependencyTool::getDependencyListRecursiveByUniverseDirPlanets
================



DependencyTool::getDependencyListRecursiveByUniverseDirPlanets — Returns a list of sorted [planet dot names](https://github.com/karayabin/universe-snapshot#the-planet-dot-name) corresponding to all the dependencies of the given planets, recursively.




Description
================


public static [DependencyTool::getDependencyListRecursiveByUniverseDirPlanets](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/DependencyTool/getDependencyListRecursiveByUniverseDirPlanets.md)(string $uniDir, array $planetDotNames, ?bool $includeParents = true, ?array &$errors = []) : array




Returns a list of sorted [planet dot names](https://github.com/karayabin/universe-snapshot#the-planet-dot-name) corresponding to all the dependencies of the given planets, recursively.

By default, it also includes the given planets in the list. If you just want the dependencies, set $includeParents=false.

The planets are searched only in the given universe directory (i.e. not in the web).

Errors are reported in the $errors variable.




Parameters
================


- uniDir

    

- planetDotNames

    

- includeParents

    

- errors

    


Return values
================

Returns array.








Source Code
===========
See the source code for method [DependencyTool::getDependencyListRecursiveByUniverseDirPlanets](https://github.com/lingtalfi/UniverseTools/blob/master/DependencyTool.php#L42-L56)


See Also
================

The [DependencyTool](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/DependencyTool.md) class.

Next method: [parseDumpDependencies](https://github.com/lingtalfi/UniverseTools/blob/master/doc/api/Ling/UniverseTools/DependencyTool/parseDumpDependencies.md)<br>

